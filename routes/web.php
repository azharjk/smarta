<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DevController;

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

Route::middleware('guest')->group(function() {
    Route::view('/signup', 'auth.signup')->name('auth.signup');
    Route::post('/signup', [AuthController::class, 'register'])->name('auth.register');

    Route::view('/signin', 'auth.signin')->name('auth.signin');
    Route::post('/signin', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('auth')->group(function() {
    Route::get('/', DashboardController::class)->name('dashboard.index');

    Route::get('/follow/{subject_id}', [UserController::class, 'follow'])->name('user.follow');
    Route::get('/unfollow/{subject_id}', [UserController::class, 'unfollow'])->name('user.unfollow');

    Route::get('/signout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/subjects', [SubjectController::class, 'my'])->name('subject.my');
    Route::get('/followed', [SubjectController::class, 'followed'])->name('subject.followed');

    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subjects/create', [SubjectController::class, 'store'])->name('subject.store');

    Route::get('/subjects/{subject_id}', [SubjectController::class, 'show'])->name('subject.show');

    // Should not like this. Use for temporary model
    Route::get('/subjects/{subject_id}/forums/{forum_id}', [ForumController::class, 'show'])->name('forum.show');

    Route::get('/forums/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forums/create', [ForumController::class, 'store'])->name('forum.store');
});

Route::any('/dev/{file_path}', DevController::class)->where('file_path', '.*');
