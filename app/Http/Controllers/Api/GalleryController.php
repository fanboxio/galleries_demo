<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use Illuminate\Http\Request;

/**
 * @tags Gallery
 */
class GalleryController extends Controller
{
    /**
     * Get all galleries.
     * 
     * @operationId getAllGalleries
     */
    public function index()
    {
        $galleries = Gallery::all();
        return GalleryResource::collection($galleries);
    }
}
