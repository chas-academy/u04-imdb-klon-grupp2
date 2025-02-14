<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class ReportController extends Controller
{
    /**
     * 
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
        $reports = Report::with(['review', 'user'])->whereNotNull(['review_id', 'user_id'])->orderBy('updated_at')->get();

        return view('admin.reported-reviews', compact('reports'));
    }

    public function reportedUsers()
    {
        $reports = Report::with(['review', 'user'])->whereNotNull(['user_id'])->whereNull(['review_id'])->orderBy('updated_at')->get();

        $users = $reports->map(function ($report) {
            return User::where('id', $report->user_id)->first();
        })->unique();

        return view('admin.reported-users', compact('users'));
    }

    public function showUserReports($username)
    {
        $user = User::where('username', $username)->first();
        $reports = Report::where('user_id', $user->id)->whereNull(['review_id'])->orderBy('updated_at')->get();

        return view('admin.reported-user', compact('reports', 'username'));
    }

    public function showReviewReport($id)
    {
        $report = Report::with(['review', 'user'])->where('id', $id)->first();

        return view('admin.reported-review', compact('report'));
    }

    public function clearReport($id)
    {
        Report::where('id', $id)->delete();

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
