<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post('/auth/register',[AuthController::class,'register']);

Route::middleware('firebase')->group(function() {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::apiResource('/posts',PostController::class)->only([
        'index','store','show','destroy'
    ]);
    Route::get('/posts/{id}/comments',[CommentController::class, 'show']);
    Route::post('/comments',[CommentController::class, 'store']);
    Route::post('/likes',[LikeController::class, 'store']);
    Route::delete('/likes', [LikeController::class,'destroy']);
});
