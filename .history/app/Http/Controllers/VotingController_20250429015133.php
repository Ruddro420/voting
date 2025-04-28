<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingModel;
use App\Models\Vote;
use Illuminate\Support\Facades\Http;

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
     * Get Candidate by ID
     */
    public function getCandidateById($id)
    {
        $candidate = VotingModel::find($id); // Find candidate by ID
        if (!$candidate) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }
        return response()->json($candidate); // Return as JSON response
    }

    // SEND OTP
    public function sendSMS(Request $request)
    {
        try {
            $validated = $request->validate([
                'number' => 'required|string',
                'message' => 'required|string',
            ]);

            $apiKey = env('BULKSMS_API_KEY', 'C8X9t0e3OB3I0r479Q2Q');
            $senderId = '8809617625216';

            // Send the SMS via the external SMS API
            $response = Http::get('https://bulksmsbd.net/api/smsapi', [
                'api_key' => $apiKey,
                'type' => 'text',
                'number' => $validated['number'],
                'senderid' => $senderId,
                'message' => $validated['message'],
            ]);

            return response()->json(['message' => 'SMS sent successfully', 'data' => $response->json()]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send SMS'], 500);
        }
    }
    // voting
    public function vote(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'cId' => 'required',
            'cName' => 'required|string',
            'vote' => 'required|integer',
        ]);

        // Check if the user has already voted
        $existingVote = Vote::where('phone', $validated['phone'])
            ->where('cId', $validated['cId'])
            ->first();

        if ($existingVote) {
            return response()->json(['message' => 'You have already voted for this candidate'], 400);
        }

        // Create a new vote
        $vote = Vote::create($validated);

        return response()->json(['message' => 'Vote recorded successfully', 'data' => $vote]);
    }
}
