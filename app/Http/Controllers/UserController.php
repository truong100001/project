<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function user()
    {
        $users = DB::table('users')->get();
        return view('pages.user',compact('users'));
    }
}
