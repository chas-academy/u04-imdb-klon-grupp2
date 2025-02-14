<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $latestUploadedMovies = Movie::latest()->limit(10)->get();

        $reportedReviews = Report::with(['review', 'user'])
            ->whereNotNull(['user_id', 'review_id'])
            ->with('user')
            ->latest()
            ->get();

        $reportedUsers = Report::whereNotNull('reason')
            ->whereNotNull('user_id')
            ->whereNull('review_id')
            ->with('user')
            ->latest()
            ->get()
            ->unique('user_id');

        return view('admin.dashboard', compact('latestUploadedMovies', 'reportedReviews', 'reportedUsers'));
    }

    public function users()
    {
        $users = User::orderBy('username')->get();

        return view('admin.users', compact('users'));
    }

    public function createUserForm()
    {
        return view('admin.create-user');
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

        return redirect(route('movie', ['id' => $movie->id, 'title' => $movie->title])); //->with('success', 'Movie created successfully.');
    }

    public function createUser(Request $request) //: RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9]+$/', 'min:3', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ], [
            'username.regex' => 'The username contains invalid characters.',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->is_admin == 'on' ? 'admin' : 'user',
        ]);

        event(new Registered($user));

        return redirect(route('admin.dashboard')); //->with('success', 'User created successfully.');
    }

    public function editMovieForm($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.edit-movie', compact('movie'));
    }

    public function editMovie(Request $request, $id): RedirectResponse
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:' . Movie::class . ',title,' . $id, 'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s\-:]*[a-zA-Z0-9]$/'],
            'description' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1850', 'max:' . (date('Y') + 1)],
            'director' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s\-:]*[a-zA-Z0-9]$/'],
            'duration' => ['required', 'string', 'max:6'], // TODO: fix regex
            'poster' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'],
        ], [
            'title.regex' => 'The title contains invalid characters.',
            'director.regex' => 'The director contains invalid characters.',
            'year.min' => 'We only accept movies from 1850 onwards.',
            'year.max' => 'The year must be less than ' . (date('Y') + 1),
            'year.integer' => 'The year field must contain numbers.',
        ]);

        $movie->update([
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'director' => $request->director,
            'duration' => $request->duration,
        ]);

        if ($request->hasFile('poster')) {
            if ($movie->poster) {
                Storage::disk('public')->delete('movies/' . $movie->id . '/' . $movie->poster);
            }

            $posterFile = $request->file('poster');
            $posterFilename = 'poster_' . $posterFile->getClientOriginalName();
            $posterPath = 'movies/' . $movie->id . '/' . $posterFilename;
            Storage::disk('public')->put($posterPath, $posterFile->get());
            $movie->update(['poster' => $posterFilename]);
        }

        if ($request->hasFile('cover_image')) {
            if ($movie->cover_image) {
                Storage::disk('public')->delete('movies/' . $movie->id . '/' . $movie->cover_image);
            }

            $coverFile = $request->file('cover_image');
            $coverFilename = 'cover_' . $coverFile->getClientOriginalName();
            $coverPath = 'movies/' . $movie->id . '/' . $coverFilename;
            Storage::disk('public')->put($coverPath, $coverFile->get());
            $movie->update(['cover_image' => $coverFilename]);
        }

        return redirect(route('movie', ['id' => $movie->id, 'title' => $movie->title]))->with('success', 'Movie updated successfully.');
    }
}
