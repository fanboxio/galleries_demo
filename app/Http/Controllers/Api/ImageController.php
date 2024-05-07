<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryImageResource;
use App\Models\Gallery;

class ImageController extends Controller
{
    /**
     * Get all images.
     * 
     * @operationId getAllImages
     */
    public function index()
    {
        $images = Gallery::all()->flatMap(fn (Gallery $gallery) => $gallery->media);
        return GalleryImageResource::collection($images);
    }
}
