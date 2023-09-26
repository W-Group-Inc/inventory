<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {

        $users = User::orderBy('name','asc')->get();

        return view('users',
        
        array(
        'subheader' => '',
        'header' => "Users",
        'users' => $users,
        )
        );
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $request->session()->flash('status','Successfully Created');
        return back();
    }
    public function activate(Request $request,$id)
    {
      
        $user = User::findOrfail($id);
        $user->status = null;
        $user->save();

        $request->session()->flash('status','Successfully Activated');
        return back();
    }
    public function deactivate(Request $request,$id)
    {
      
        $user = User::findOrfail($id);
        $user->status = "deactivated";
        $user->password = "";
        $user->save();

        $request->session()->flash('status','Successfully Deactivated');
        return back();
    }
}
