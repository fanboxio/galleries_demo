<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $modelClass;

    protected function setModelClass($type)
    {
        $this->modelClass = 'App\\Models\\' . ucfirst($type);
    }

    protected function findTaxonomyById($id)
    {
        return $this->modelClass::findOrFail($id);
    }
}
