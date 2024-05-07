<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

/**
 * @tags User
 */
class UsersController extends Controller
{
    /**
     * Get all users.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }
}
