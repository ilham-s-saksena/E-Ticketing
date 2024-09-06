<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users_dashboard(Request $request, UserService $userService)
    {
        return view('users.dashboard');
    }
}
