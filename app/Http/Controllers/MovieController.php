<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
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
            $user = User::findOrFail(Auth::user()->id);
            $lists = $user->lists()->with('movies')->latest()->limit(10)->get();
            $latestList = $lists->first();
            $latestEdited = $user->lists()->with('movies')->latest('updated_at')->first();
            $lists = $lists->map(function ($list) {
                return [
                    'id' => $list->id,
                    'title' => $list->title,
                    'posters' => $list->movies->map(fn($movie) => [
                        'src' => $movie->poster,
                        'title' => $movie->title,
                    ]),
                ];
            });

            if ($latestList && $latestEdited && $latestList->id === $latestEdited->id) {
                $latestEdited = $user->lists()->with('movies')->where('lists.id', '!=', $latestList->id)->latest('updated_at')->first();
            }

            return view('home', [
                'topRatedMovies' => $topRatedMovies,
                'myLists' => $lists,
                'latestList' => $latestList,
                'latestEdited' => $latestEdited,
                'latestMovies' => $latestMovies,
                'user' => $user,
            ]);
        }

        return view('home', ['latestMovies' => $latestMovies, 'topRatedMovies' => $topRatedMovies]);
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
    public function show(Movie $movie)
    {
        return view('movie');
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
    public function destroy(Movie $movie)
    {
        //
    }
}
