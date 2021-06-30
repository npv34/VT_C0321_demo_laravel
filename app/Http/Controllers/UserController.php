<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    }
}
