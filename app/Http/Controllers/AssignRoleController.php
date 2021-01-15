<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRoleRequest;
use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class AssignRoleController extends Controller
{
    public $baseViewDirectory = 'admin.assign_role.';

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
        $users = User::whereDoesntHave('roles')->with('team')->get();
        $roles = Role::excludeSuperAdmin()->withCount('permissions')->get();
        return view($this->baseViewDirectory . 'create', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignRoleRequest $request)
    {
        try {
            $user = User::withCount('roles')->findOrFail($request->get('user_id'));
            if ($user->roles_count != 0) {
                return redirect()->back()->withInput($request->all())->with('error', 'This User already has a role!');
            }
            $role = Role::excludeSuperAdmin()->findOrFail($request->get('role_id'));
            $user->assignRole($role->name);
            return redirect('/assign-role')->with('success', 'Role Assigned Successfully!');
        } catch (\Throwable $exception) {
            info($exception->getMessage());
            return redirect('/assign-role')->with('error', 'Unable to Assign Role!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::whereHas('roles')->with('roles')->findOrFail($id);
        $roles = Role::excludeSuperAdmin()->withCount('permissions')->get();
        return view($this->baseViewDirectory . 'edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignRoleRequest $request, $id)
    {
        try {
            $user = User::whereHas('roles')->with('roles')->findOrFail($id);
            $role = Role::excludeSuperAdmin()->findOrFail($request->get('role_id'));
            $user->removeRole($user->roles->first()->name);
            $user->assignRole($role->name);
            return redirect('/assign-role')->with('success', 'Role Updated Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/assign-role')->with('error', 'Unable to Update Role!');
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
            $user = User::whereHas('roles')->findOrFail($id);
            if ($user->isSuperAdmin()) {
                return response()->json(['action' => 'error', 'message' => 'Can\'t detach the Super Admin\'s Role!!!'], 422);
            }
            $role = Role::excludeSuperAdmin()->findOrFail($user->roles->first()->id);
            $user->removeRole($role->name);
            return response()->json(['action' => 'success', 'message' => 'User - Role deleted successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to detach User/Role'], 500);
        }
    }

    /**
     * Get Teams.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAssignedRoles()
    {
        return DataTables::of(User::whereHas('roles')->with('roles')->get())
            ->addColumn('role_name', function ($user) {
                return $user->roles->first()->name;
            })
            ->addColumn('action', function ($user) {
                $buttons = '';
                if ($user->isSuperAdmin()) {
                    $buttons = '-';
                } else {
                    if (auth()->user()->can('assign_role.edit')) {
                        $buttons .= editButton(route("assign_role.edit", $user->id));
                    }
                    if (auth()->user()->can('assign_role.delete')) {
                        $buttons .= deleteButton(route("assign_role.delete", $user->id), $user->name);
                    }
                }
                return '<div class="form-inline justify-content-center">' . $buttons . '</div>';
            })
            ->make('true');
    }
}
