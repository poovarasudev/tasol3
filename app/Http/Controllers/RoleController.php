<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public $baseViewDirectory = 'roles.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->baseViewDirectory . 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        return view($this->baseViewDirectory . 'create', compact('permissions'));
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
            $permissionId = $request->get('permission_ids');
            if ($permissionId && !isEmptyArray($permissionId)) {
                $permissions = Permission::whereIn('id', $permissionId)->get();
                $role->syncPermissions($permissions);
            }
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
        $role = Role::where('name', '!=', SUPER_ADMIN_ROLE)->with('permissions')->findOrFail($id);
        return view($this->baseViewDirectory . 'show', compact('role'));
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
        $permissions = Permission::all()->groupBy('group');
        return view($this->baseViewDirectory . 'edit', compact('role', 'permissions'));
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
            $permissions = $request->get('permission_ids') ?? [];
            $permissions = Permission::whereIn('id', $permissions)->get();
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

    /**
     * Get Users list for Datatable
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function getRoles(Request $request)
    {
        $totalPermissionCount = Permission::count();
        return DataTables::eloquent(Role::withCount('permissions'))
            ->editColumn('permissions_count', function ($role) use ($totalPermissionCount) {
                return ($role->permissions_count == $totalPermissionCount || $role->isSuperAdmin()) ? 'All' : $role->permissions_count;
            })
            ->addColumn('action', function ($role) {
                $buttons = '';
                if (!$role->isSuperAdmin()) {
                    if (auth()->user()->can('roles.view')) {
                        $buttons .= viewButton(route("roles.show", $role->id));
                    }
                    if (auth()->user()->can('roles.edit')) {
                        $buttons .= editButton(route("roles.edit", $role->id));
                    }
                    if (auth()->user()->can('roles.delete')) {
                        $buttons .= deleteButton(route("roles.delete", $role->id), $role->name);
                    }
                } else {
                    $buttons = '-';
                }
                return '<div class="form-inline justify-content-center">' . $buttons . '</div>';
            })
            ->make(true);
    }
}
