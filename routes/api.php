<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// import voting controller
use App\Http\Controllers\VotingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

// route for candidate login
Route::post('/candidate/register', [VotingController::class, 'cRegister']);
// get all candidates
Route::get('/candidate', [VotingController::class, 'getAllCandidates']);
// get candidate by id
Route::get('/candidate/{id}', [VotingController::class, 'getCandidateById']);
// OTP
Route::post('/send-sms', [VotingController::class, 'sendSMS']);
// voting
Route::post('/vote', [VotingController::class, 'vote']);
// count vote
Route::get('/count-vote', [VotingController::class, 'countVote']);
