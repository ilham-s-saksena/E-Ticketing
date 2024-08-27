<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_dashboard(Request $request, UserService $userService)
    {
    }
}
