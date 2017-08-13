<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    public function show($id)
    {
        $user = User::find($id);
        $tasklist = $user->tasklist()->orderBy('created_at', 'desc')->paginate(10);
        $count_tasklist = $user->tasklist()->count();
        
        $data = [
            'user' => $user,
            'tasklist' => $tasklist,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
}
