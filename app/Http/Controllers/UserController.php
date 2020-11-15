<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    //

    public function index(){
  return view('users.index')->with('users', User::all());
}
 public function makeAdmin(User $user){
 	$user->role = 'admin';
 	$user->save();
 	//Put a session message
session()->flash('success', 'User was made an admin!');

//Redirect
return redirect(route('users.index'));

 }
//Change Admin role to writer
  public function undoAdmin(User $user){
 	$user->role = 'writer';
 	$user->save();
 	//Put a session message
session()->flash('success', 'Admin became writer successfully!');

//Redirect
return redirect(route('users.index'));

 }
}
