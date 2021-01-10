<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public $baseViewDirectory = 'users.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('team')->get();
        return view($this->baseViewDirectory . 'index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        return view($this->baseViewDirectory . 'create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return void
     */
    public function store(UserRequest $request)
    {
        try {
            $input = $request->only(['name', 'email', 'phone', 'gender', 'team_id']);
            $breakfast = $request->get('breakfast');
            $input['breakfast'] = $breakfast && ($breakfast == 'on');
            $lunch = $request->get('lunch');
            $input['lunch'] = $lunch && ($lunch == 'on');
            $input['password'] = Hash::make($request->get('password'));
            User::create($input);
            return redirect('/users')->with('success', 'User Created Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/users')->with('error', 'Unable to Create User!');
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
        $user = User::with('team')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $teams = Team::all();
        return view($this->baseViewDirectory . 'edit', compact('user', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $input = $request->only(['name', 'email', 'phone', 'gender', 'team_id']);
            $breakfast = $request->get('breakfast');
            $input['breakfast'] = $breakfast && ($breakfast == 'on');
            $lunch = $request->get('lunch');
            $input['lunch'] = $lunch && ($lunch == 'on');
            if ($request->get('password')) {
                $input['password'] = Hash::make($request->get('password'));
            }
            $user->update($input);
            return redirect('/users')->with('success', 'User Updated Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/users')->with('error', 'Unable to Update User Details!');
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
            $user = User::findOrFail($id);
            // TODO :: Need to add restriction for deleting user based on bill balance.
//            if ($user->isSuperAdmin()) {
//                return response()->json(['action' => 'error', 'message' => 'Super Admin users be deleted!!!'], 422);
//            }
            $user->delete();
            return response()->json(['action' => 'success', 'message' => 'User deleted successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to delete User'], 500);
        }
    }

    /**
     * Get Users list for Datatable
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function getUsers(Request $request)
    {
        return DataTables::eloquent(User::with('team'))
            ->editColumn('breakfast', function ($user) {
                return getYesOrNoBadge($user->breakfast);
            })
            ->editColumn('lunch', function ($user) {
                return getYesOrNoBadge($user->lunch);
            })
            ->addColumn('action', function ($user) {
                return '<div class="form-inline justify-content-center">' . viewButton(route("users.show", $user->id)) .
                    editButton(route("users.edit", $user->id)) .
                    deleteButton(route("users.delete", $user->id), $user->name) .
                    '</div>';
            })
            ->make(true);
    }
}
