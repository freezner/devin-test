<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BookmarkController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('bookmarks')->name('bookmarks.')->group(function () {
    Route::get('/', [BookmarkController::class, 'index'])->name('index');
    Route::get('/create', [BookmarkController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/', [BookmarkController::class, 'store'])->name('store')->middleware('auth');
    Route::get('/{bookmark}', [BookmarkController::class, 'show'])->name('show');
    Route::delete('/{bookmark}', [BookmarkController::class, 'destroy'])->name('destroy')->middleware('auth');
    Route::post('/{bookmark}/like', [BookmarkController::class, 'like'])->name('like');
});
