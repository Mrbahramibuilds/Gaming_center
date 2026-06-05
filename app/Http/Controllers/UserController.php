<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function list_users()
   {
    $users=User::with('roles')->get();
    return view('users.listusers',compact('users'));
   }

   public function add_user()
   {
    $roles=Role::all();
    return view('users.add_user',compact('roles'));
   }

   public function user_store(Request $request)
   {
    $request->validate([
    'user_name'   => 'required|string|max:255',
    'email'       => 'required|email|unique:users,email',
    'password'     => 'required|min:8|confirmed',
    'role_id' => 'required|integer|exists:roles,id',
    'discription' => 'nullable|string|max:1000',
    ]);

    $user = User::create([
            'name'        => $request->user_name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->role_id);
        
        return redirect()->route('list_users');
   }
}
