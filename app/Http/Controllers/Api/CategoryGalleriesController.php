<?php

namespace App\Http\Controllers\Api;

/**
 * @tags Category
 */
class CategoryGalleriesController extends TaxonomyGalleriesController
{
    /**
     * Get all related galleries.
     * 
     * @operationId getCategoryGalleries
     */
    public function index(string $taxonomy, string $type)
    {
        return parent::index($taxonomy, $type);
    }
}
