<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AuthController;

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
Route::post('auth/login', [AuthController::class, 'login']);


/* ------------- Subjects ------------ */
// Get All Subjects
Route::get('subjects', [SubjectController::class, 'index']);
// Get Subject by ID
Route::get('subjects/{id}', [SubjectController::class, 'getById']);



/* ------------- Offers ------------ */
Route::get('offers', [OfferController::class, 'index']);
Route::get('offers/{id}', [OfferController::class, 'getById']);
Route::get('offers/getByUserId/{id}', [OfferController::class, 'getByUserId']);
//Route::get('offers/getByTutorId/{id}', [OfferController::class, 'getByTutorId']);
Route::get('offers/getBySubjectId/{id}', [OfferController::class, 'getBySubjectId']);



// MUSS NOCH IN AUTH
/* ------------- Users ------------ */
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'getById']);
Route::post('users', [UserController::class, 'save']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'delete']);

/* -------------                        ------------ */
/* ------------- Authenticated Requests ------------ */
/* -------------                        ------------ */
Route::group(['middleware' => ['api', 'auth.jwt']], function (){
    // Logout
    Route::post('auth/logout', [AuthController::class,'logout']);

    /* ------------- Subjects ------------ */
    Route::post('subjects', [SubjectController::class, 'save']);
    Route::put('subjects/{id}', [SubjectController::class, 'update']);
    Route::delete('subjects/{id}', [SubjectController::class, 'delete']);

    /* ------------- Offers ------------ */
    Route::post('offers', [OfferController::class, 'save']);
    Route::put('offers/{id}', [OfferController::class, 'update']);
    Route::delete('offers/{id}', [OfferController::class, 'delete']);



    /* ------------- Requests ------------ */
    Route::get('requests', [RequestController::class, 'index']);
    Route::get('requests/{id}', [RequestController::class, 'getById']);
    Route::get('requests/getPendingByTutorId/{id}', [RequestController::class, 'getPendingByTutorId']);
    Route::get('getRequestsByUserIdAndOfferId', [RequestController::class, 'getRequestsByUserIdAndOfferId']);
    Route::post('requests', [RequestController::class, 'save']);
    Route::put('requests/{id}', [RequestController::class, 'update']);
    Route::delete('requests/{id}', [RequestController::class, 'delete']);

    /* ------------- Messages ------------ */
    Route::get('messages', [MessageController::class, 'index']);
    Route::get('messages/{id}', [MessageController::class, 'getById']);
    //Get all messages by user id
    Route::get('messages/getByUserId/{id}', [MessageController::class, 'getByUserId']);
    Route::post('messages', [MessageController::class, 'save']);
    Route::put('messages/{id}', [MessageController::class, 'update']);
    Route::delete('messages/{id}', [MessageController::class, 'delete']);
});
