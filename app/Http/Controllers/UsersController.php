<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function getUsers()
    {
        $users = User::paginate(6);
        return response()->json($users);
        //return view('users.index', ['users' => $users]);
    }

    public function generateUsers($count)
    {
        $users = User::factory()->count($count)->create();
        return response()->json($users);
    }

    public function dropUsers()
    {
        $users = DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        $users = $users.' users deleted';
        return response()->json($users);
    }
    public function addUser(Request $request)
    {
        \Log::info('Request data:', $request->all());
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;        
        $user->save();
        return response()->json($user);
    }
    

}
