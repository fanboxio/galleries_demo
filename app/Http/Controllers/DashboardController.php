<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasPermissionTo('admin dashboard')) {
            $users = User::all();
            return view('admin.dashboard', compact('users'));
        }

        return view('user.dashboard');
    }
}
