<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Mail\NewJobNotification;
use Illuminate\Support\Facades\Mail;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Board::latest()->get();
        return view('boards.index', [
            'boards' => Board::latest()->with('user')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('boards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'required|email',
            'user_id' => 'required',
        ]);

        // Check if the email has posted a job before
        $existingJob = Board::where('email', $validatedData['email'])->first();

        // Create the job posting
        $board = Board::create($validatedData);

        if (!$existingJob) {
            // This is the first time posting, notify the admin
           Mail::to('admin@domain.com')->send(new NewJobNotification($board));
        }


        return redirect()->route('boards.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        return view('boards.show', [
            'board' => $board
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Board $board)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $board->update($validatedData);

        return response()->json([
            'message' => 'Job updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        $board->delete();

        return response()->json([
            'message' => 'Job deleted successfully!',
        ]);
    }

/**
     * Approve (publish) the specified job posting.
     *
     * @param  \App\Models\Board $board
     * @return \Illuminate\Http\Response
     */
    public function approve(Board $board)
    {
        // Implement your logic to approve the job posting
        $board->update(['approved' => true]);

        return redirect()->route('boards.index');
    }

    /**
     * Mark the specified job posting as spam.
     *
     * @param  \App\Models\Board $board
     * @return \Illuminate\Http\Response
     */
    public function spam(Board $board)
    {
        // Implement your logic to mark the job posting as spam
        $board->update(['approved' => false]);

        return redirect()->route('boards.index');
    }

}
