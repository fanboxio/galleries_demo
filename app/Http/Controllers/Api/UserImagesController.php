<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryImageResource;
use App\Models\Gallery;
use App\Models\User;

/**
 * @tags User
 */
class UserImagesController extends Controller
{
    /**
     * Get a list of images from galleries created by user.
     */
    public function index(User $user)
    {
        $images = $user->galleries->flatMap(fn (Gallery $gallery) => $gallery->media);
        return GalleryImageResource::collection($images);
    }
}
