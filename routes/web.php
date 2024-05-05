<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TaxonomyController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/logout', [LoginController::class, 'logout']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['permission:admin dashboard'])->group(function () {
        Route::resource('users', UsersController::class)->except(['index', 'show']);

        Route::get('tags/create', [TaxonomyController::class, 'create'])->defaults('type', 'tag')->name('tags.create');
        Route::post('tags', [TaxonomyController::class, 'store'])->defaults('type', 'tag')->name('tags.store');
        Route::get('tags/{tag}/edit', [TaxonomyController::class, 'edit'])->defaults('type', 'tag')->name('tags.edit');
        Route::put('tags/{tag}', [TaxonomyController::class, 'update'])->defaults('type', 'tag')->name('tags.update');
        Route::delete('tags/{tag}', [TaxonomyController::class, 'destroy'])->defaults('type', 'tag')->name('tags.destroy');

        Route::get('categories/create', [TaxonomyController::class, 'create'])->defaults('type', 'category')->name('categories.create');
        Route::post('categories', [TaxonomyController::class, 'store'])->defaults('type', 'category')->name('categories.store');
        Route::get('categories/{category}/edit', [TaxonomyController::class, 'edit'])->defaults('type', 'category')->name('categories.edit');
        Route::put('categories/{category}', [TaxonomyController::class, 'update'])->defaults('type', 'category')->name('categories.update');
        Route::delete('categories/{category}', [TaxonomyController::class, 'destroy'])->defaults('type', 'category')->name('categories.destroy');

        Route::resource('galleries', GalleryController::class)->except(['index', 'show']);

        Route::resource('images', ImageController::class)->only(['destroy'])->name('destroy', 'image.destroy');
    });

    Route::middleware(['permission:user dashboard'])->group(function () {

        Route::resource('galleries', GalleryController::class)->only(['index', 'show'])->name('index', 'galleries');
        
        Route::post('/galleries/{gallery}/like', [GalleryController::class, 'like'])->name('galleries.like');
        Route::post('/galleries/{gallery}/dislike', [GalleryController::class, 'dislike'])->name('galleries.dislike');

        Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    });
});
