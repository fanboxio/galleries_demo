<?php

namespace App\Http\Controllers\Api;

/**
 * @tags Tag
 */
class TagController extends TaxonomyController
{
    /**
     * Get all tags.
     */
    public function index(string $type)
    {
        return parent::index($type);
    }
}
