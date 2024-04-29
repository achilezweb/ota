<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Mail\NewJobNotification;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

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

    /**
     * Display a job listing from external api.
     */
    public function list()
    {

        // Initialize Guzzle client
        $client = new Client();

        try {
            // Send GET request to fetch XML data
            $response = $client->get('https://mrge-group-gmbh.jobs.personio.de/xml');

            // Get XML data from the response body
            $xmlData = $response->getBody()->getContents();

            // Parse XML data
            $xml = new SimpleXMLElement($xmlData);

            // Initialize arrays to store titles and descriptions
            $jobs = [];

            // Loop through job positions
            foreach ($xml->position as $position) {
                $title = (string) $position->name;
                $description = (string) $position->jobDescriptions->jobDescription[0]->value;

                // Add title and description to jobs array
                $jobs[] = [
                    'title' => $title,
                    'description' => $description,
                ];
            }

            // Extract title and description
            $title = $jobs[0]['title'];
            $description = $jobs[0]['description'];

            // Return the title and description to the view
            return view('boards.list', compact('title', 'description'));

        } catch (\Exception $e) {
            // Handle exception (e.g., connection error)
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

}
