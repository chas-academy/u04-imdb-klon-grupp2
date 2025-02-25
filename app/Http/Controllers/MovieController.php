<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topRatedMovies = Movie::orderByDesc('rating_average')->limit(11)->get();
        $latestMovies = Movie::latest()->limit(30)->get();

        if (Auth::check()) {
            $user = Auth::user();
            $userLists = $user->lists()->with('movies');
            $lists = $userLists->latest('updated_at')->limit(10)->get();
            $latestUpdatedList = $lists->first();
            $latestCreatedList = $userLists->latest()->first();

            if ($lists->count() > 0) {
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

                if ($latestUpdatedList->id == $latestCreatedList->id) {
                    $latestUpdatedList = $userLists->where('lists.id', '!=', $latestCreatedList->id)->latest('updated_at')->first();
                }
            }

            return view('home', [
                'topRatedMovies' => $topRatedMovies,
                'myLists' => $lists,
                'latestCreatedList' => $latestCreatedList,
                'latestUpdatedList' => $latestUpdatedList,
                'latestMovies' => $latestMovies,
                'user' => $user,
            ]);
        }

        return view('home', compact('latestMovies', 'topRatedMovies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-movie');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::with(['reviews', 'genres'])->findOrFail($id);
        $user = Auth::user();
        $isAdmin = $user && $user->role === 'admin';
        $userLists = $user ?
            User::with('lists')
                ->findOrFail($user->id)
                ->lists
                ->map(fn ($list) => [
                    'id' => $list->id,
                    'title' => $list->title,
                    'posters' => $list->movies->map(fn ($movie) => [
                        'src' => $movie->poster,
                        'title' => $movie->title,
                        'id' => $movie->id,
                    ]),
                ]) :
            null;

        return view('movie', [
            'movie' => $movie,
            'isAdmin' => $isAdmin,
            'reviews' => $movie->reviews,
            'userLists' => $userLists,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            $user = Auth::user();

            if (! $user || $user->role !== 'admin') {
                throw new Exception('You are not allowed to delete this movie!');
            }

            // TODO: remove local poster and cover_image files

            $movie->delete();

            return redirect(route('admin.dashboard'));
        } catch (Exception) {
            return redirect()
                ->back()
                ->withErrors('Something went wrong with deleting the movie!', 'deleteMovie');
        }
    }
}
