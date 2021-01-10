<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withCount('permissions')->get();
        $totalPermissionCount = Permission::count();
        return view('cruds.roles.index', compact('roles', 'totalPermissionCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = null;
        $url = '/roles';
        $permissions = Permission::all()->groupBy('group');
        return view('cruds.roles.create_and_edit', compact('role', 'url', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return array
     */
    public function store(RoleRequest $request)
    {
        try {
            $input = $request->only('name');
            $input['guard_name'] = 'web';
            $role = Role::create($input);
            $permissions = Permission::whereIn('id', $request->get('permission_ids'))->get();
            $role->syncPermissions($permissions);
            return redirect('/roles')->with('success', 'Role Created Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/roles')->with('error', 'Unable to Create Role!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return view('cruds.roles.view', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('name', '!=', SUPER_ADMIN_ROLE)->with('permissions')->findOrFail($id);
        $url = '/roles/' . $id;
        $permissions = Permission::all()->groupBy('group');
        return view('cruds.roles.create_and_edit', compact('role', 'url', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param int $id
     * @return void
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $role = Role::where('name', '!=', SUPER_ADMIN_ROLE)->findOrFail($id);
            $input = $request->only(['name']);
            $role->update($input);
            $permissions = Permission::whereIn('id', $request->get('permission_ids'))->get();
            $role->syncPermissions($permissions);
            return redirect('/roles')->with('success', 'Role Updated Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/roles')->with('error', 'Unable to Update Role Details!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            if ($role->isSuperAdmin()) {
                return response()->json(['action' => 'error', 'message' => 'Super Admin role cannot be deleted!!!'], 422);
            }
            $userCount = User::role($role->name)->count();
            if ($userCount) {
                return response()->json(['action' => 'error', 'message' => 'This role is assigned to ' . $userCount . ' users, unable to delete it!!!'], 422);
            }
            $role->delete();
            return response()->json(['action' => 'success', 'message' => 'Role deleted successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to delete Role'], 500);
        }
    }
}
