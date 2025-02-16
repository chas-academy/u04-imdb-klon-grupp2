<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validateWithBag('createReportValidation', [
            'reason' => ['required', 'string', 'max:255'],
        ]);

        try {
            $reviewId = $request->is('review/*') ? $id : null;
            $userId = $request->is('profile/*') ? $id : null;

            Report::create([
                'reason' => $request->reason,
                'review_id' => $reviewId,
                'user_id' => $userId,
            ]);

            return redirect(url()->previous());
        } catch (Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Something went wrong when creating the report!', 'createReport');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    public function reportedReviews()
    {
        $reports = Report::with(['review'])->whereNotNull(['review_id'])->where('decision_made', false)->latest()->get();

        foreach ($reports as $report) {
            $report->user = User::where('id', $report->review->user_id)->first();
        }

        return view('admin.reported-reviews', compact('reports'));
    }

    public function reportedUsers()
    {
        $reports = Report::with(['review', 'user'])->whereNotNull(['user_id'])->where('decision_made', false)->orderBy('updated_at')->get();

        $users = $reports->map(function ($report) {
            return User::where('id', $report->user_id)->first();
        })->unique();

        return view('admin.reported-users', compact('users'));
    }

    public function showUserReports($username)
    {
        $user = User::where('username', $username)->first();
        $reports = Report::where('user_id', $user->id)->where('decision_made', false)->orderBy('updated_at')->get();

        return view('admin.reported-user', compact('reports', 'user'));
    }

    public function showReviewReport($id)
    {
        $report = Report::with(['review'])->where('id', $id)->first();
        $report->user = User::where('id', $report->review->user_id)->first();

        return view('admin.reported-review', compact('report'));
    }

    public function clearUserReport($username, $id)
    {
        $report = Report::where('id', $id)->firstOrFail();
        $report->decision_made = true;
        $report->save();

        $user = User::where('username', $username)->firstOrFail();
        $n_reports = Report::where('user_id', $user->id)->where('decision_made', false)->count();

        return $n_reports == 0 ? redirect(route('admin.dashboard')) : redirect(route('reported.user', $username));
    }

    public function clearReviewReport($id)
    {
        $report = Report::where('id', $id)->firstOrFail();
        $report->decision_made = true;
        $report->save();

        return redirect(route('reported.reviews'));
    }

    public function deleteReview($id)
    {
        $report = Report::where('id', $id)->firstOrFail();
        $review = Review::where('id', $report->review_id)->firstOrFail();
        $review->delete();

        return redirect(route('reported.reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
