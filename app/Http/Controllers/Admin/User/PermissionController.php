<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.user.permission.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'permissions' => ['required', 'array'],
            'roles' => ['required', 'array'],
        ]);

        $user->permissions()->sync($data['permissions']);
        $user->roles()->sync($data['roles']);

        return redirect()->back()->with('success','User permission edited.');

    }
}
