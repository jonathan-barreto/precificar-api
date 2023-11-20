<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;

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

Route::get('/users/list/{id}', [UserController::class, 'getUsersList']);

Route::get('/users/following/{id}', [UserController::class, 'followingUsers']);

Route::get('/users/stories/{id}', [StoryController::class, 'getUserStories']);

Route::post('/users/stories', [StoryController::class, 'uploadStory']);

Route::post('/follow-user', [FollowerController::class, 'followUser']);

Route::delete('/unfollow-user', [FollowerController::class, 'unfollowUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
