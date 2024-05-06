<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $type)
    {
        $this->setModelClass($type);
        $taxonomies = $this->modelClass::all();
        return $taxonomies;
    }
}
