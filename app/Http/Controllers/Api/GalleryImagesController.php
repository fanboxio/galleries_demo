<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryImageResource;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Gallery $gallery)
    {
        return GalleryImageResource::collection($gallery->media);
    }
}
