<?php

namespace App\Http\Controllers\Api;

/**
 * @tags Category
 */
class CategoryImagesController extends TaxonomyImagesController
{
    /**
     * Get a list of all images from related galleries.
     * 
     * @operationId getCategoryImages
     */
    public function index(string $taxonomy, string $type)
    {
        return parent::index($taxonomy, $type);
    }
}
