<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaxonomyRequest;

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

    protected function setModelClass($type)
    {
        $this->modelClass = 'App\\Models\\' . ucfirst($type);
    }

    protected function findTaxonomyById($id)
    {
        return $this->modelClass::findOrFail($id);
    }
}
