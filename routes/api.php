<?php

use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;

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
Route::get('/list-users/{user_id}', [StoryController::class, 'listUsers']);

Route::get('/user-stories/{user_id}', [StoryController::class, 'showUserStories']);

Route::post('/create-story', [StoryController::class, 'createStory']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
