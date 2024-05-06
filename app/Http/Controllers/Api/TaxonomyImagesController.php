<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryImageResource;
use App\Models\Gallery;


class TaxonomyImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $taxonomy, string $type)
    {
        $this->setModelClass($type);
        $taxonomy = $this->findTaxonomyById($taxonomy);
        $images = $taxonomy->galleries->flatMap(fn (Gallery $gallery) => $gallery->media);
        return GalleryImageResource::collection($images);
    }
}
