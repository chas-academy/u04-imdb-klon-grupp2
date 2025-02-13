<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($username): View
    {
        $profile = User::where('username', $username)
            ->with([
                'lists' => function ($query) {
                    $query->orderByDesc('created_at')->orderByDesc('id')->take(4)->with(['movies' => function ($query) {
                        $query->orderByDesc('list_movie.created_at')->orderByDesc('id')->take(4);
                    }]);
                },
                'reviews' => function ($query) {
                    $query->take(4)->with('movie');
                },
            ])
            ->firstOrFail();

        $isCurrentUserProfile = Auth::check() && $username === Auth::user()->username;

        return view('profile', [
            'username' => $username,
            'isCurrentUserProfile' => $isCurrentUserProfile,
            'lists' => $profile->lists->map(fn ($list) => [
                'id' => $list->id,
                'title' => $list->title,
                'posters' => $list->movies->map(fn ($movie) => [
                    'src' => $movie->poster,
                    'title' => $movie->title,
                ]),
            ]
            ),
            'reviews' => $profile->reviews,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
