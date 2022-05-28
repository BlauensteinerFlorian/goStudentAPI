<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* ------------- Login ------------ */
Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login']);


/* ------------- Subjects ------------ */
// Get All Subjects
Route::get('subjects', [SubjectController::class, 'index']);

// Get Subject by ID
Route::get('subjects/{id}', [SubjectController::class, 'getById']);


// Auth needed -> added later
Route::post('subjects', [SubjectController::class, 'save']);
Route::put('subjects/{id}', [SubjectController::class, 'update']);
Route::delete('subjects/{id}', [SubjectController::class, 'delete']);


/* ------------- Offers ------------ */
Route::get('offers', [OfferController::class, 'index']);
Route::get('offers/{id}', [OfferController::class, 'getById']);
Route::get('offers/getByStudentId/{id}', [OfferController::class, 'getByStudentId']);
Route::get('offers/getByTutorId/{id}', [OfferController::class, 'getByTutorId']);
Route::get('offers/getBySubjectId/{id}', [OfferController::class, 'getBySubjectId']);
// Auth needed -> added later
Route::post('offers', [OfferController::class, 'save']);
Route::put('offers/{id}', [OfferController::class, 'update']);
Route::delete('offers/{id}', [OfferController::class, 'delete']);


/* ------------- Users ------------ */
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'getById']);
// Auth needed -> added later
Route::post('users', [UserController::class, 'save']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'delete']);

/* ------------- Requests ------------ */
Route::get('requests', [RequestController::class, 'index']);
Route::get('requests/{id}', [RequestController::class, 'getById']);
Route::get('requests/getPendingByTutorId/{id}', [RequestController::class, 'getPendingByTutorId']);
// Auth needed -> added later
Route::post('requests', [RequestController::class, 'save']);
Route::put('requests/{id}', [RequestController::class, 'update']);
Route::delete('requests/{id}', [RequestController::class, 'delete']);

/* ------------- Messages ------------ */
Route::get('messages', [MessageController::class, 'index']);
Route::get('messages/{id}', [MessageController::class, 'getById']);
//Get all messages by user id
Route::get('messages/getByUserId/{id}', [MessageController::class, 'getByUserId']);
// Auth needed -> added later
Route::post('messages', [MessageController::class, 'save']);
Route::put('messages/{id}', [MessageController::class, 'update']);
Route::delete('messages/{id}', [MessageController::class, 'delete']);
