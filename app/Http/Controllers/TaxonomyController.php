<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaxonomyRequest;
use App\Models\Gallery;
use Illuminate\Support\Pluralizer;

class TaxonomyController extends Controller
{
    protected $modelClass;

    public function create(string $type)
    {
        return view("admin.taxonomies.create", compact('type'));
    }

    public function store(StoreTaxonomyRequest $request, string $type)
    {
        $this->setModelClass($type);
        $model = $this->modelClass::create($request->validated());

        $type = ucfirst($type);

        return redirect()->route('dashboard', ['tab' => 'taxonomies'])->with('success', "$type created successfully.");
    }

    public function edit(string $id, string $type)
    {
        $this->setModelClass($type);
        $taxonomy = $this->findTaxonomyById($id);

        return view("admin.taxonomies.edit", compact('taxonomy', 'type'));
    }

    public function update(StoreTaxonomyRequest $request, string $id, string $type)
    {
        $this->setModelClass($type);
        $taxonomy = $this->findTaxonomyById($id);
        $taxonomy->update($request->validated());

        $type = ucfirst($type);

        return redirect()->route('dashboard', ['tab' => 'taxonomies'])->with('success', "$type updated successfully.");
    }

    public function destroy(string $id, string $type)
    {
        $this->setModelClass($type);
        $taxonomy = $this->findTaxonomyById($id);
        $taxonomy->delete();

        $type = ucfirst($type);

        return redirect()->route('dashboard', ['tab' => 'taxonomies'])->with('success', "$type removed from the system successfully.");
    }

    public function show(string $slug, string $type)
    {
        $this->setModelClass($type);
        $taxonomy = $this->modelClass::forSlug($slug)->first();

        // Accumulate all images from all taxonomy's galleries
        $images = $taxonomy->galleries->flatMap(fn (Gallery $gallery) => $gallery->media);

        /**
         * Using built-in Laravel class to make plural word from taxonomy type.
         * tag -> tags, category -> categories
         */
        $type = Pluralizer::plural($type);

        return view("taxonomies.$type.show", compact('taxonomy', 'images'));
    }

    protected function setModelClass($type)
    {
        $this->modelClass = 'App\\Models\\' . ucfirst($type);
    }

    protected function findTaxonomyById($id)
    {
        return $this->modelClass::findOrFail($id);
    }
}
