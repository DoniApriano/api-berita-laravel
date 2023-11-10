<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\FollowController;
use App\Http\Controllers\api\NewsController;
use App\Http\Controllers\api\NotificationsController;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Route News
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show']);
    Route::post('/news', [NewsController::class, 'store']);
    Route::put('/news/{id}', [NewsController::class, 'update'])->middleware('news-owner');
    Route::delete('/news/{id}', [NewsController::class, 'delete'])->middleware('news-owner');
    Route::get('/news/{id}/user', [NewsController::class, 'showNewsByUserId']);
    Route::get('/news/{id}/categoryPaginate', [NewsController::class, 'showNewsByCategoryIdPaginate']);
    Route::get('/news/{id}/categoryAll', [NewsController::class, 'showNewsByCategoryIdAll']);

    // Route Comment
    Route::get('/comment', [CommentController::class, 'index']);
    Route::get('/news/{id}/comment', [CommentController::class, 'showCommentByNews']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::delete('/comment/{id}', [CommentController::class, 'delete']);

    // Route ...
    Route::get('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/user/{id}', [UserController::class, 'getUser']);

    // Route Follow
    Route::post('/follow', [FollowController::class, 'follow']);
    Route::delete('/unFollow/{id}', [FollowController::class, 'unFollow']);
    Route::get('/showFollowing/{id}', [FollowController::class, 'showFollowing']);
    Route::get('/showFollowers/{id}', [FollowController::class, 'showFollowers']);
    Route::get('/showFollowingByToken', [FollowController::class, 'showFollowingByToken']);
    Route::get('/showFollowingNewsByToken', [FollowController::class, 'showFollowingNewsByToken']);
    Route::get('/checkIfFollowing/{id}', [FollowController::class, 'checkIfFollowing']);

    // Route Report
    Route::post('/reportComment', [ReportController::class, 'reportComment']);
    Route::post('/reportNews', [ReportController::class, 'reportNews']);

    // Route notifications
    Route::get('/notif', [NotificationsController::class, 'showNotifications']);

    // Route Category
    Route::get('/category', [CategoryController::class, 'index']);
});
