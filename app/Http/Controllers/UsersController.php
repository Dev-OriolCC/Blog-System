<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateUsersRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // FUNCTIONS
    public function index(){
        return view('users.index')->with('users', User::all());
    }

    public function makeAdmin(User $user){
        $user->role = 'admin';
        $user->save();
        session()->flash('success', ' '.$user->name.' Is Now a Admin Created Successfully🙂👍'); // MESSAGE TO DISPLAY
        return redirect(route('users.index'));
    }

    public function edit(){
        return view('users.edit')->with('user', auth()->user());
    }
    public function update(UpdateUsersRequest $request){
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'about' => $request->about
        ]);
        session()->flash('success', ' '.$user->name.' Updated Successfully 😀');
        return redirect(route('users.index'));
    }
}
