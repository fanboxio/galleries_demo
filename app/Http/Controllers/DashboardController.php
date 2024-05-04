<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();
        $categories = Category::all();

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasPermissionTo('admin dashboard')) {
            $users = User::all();
            $galleries = Gallery::all();
            return view('admin.dashboard', compact('users', 'tags', 'categories', 'galleries'));
        }

        $galleries = Gallery::forName($request->search)
                            ->forTags($request->tags)
                            ->forCategories($request->categories)
                            ->paginate(10);
        return view('user.dashboard', compact('tags', 'categories', 'galleries'));
    }
}
