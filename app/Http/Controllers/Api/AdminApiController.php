<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminApiController extends Controller
{
    // IS ADMIN
    public function isAdmin() {

        return response()->json([
            'message' => 'You are an admin'
        ]);
    }

    // GET USER
    public function getUsers() {

        // $users = User::with('books')->get();
        $users = User::all();
        $users->load('roles');

        return response()->json($users);
    }
    // ADD USER
    public function addUser(Request $request) {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }
    // UPDATE USER
    public function updateUser(Request $request, $id) {

        $adminRole = Role::findByName('admin');
        $userRole = Role::findByName('user');

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($request -> admin) {
            $user -> removeRole($userRole);
            $user -> assignRole($adminRole);
        } else {
            $user -> removeRole($adminRole);
            $user -> assignRole($userRole);
        }

        return response()->json([
            'user' => $user
        ]);
    }
    // DELETE USER
    public function deleteUser($id) {

        $user = User::find($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted'
        ]);
    }
}
