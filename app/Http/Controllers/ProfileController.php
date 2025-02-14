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
        $user = User::where('username', $username)->firstOrFail();
        $isCurrentUserProfile = Auth::check() && $username === Auth::user()->username;

        $lists = $user->lists()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->take(4)
            ->with(['movies' => function ($query) {
                $query
                    ->orderByDesc('list_movie.created_at')
                    ->orderByDesc('id')
                    ->take(4);
            }])
            ->get();
        $listCount = $user->lists()->count();

        $reviews = $user->reviews()->take(4)->with('movie')->get();
        $reviewCount = $user->reviews()->count();

        return view('profile', [
            'user' => $user,
            'isCurrentUserProfile' => $isCurrentUserProfile,
            'lists' => $lists->map(fn ($list) => [
                'id' => $list->id,
                'title' => $list->title,
                'posters' => $list->movies->map(fn ($movie) => [
                    'src' => $movie->poster,
                    'title' => $movie->title,
                ]),
            ]
            ),
            'reviews' => $reviews,
            'statistics' => [
                'lists' => $listCount,
                'reviews' => $reviewCount,
            ],
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
