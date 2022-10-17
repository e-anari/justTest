<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::query();

        if (request('search')) {
            $keyword = trim(request('search'));
            $permissions->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%");
        }

        if (request('sorting')) {
            $sort = request('sorting');
            switch ($sort) {
                case 'desc':
                    $permissions->orderby('created_at', 'desc');
                    break;
                case 'asc':
                    $permissions->orderby('created_at', 'asc');
                    break;
                case 'az':
                    $permissions->orderby('name', 'asc');
                    break;
                case 'za':
                    $permissions->orderby('name', 'desc');
                    break;

                default:
                    # code...
                    break;
            }
        }

        $permissions = $permissions->latest()->paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
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
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
            'description' => ['required', 'string'],
        ]);

        Permission::create($data);

        return redirect()->route('permission.index')->with('success', 'Permission added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name,' . $permission->id],
            'description' => ['required', 'string'],
        ]);

        $permission->update($data);

        return redirect()->route('permission.index')->with('success', 'Permission edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return \redirect()->route('permission.index')->with('success', 'Permission deleted.');
    }
}
