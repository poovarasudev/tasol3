<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Contact Admin Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactAdmin()
    {
        $admins = User::getUsersWithCreateNewUserPermissions();
        return view('auth.contact_admin', compact('admins'));
    }

    /**
     * Get Profile.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateProfile(ProfileRequest $request)
    {
        try {
            $input = $request->only('name', 'phone', 'gender');
            if ($request->get('old_password') != '') {
                if(!Hash::check($request->get('old_password'), auth()->user()->password)){
                    return redirect()->back()->withInput($request->all())->with('error', 'Old password is incorrect!');
                }
                $input['password'] = Hash::make($request->get('new_password'));
            }
            auth()->user()->update($input);
            return redirect('/profile')->with('success', 'Profile Updated Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/profile')->with('error', 'Error while updating Profile!');
        }
    }
}
