<?php

namespace App\Http\Controllers;

use App\Models\MovieList;
use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lists');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieList $list)
    {
        return view('movie-list');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovieList $list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovieList $list)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieList $list)
    {
        //
    }
}
