<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Report;
use App\Models\User;

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
}
