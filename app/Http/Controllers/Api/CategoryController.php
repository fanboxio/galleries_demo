<?php

namespace App\Http\Controllers\Api;

/**
 * @tags Category
 */
class CategoryController extends TaxonomyController
{
    /**
     * Get all categories.
     * 
     * @operationId getAllCategories
     */
    public function index(string $type)
    {
        return parent::index($type);
    }
}
