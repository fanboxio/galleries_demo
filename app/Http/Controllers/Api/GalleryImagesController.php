<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryImageResource;
use App\Models\Gallery;
use Illuminate\Http\Request;

/**
 * @tags Gallery
 */
class GalleryImagesController extends Controller
{
    /**
     * Get a list of gallery images.
     * 
     * @operationId getAllGalleryImages
     */
    public function index(Gallery $gallery)
    {
        return GalleryImageResource::collection($gallery->media);
    }
}
