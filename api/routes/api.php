<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
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

Route::get('/status', function () {
    return response()->json([
        'version' => app()->version()
    ], 200);
});

Route::group([
    'controller' => AuthController::class,
    'prefix' => 'auth'
], function () {
    Route::get('check', 'check');
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::group([
    'controller' => UserController::class,
    'prefix' => 'user',
], function () {
    Route::get('/', 'show');
    Route::patch('/', 'update');
    Route::get('/profile', 'showProfile');
    Route::patch('/password', 'updatePassword');
    Route::post('/avatar', 'updateAvatar');
    Route::delete('/avatar', 'deleteAvatar');
});

Route::group([
    'prefix' => 'profile/{user:username}',
], function () {
    Route::get('/', [UserProfileController::class, 'show']);
    Route::patch('/', [UserProfileController::class, 'update']);

    Route::get('/followers', [FollowerController::class, 'followers']);
    Route::get('/following', [FollowerController::class, 'following']);
});

Route::group([
    'controller' => FollowerController::class,
    'prefix' => 'user'
], function(){
    Route::get('/suggestions', 'suggestions');
});

Route::group([
    'controller' => FollowerController::class,
    'prefix' => 'follow/{user:username}'
], function () {
    Route::post('/', [FollowerController::class, 'store']);
    Route::delete('/', [FollowerController::class, 'destroy']);
});

Route::group([], function () {
    Route::resources(['posts' => PostController::class]);
    Route::resources(['comments' => CommentController::class]);
});

Route::post('/likes', [LikeController::class, 'store']);

Route::group([
    'prefix' => 'feed',
    'controller' => FeedController::class,
], function () {
    Route::get('/default','index');
    Route::get('/latest', 'new');
    Route::get('/popular', 'popular');
    Route::get('/friends', 'friends');
});
