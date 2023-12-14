<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('foods', [ApiController::class, 'getFoods']);
Route::get('topReviewFood', [ApiController::class, 'topReviewFood']);
Route::get('foods/{id}', [ApiController::class, 'search']);

Route::get('foods/{id}/delete', [ApiController::class, 'deleteFoods']);


Route::get('reviews', [ApiController::class, 'getReviews']);
Route::get('reviews/{id}', [ApiController::class, 'searchReviews']);
Route::get('reviews/{id}/delete', [ApiController::class, 'deleteReviews']);


Route::get('users', [ApiController::class, 'getUsers']);
Route::get('users/{id}', [ApiController::class, 'searchUsers']);
Route::get('users/{id}/delete', [ApiController::class, 'deleteUsers']);
