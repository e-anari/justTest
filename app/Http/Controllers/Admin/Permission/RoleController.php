<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::query();

        if (request('search')) {
            $keyword = trim(request('search'));
            $role->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%");
        }

        if (request('sorting')) {
            $sort = request('sorting');
            switch ($sort) {
                case 'desc':
                    $role->orderby('created_at', 'desc');
                    break;
                case 'asc':
                    $role->orderby('created_at', 'asc');
                    break;
                case 'az':
                    $role->orderby('name', 'asc');
                    break;
                case 'za':
                    $role->orderby('name', 'desc');
                    break;

                default:
                    # code...
                    break;
            }
        }

        $roles = $role->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();


        return \view('admin.role.create',\compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'description' => ['required', 'string'],
            'permissions' => ['required','array'],
        ]);

        $role = Role::create($data);
        $role->permissions()->attach($data['permissions']);

        // session()->flash('success','Role added.');

        return redirect()->route('role.index')->with('success', 'Role added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'description' => ['required', 'string'],
            'permissions' => ['required','array'],
        ]);

        $role->update($data);
        $role->permissions()->sync($data['permissions']);

        return redirect()->route('role.index')->with('success', 'Role edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach($role->id);

        $role->delete();

        return \redirect()->route('role.index')->with('success','Role deleted.');
    }
}
