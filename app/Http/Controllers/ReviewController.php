<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $reviews = Review::with('movie')->where('user_id', $user->id)->get();
        $isCurrentUserProfile = Auth::check() && $username === Auth::user()->username;

        return view('reviews', [
            'reviews' => $reviews,
            'username' => $username,
            'isCurrentUserProfile' => $isCurrentUserProfile,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validateWithBag('createReviewValidation', [
            'rating' => ['required', 'integer', 'min:1', 'max:10'],
            'content' => ['nullable', 'string', 'max:800'],
        ]);

        try {
            $user = Auth::user();

            $review = Review::create([
                'rating' => $request->rating,
                'content' => $request->content,
                'user_id' => $user->id,
                'movie_id' => $id,
            ]);

            return redirect(route('review', ['id' => $review->id]));
        } catch (Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Something went wrong when publishing the review!', 'createReview');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $review = Review::with(['user', 'movie'])->findOrFail($id);
        $isAuthor = Auth::check() && $review->isWrittenBy(Auth::user());

        $previousUrl = url()->previous();
        $backLink = Str::contains($previousUrl, ['/m/', '/u/'])
            ? $previousUrl
            : route('movie', ['id' => $review->movie->id, 'title' => $review->movie->title]);

        return view('review', ['review' => $review, 'isAuthor' => $isAuthor, 'backLink' => $backLink]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validateWithBag('updateReviewValidation', [
            'rating' => ['required', 'integer', 'min:1', 'max:10'],
            'content' => ['nullable', 'string', 'max:800'],
        ]);

        try {
            $review = Review::findOrFail($id);
            $user = Auth::user();

            if (! $review->isWrittenBy($user)) {
                throw new Exception('You are not allowed to edit this review');
            }

            $review->update([
                'rating' => $request->rating,
                'content' => $request->content,
            ]);

            return redirect(route('review', ['id' => $review->id]));
        } catch (Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Something went wrong when updating the review!', 'updateReview');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);
            $user = Auth::user();

            if (! $review->isWrittenBy($user) && $user->role !== 'admin') {
                throw new Exception('You are not allowed to delete this review');
            }

            $review->delete();

            return redirect(route('home'));
        } catch (Exception) {
            return redirect()
                ->back()
                ->withErrors('Something went wrong when deleting the review!', 'deleteReview');
        }
    }
}
