<?php

namespace App\Http\Controllers;

use App\Models\MovieList;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $lists = $user->lists()->with('movies')->get();

        return view('lists', ['user' => $user, 'lists' => $lists]);
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
                ->withErrors('Something went wrong when creating the list!', 'createList');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieList $list)
    {
        return view('movie-list');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieList $list)
    {
        //
    }
}
