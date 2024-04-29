<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(RegisterRequest $request)
    {
        /** @var User $user */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->filled('admin')) {
            $adminRole = Role::findByName('admin');

            if ($request->admin && !$user->hasRole($adminRole)) {
                $user->assignRole($adminRole);
            } else if (!$request->admin && $user->hasRole($adminRole)) {
                $user->removeRole($adminRole);
            }
        }

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
        ]);

        if ($request->filled('admin')) {
            $adminRole = Role::findByName('admin');

            if ($request->admin && !$user->hasRole($adminRole)) {
                $user->assignRole($adminRole);
            } else if (!$request->admin && $user->hasRole($adminRole)) {
                $user->removeRole($adminRole);
            }
        }

        return redirect()->route('dashboard')->with('success', 'User data updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User removed from the system successfully.');
    }

    public function show(User $user)
    {
        return view('user.profile', compact('user'));   
    }
}
