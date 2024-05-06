<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserGalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return GalleryResource::collection($user->galleries);
    }
}
