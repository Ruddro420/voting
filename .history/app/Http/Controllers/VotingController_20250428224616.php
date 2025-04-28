<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingModel;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cRegister(Request $request)
    {
        // ['name', 'phone', 'pName', 'pImage', 'pDetails', 'liveLink', 'githubLink', 'status'];

        //For Image
        if ($request->file('pImage')) {
            $file = $request->file('pImage');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('admin/image'), $filename);
            $voting['pImage'] = $filename;
        }
        $voting = VotingModel::create($request->all());
        return response()->json($voting);
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
