<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        /** @var User $user */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $admin = (bool) ($request->admin ?? false);

        match ($admin) {
            true => $role = Role::findByName('admin'),
            false => $role = Role::findByName('user'),
        };

        $user->assignRole($role);

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

        if ($request->has('admin')) {
            $adminRole = Role::findByName('admin');

            if ($request->admin && !$user->hasRole($adminRole)) {
                $user->assignRole($adminRole);

                $userRole = Role::findByName('user');

                if ($user->hasRole($userRole)) {
                    $user->removeRole($userRole);
                }
            } else if (!$request->admin && $user->hasRole($adminRole)) {
                $user->removeRole($adminRole);

                $userRole = Role::findByName('user');

                if (!$user->hasRole($userRole)) {
                    $user->assignRole($userRole);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'User data updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User removed from the system successfully.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));   
    }
}
