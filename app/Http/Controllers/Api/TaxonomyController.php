<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class TaxonomyController extends Controller
{
    public function index(string $type)
    {
        $this->setModelClass($type);
        $taxonomies = $this->modelClass::all();
        return $taxonomies;
    }
}
