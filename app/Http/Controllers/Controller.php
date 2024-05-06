<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $modelClass;

    /**
     * This method can be used whenever actual taxonomy model
     * instance is required. Model class name is determined by
     * capitalized taxonomy type name.
     */
    protected function setModelClass($type)
    {
        $this->modelClass = 'App\\Models\\' . ucfirst($type);
    }

    /**
     * This method can be used just after $modelClass is assigned
     * (most probably by calling setModelClass method previously).
     * 
     * Method is returning an actual model instance from DB by
     * provided id. In case DB record is not found, ModelNotFoundException
     * will be thrown.
     */
    protected function findTaxonomyById($id)
    {
        return $this->modelClass::findOrFail($id);
    }
}
