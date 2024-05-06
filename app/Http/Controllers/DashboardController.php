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

        /**
         * Based on user's permissions, make a decision which dashboard
         * to show to user. Show admin dashboard to user only if users
         * posses 'admin dashboard' permission. Otherwise, show user dashboard.
         */
        if ($user->hasPermissionTo('admin dashboard')) {
            $users = User::all();
            $galleries = Gallery::all();
            $tab = $request->tab;
            return view('admin.dashboard', compact('users', 'tags', 'categories', 'galleries', 'tab'));
        }


        // Apply galleries search (by name) and filtering by taxonomies
        $galleries = Gallery::forName($request->search)
                            ->forTags($request->tags)
                            ->forCategories($request->categories)
                            ->paginate(10);
        return view('user.dashboard', compact('tags', 'categories', 'galleries'));
    }
}
