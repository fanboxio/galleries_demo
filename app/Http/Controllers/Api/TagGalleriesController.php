<?php

namespace App\Http\Controllers\Api;

/**
 * @tags Tag
 */
class TagGalleriesController extends TaxonomyGalleriesController
{
    /**
     * Get all related galleries.
     * 
     * @operationId getTagGalleries
     */
    public function index(string $taxonomy, string $type)
    {
        return parent::index($taxonomy, $type);
    }
}
