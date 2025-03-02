<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index () {
        $users = User::where('role_id', '!=' , 1)->paginate(10);
         return view('dashboard-users.index', compact('users'));
    }
}
