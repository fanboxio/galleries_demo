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
            return view('admin.dashboard');
        }

        return view('user.dashboard');
    }
}
