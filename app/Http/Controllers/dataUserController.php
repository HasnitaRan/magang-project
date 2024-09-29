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
}