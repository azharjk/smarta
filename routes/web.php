<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MySubjectController;

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
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/follow/{subject_id}', [DashboardController::class, 'follow'])->name('dashboard.follow');
    Route::get('/unfollow/{subject_id}', [DashboardController::class, 'unfollow'])->name('dashboard.unfollow');

    Route::get('/signout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subject.index');

    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/subjects/create', [SubjectController::class, 'store'])->name('subject.store');

    Route::get('/subjects/{subject_id}', [SubjectController::class, 'show'])->name('subject.show');

    // Should not like this. Use for temporary model
    Route::get('/subjects/{subject_id}/forums/{forum_id}', [ForumController::class, 'show'])->name('forum.show');

    Route::get('/forums/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forums/create', [ForumController::class, 'store'])->name('forum.store');

    Route::get('/mysubjects', [MySubjectController::class, 'index'])->name('mysubject.index');
});

