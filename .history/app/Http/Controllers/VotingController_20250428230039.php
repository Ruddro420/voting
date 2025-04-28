<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingModel;

class VotingController extends Controller
{
    /**
     * Register a new candidate
     */
    public function cRegister(Request $request)
    {
        $votingData = $request->all(); // Get all request data first

        // Handle Image Upload
        if ($request->hasFile('pImage')) {
            $file = $request->file('pImage');
            $filename = time() . '_' . $file->getClientOriginalName(); // Use timestamp to avoid duplicate filenames
            $file->move(public_path('admin/image'), $filename);
            $votingData['pImage'] = $filename; // Set the filename into data array
        }

        // Now create with modified data
        $voting = VotingModel::create($votingData);

        return response()->json($voting);
    }


    /**
     * Get All Candidates
     */
    public function getAllCandidates()
    {
        $candidates = VotingModel::all(); // Fetch all candidates from the database
        return response()->json($candidates); // Return as JSON response
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
