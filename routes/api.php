<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryGalleriesController;
use App\Http\Controllers\Api\CategoryImagesController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GalleryImagesController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TagGalleriesController;
use App\Http\Controllers\Api\TagImagesController;
use App\Http\Controllers\Api\UserGalleriesController;
use App\Http\Controllers\Api\UserImagesController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('galleries', [GalleryController::class, 'index']);
Route::get('users', [UsersController::class, 'index']);
Route::get('images', [ImageController::class, 'index']);

Route::get('tags', [TagController::class, 'index'])->defaults('type', 'tag');
Route::get('categories', [CategoryController::class, 'index'])->defaults('type', 'category');

Route::get('users/{user}/galleries', [UserGalleriesController::class, 'index']);
Route::get('users/{user}/images', [UserImagesController::class, 'index']);

Route::get('galleries/{gallery}/images', [GalleryImagesController::class, 'index']);

Route::get('tags/{taxonomy}/images', [TagImagesController::class, 'index'])->defaults('type', 'tag');
Route::get('tags/{taxonomy}/galleries', [TagGalleriesController::class, 'index'])->defaults('type', 'tag');

Route::get('categories/{taxonomy}/images', [CategoryImagesController::class, 'index'])->defaults('type', 'category');
Route::get('categories/{taxonomy}/galleries', [CategoryGalleriesController::class, 'index'])->defaults('type', 'category');
