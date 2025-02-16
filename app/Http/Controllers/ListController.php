<?php

namespace App\Http\Controllers;

use App\Models\MovieList;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $lists = $user->lists()->with('movies')->latest()->get();
        $lists = $lists->map(function ($list) {
            return [
                'id' => $list->id,
                'title' => $list->title,
                'posters' => $list->movies->map(fn ($movie) => [
                    'src' => $movie->poster,
                    'title' => $movie->title,
                    'id' => $movie->id,
                ]),
            ];
        });

        return view('lists', [
            'lists' => $lists,
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validateWithBag('createListValidation', [
            'title' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $list = MovieList::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            Auth::user()->lists()->attach($list->id);

            return redirect(route('list', ['id' => $list->id]));
        } catch (Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Something went wrong when creating the list!', 'createList');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $list = MovieList::with(['users', 'movies'])->findOrFail($id);

        $listOwner = $list->users->firstWhere('pivot.role', 'owner');
        $isListOwner = Auth::check() && $list->isOwnedBy(Auth::user()->id);

        $previousUrl = url()->previous();
        $backLink = Str::contains($previousUrl, ['/u/'])
            ? $previousUrl
            : route('profile', ['username' => $listOwner->username]);

        return view('list', [
            'list' => $list,
            'backLink' => $backLink,
            'isListOwner' => $isListOwner,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovieList $list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovieList $list)
    {
        //
    }

    public function addToList($listId, $movieId)
    {
        try {
            $list = MovieList::findOrFail($listId);
            $user = Auth::user();

            if (! $list->isOwnedBy($user->id)) {
                return redirect()
                    ->back()
                    ->withErrors('You are not allowed to edit this list!', 'addToList');
            }

            if ($list->movies()->where('movie_id', $movieId)->exists()) {
                return redirect()
                    ->back()
                    ->withErrors('Movie is already in list!', 'addToList');
            }

            $list->movies()->attach($movieId);

            return redirect()->back();
        } catch (Exception) {
            return redirect()
                ->back()
                ->withErrors('Something went wrong when adding the movie to the list!', 'addToList');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $list = MovieList::findOrFail($id);
            $user = Auth::user();

            if (! $list->isOwnedBy($user->id)) {
                throw new Exception('You are not allowed to delete this list');
            }

            $list->delete();

            return redirect(route('lists', ['username' => $user->username]));
        } catch (Exception) {
            return redirect()
                ->back()
                ->withErrors('Something went wrong when deleting the list!', 'deleteList');
        }
    }
}
