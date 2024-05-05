<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Jobs\SendGalleryReactionEmail;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('galleries.index', compact('galleries'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.galleries.create', compact('tags', 'categories'));
    }

    public function store(StoreGalleryRequest $request)
    {
        $gallery = new Gallery();
        $gallery->name = $request->name;
        $gallery->grid_size = $request->grid_size;
        $gallery->description = $request->description;
        $gallery->creator()->associate(User::find(Auth::id()));
        
        $gallery->save();

        if ($request->has('tags')) {;
            $gallery->tags()->attach($request->tags);
        }

        if ($request->has('categories')) {
            $gallery->categories()->attach($request->categories);
        }

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $gallery->addMedia($image)->toMediaCollection('images');
            }
        }

        return redirect()->route('dashboard', ['tab' => 'galleries'])->with('success', 'Gallery created successfully.');
    }

    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.galleries.edit', compact('gallery', 'tags', 'categories'));
    }

  
    public function update(StoreGalleryRequest $request, Gallery $gallery)
    {

        $gallery->update([
            'name' => $request->name,
            'grid_size' => $request->grid_size,
            'description' => $request->description,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $gallery->addMedia($image)->toMediaCollection('images');
            }
        }

        $gallery->tags()->sync($request->tags);
        $gallery->categories()->sync($request->categories);

        return redirect()->route('dashboard', ['tab' => 'galleries'])->with('success', 'Gallery data updated successfully.');
    }


    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('dashboard', ['tab' => 'galleries'])->with('success', 'Gallery removed from the system successfully.');
    }

    public function like(Gallery $gallery)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->hasLiked($gallery)) {
            $user->like($gallery);

            SendGalleryReactionEmail::dispatch($gallery, $user, 'like');
        }

        return back();
    }

    public function dislike(Gallery $gallery)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->hasDisliked($gallery)) {
            $user->dislike($gallery);

            SendGalleryReactionEmail::dispatch($gallery, $user, 'dislike');
        }

        return back();
    }
}
