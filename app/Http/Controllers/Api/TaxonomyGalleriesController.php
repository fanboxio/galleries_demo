<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;

class TaxonomyGalleriesController extends Controller
{
    public function index(string $taxonomy, string $type)
    {
        $this->setModelClass($type);
        $taxonomy = $this->findTaxonomyById($taxonomy);
        return GalleryResource::collection($taxonomy->galleries);
    }
}
