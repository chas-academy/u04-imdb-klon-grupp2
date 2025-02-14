<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $latestUploadedMovies = Movie::latest()->limit(10)->get();

        $reportedReviews = Report::with(['review', 'user'])
            ->whereNotNull(['user_id', 'review_id'])
            ->with('user')
            ->latest()
            ->take(3)
            ->get();

        $reportedUsers = Report::whereNotNull('reason')
            ->whereNotNull('user_id')
            ->whereNull('review_id')
            ->with('user')
            ->latest()
            ->take(7)
            ->get();

        $pendingReportedReviews = Report::with(['review', 'user'])
            ->whereNotNull(['user_id', 'review_id'])
            ->with('user')
            ->latest()
            ->count();

        $pendingReportedUsers = Report::whereNotNull('reason')
            ->whereNotNull('user_id')
            ->whereNull('review_id')
            ->with('user')
            ->latest()
            ->count();

        return view('admin.dashboard', compact('latestUploadedMovies', 'reportedReviews', 'reportedUsers', 'pendingReportedReviews', 'pendingReportedUsers'));
    }

    public function users()
    {
        $users = User::orderBy('username')->get();

        return view('admin.users', compact('users'));
    }

    public function createMovieForm()
    {
        return view('admin.create-movie');
    }

    public function createMovie(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:' . Movie::class, 'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s\-:]*[a-zA-Z0-9]$/'],
            'description' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1850', 'max:' . (date('Y') + 1)],
            'director' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s\-:]*[a-zA-Z0-9]$/'],
            'duration' => ['required', 'string', 'max:6'], // TODO: fix regex
            'poster' => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
            'cover_image' => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
        ], [
            'title.regex' => 'The title contains invalid characters.',
            'director.regex' => 'The director contains invalid characters.',
            'year.min' => 'We only accept movies from 1850 onwards.',
            'year.max' => 'The year must be less than ' . (date('Y') + 1),
            'year.integer' => 'The year field must contain numbers.',
        ]);

        $posterFile = $request->file('poster');
        $coverFile = $request->file('cover_image');

        $posterFilename = 'poster_' . $posterFile->getClientOriginalName();
        $coverFilename = 'cover_' . $coverFile->getClientOriginalName();

        $movie = Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'director' => $request->director,
            'duration' => $request->duration,
            'poster' => $posterFilename,
            'cover_image' => $coverFilename,
            'rating_average' => 0.0,
            'rating_amount' => 0
        ]);

        $posterPath = 'movies/' . $movie->id . '/' . $posterFilename;
        $coverPath = 'movies/' . $movie->id . '/' . $coverFilename;

        Storage::disk('public')->put($posterPath, $posterFile->get());
        Storage::disk('public')->put($coverPath, $coverFile->get());

        event(new Registered($movie));

        return redirect(route('admin.create.movie')); //->with('success', 'Movie created successfully.');
    }
}
