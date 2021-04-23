<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserHeaderImgController;
use App\Http\Controllers\CalligraphyClassController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * メール認証
 */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/**
 * post
 */
Route::get('/posts', [PostController::class, 'index'])->name('postIndex');
Route::get('/post/create', [PostController::class, 'create'])->name('postCreate');
Route::post('/post', [PostController::class, 'store'])->name('postStore');
Route::get('/post/{id}', [PostController::class, 'show'])->name('postShow');
// Route::get('/post/{id}}/edit', [PostController::class, 'edit'])->name('postEdit');
// Route::put('/posts/update/{id}}', [PostController::class, 'update'])->name('postUpdate');
Route::delete('/posts/{id}}', [PostController::class, 'destroy'])->name('postDestroy');
Route::get('/posts/search', [PostController::class, 'search'])->name('postSearch');
Route::get('/posts/userSearch', [PostController::class, 'userSearch'])->name('userSearch');
Route::get('/posts/popular/{nextPage}', [PostController::class, 'popular'])->name('postPopular');
Route::get('/posts/searchWord/{searchWords}/{nextPage}', [PostController::class, 'searchWord'])->name('searchWord');
Route::get('/posts/searchComment/{searchWords}/{nextPage}', [PostController::class, 'searchComment'])->name('searchComment');



Route::get('/', function () {
    return redirect('/posts');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/like', [LikeController::class, 'store'])->name('likeStore');
Route::post('/deletelike', [LikeController::class, 'destroy'])->name('likeDestroy');

Route::post('/comment', [CommentController::class, 'store'])->name('commentStore');
Route::post('/deletecomment', [CommentController::class, 'destroy'])->name('commentDestroy');

Route::post('/favorite', [FavoriteController::class, 'store'])->name('favoriteStore');
Route::post('/deletefavorite', [FavoriteController::class, 'destroy'])->name('favoriteDestroy');

Route::post('/user/follow', [FollowController::class, 'store'])->name('followStore');
Route::post('/user/unfollow', [FollowController::class, 'destroy'])->name('followDestroy');



 Route::prefix('auth/{provider}')->where(['provider' => 'google'])->group(function(){
    Route::get('/', [OAuthController::class, 'socialOAuth'])->name('google_login.redirect');
    Route::get('/callback', [OAuthController::class, 'handleProviderCallback'])->name('google_login.callback');
});

Route::post('/user/newHeaderImg', [UserHeaderImgController::class, 'store'])->name('UserHeaderImgStore');

/**
 * 教室を探す
 */
// セキュリティ的にコメントアウトしてます
// Route::get('/caligraphy-class/create-for-administrator', [CalligraphyClassController::class, 'create'])->name('create');
Route::post('/caligraphy-class', [CalligraphyClassController::class, 'store'])->name('classStore');

Route::get('/caligraphy-class/{district_code}', [CalligraphyClassController::class, 'selectArea'])->name('selectArea');
// Route::get('/caligraphy-class/{district_code}/{prefecture_code}', [CalligraphyClassController::class, 'selectPrefecture'])->name('selectPrefecture');
Route::get('/caligraphy-class/{district_code}/{prefecture_code}/{area_code}', [CalligraphyClassController::class, 'showClassList'])->name('showClassList');
