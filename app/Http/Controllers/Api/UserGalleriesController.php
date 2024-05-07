<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\User;

/**
 * @tags User
 */
class UserGalleriesController extends Controller
{
    /**
     * Get a list of galleries created by user.
     * 
     * @operationId getUserGalleries
     */
    public function index(User $user)
    {
        return GalleryResource::collection($user->galleries);
    }
}
