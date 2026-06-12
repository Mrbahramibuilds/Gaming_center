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
    $users=User::with('role')->get();
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
    ]);

    $user = User::create([
            'name'        => $request->user_name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->role_id);
        
        return redirect()->route('list_users');
   }

   public function form_edit_user(User $user)
   {
      $roles=Role::all();
      return view('users.edit_user',compact('user','roles'));
   }

   public function update_user(Request $request , User $user)
   { 
      $request->validate([
         'name'      => 'required|string|max:255',
         'email'     => 'required|email|unique:users,email,' . $user->id,
         'password'  => 'nullable|min:8|confirmed',  
         'role_id'   => 'required|integer|exists:roles,id',
         ]);

          $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'role_id' => $request->role_id,
        ];
        
       
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
         return redirect()->route('list_users');


   }

   public function drop_user(User $user)
   {
        $user->delete();
        return redirect()->route('list_users');
   }
}
