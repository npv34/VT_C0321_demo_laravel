<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function index() {
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }

    function create() {
        return view('admin.users.add');
    }

    function delete($id) {
        $user = User::find($id);
        // xoa anh
        Storage::disk('public')->delete($user->image);

        //xoa trong csdl
        $user->delete();
        return redirect()->route('users.index');

    }

    function store(StoreUserRequest $request) {
       // code logic
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->password = Hash::make($request->password); // băm password -> bảo mật

        // upload file
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('image','public');
            $user->image = $path;
        }
        $user->save();

        return redirect()->route('users.index');

    }
}
