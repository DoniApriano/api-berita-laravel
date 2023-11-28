<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BookmarkController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\FollowController;
use App\Http\Controllers\api\NewsController;
use App\Http\Controllers\api\NotificationsController;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\SubmissionController;
use App\Http\Controllers\api\UserController;
use App\Models\News;
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
    Route::post('/news/{id}', [NewsController::class, 'update'])->middleware('news-owner');
    Route::delete('/news/{id}', [NewsController::class, 'delete'])->middleware('news-owner');
    Route::get('/latestNews', [NewsController::class, 'latestNews']);
    Route::get('/news/{id}/user', [NewsController::class, 'showNewsByUserId']);
    Route::get('/news/{id}/categoryPaginate', [NewsController::class, 'showNewsByCategoryIdPaginate']);
    Route::get('/news/{id}/categoryAll', [NewsController::class, 'showNewsByCategoryIdAll']);
    Route::get('/allNewsByFollowing', [NewsController::class, 'showNewsByFollowing']);
    Route::get('/search/{search}', [NewsController::class, 'searchNewsAndUser']);
    Route::post('/tren/{id}',[NewsController::class,'addTren']);
    Route::get('/tren',[NewsController::class,'getTren']);

    // Route Comment
    Route::get('/comment', [CommentController::class, 'index']);
    Route::get('/news/{id}/comment', [CommentController::class, 'showCommentByNews']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::delete('/comment/{id}', [CommentController::class, 'delete']);

    // Route ...
    Route::get('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/changePassword', [AuthController::class, 'changePassword']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/user/{id}', [UserController::class, 'getUser']);
    Route::post('/user/update', [UserController::class, 'update']);

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
    Route::get('/reportCommentReported', [ReportController::class, 'showReportForReported']);
    Route::get('/reportCommentReporter', [ReportController::class, 'showReportForReporter']);

    // Route Category
    Route::get('/category', [CategoryController::class, 'index']);

    // Route Bookmark
    Route::get('/bookmarks', [BookmarkController::class, 'index']);
    Route::post('/bookmarks', [BookmarkController::class, 'store']);
    Route::delete('/bookmarks/{newsId}', [BookmarkController::class, 'delete']);

    // Route Submission
    Route::post('/submission',[SubmissionController::class,'store']);
    Route::get('/submission',[SubmissionController::class,'show']);
});
