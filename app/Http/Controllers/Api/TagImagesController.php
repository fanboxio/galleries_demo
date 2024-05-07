<?php

namespace App\Http\Controllers\Api;

/**
 * @tags Tag
 */
class TagImagesController extends TaxonomyImagesController
{
    /**
     * Get a list of all images from related galleries.
     */
    public function index(string $taxonomy, string $type)
    {
        return parent::index($taxonomy, $type);
    }
}
