<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryImageResource;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;

class UserImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $images = $user->galleries->flatMap(fn (Gallery $gallery) => $gallery->media);
        return GalleryImageResource::collection($images);
    }
}
