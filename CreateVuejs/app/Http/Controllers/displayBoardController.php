<?php

namespace App\Http\Controllers;

use App\Models\DisplayBoard;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class displayBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('DisplayBoard/index', [
            'posts' => DisplayBoard::latest()->get()
        ]);
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
        // Store the image in storage/app/public/display_boards
        $imagePath = $request->file('image')->store('display_boards', 'public');

        // Create the new display board record
        DisplayBoard::create([
            'title' => $request['title'],
            'image' => $imagePath,  // store the image path
            'description' => $request['description'],
            'user_id' => 1,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
