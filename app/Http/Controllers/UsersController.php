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
        $users = User::all();
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    public function show($id)
    {
        $user = User::find($id);
        
        return view('users.show', [
            'user' => $user,
        ]);

        $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
        $count_tasks = $user->tasks()->count();
        
        $data = [
            'user' => $user,
            'tasks' => $tasks,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
}