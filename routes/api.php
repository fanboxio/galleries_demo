<?php

use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GalleryImagesController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\TaxonomyController;
use App\Http\Controllers\Api\TaxonomyGalleriesController;
use App\Http\Controllers\Api\TaxonomyImagesController;
use App\Http\Controllers\Api\UserGalleriesController;
use App\Http\Controllers\Api\UserImagesController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('galleries', [GalleryController::class, 'index']);
Route::get('users', [UsersController::class, 'index']);
Route::get('images', [ImageController::class, 'index']);
Route::get('tags', [TaxonomyController::class, 'index'])->defaults('type', 'tag');
Route::get('categories', [TaxonomyController::class, 'index'])->defaults('type', 'category');

Route::get('users/{user}/galleries', [UserGalleriesController::class, 'index']);
Route::get('users/{user}/images', [UserImagesController::class, 'index']);

Route::get('galleries/{gallery}/images', [GalleryImagesController::class, 'index']);

Route::get('tags/{taxonomy}/images', [TaxonomyImagesController::class, 'index'])->defaults('type', 'tag');
Route::get('tags/{taxonomy}/galleries', [TaxonomyGalleriesController::class, 'index'])->defaults('type', 'tag');

Route::get('categories/{taxonomy}/images', [TaxonomyImagesController::class, 'index'])->defaults('type', 'category');
Route::get('categories/{taxonomy}/galleries', [TaxonomyGalleriesController::class, 'index'])->defaults('type', 'category');
