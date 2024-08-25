<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

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

// Public routes of authtication
Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

// Protected routes of movie, rating and logout
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/movies', MovieController::class)->except('index', 'show');
    Route::apiResource('/ratings', RatingController::class)->except('index', 'show');
});

// Public routes of Movie
Route::controller(MovieController::class)->group(function() {
    Route::get('/movies', 'index');
    Route::get('/movies/{movie}', 'show');
});

// Public routes of Rating
Route::controller(RatingController::class)->group(function() {
    Route::get('/rating', 'index');
    Route::get('/rating/{rating}', 'show');
    
});
