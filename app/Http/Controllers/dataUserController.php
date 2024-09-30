<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class dataUserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.dataUser.dataUser',compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email'
        ]);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

}