<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        return response()
            ->json(['data' => $user]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();


        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home']);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user->update($request->all());
       
        return response()
        ->json(['message' => 'Updated successfully']);
    }

    
    public function delete($id)
    {
        User::destroy($id);

        return response()
        ->json(['message' => 'Deleted successfully']);
    }

    public function getUser(Request $request)
    {

        $id= $request->user()->id;
        
        return response()
        ->json(['message' => 'user ID is:'.$id]);
    }
        
    public function getUsers()
    {

        $users = DB::table('users')->get();
        
        return response()
        ->json(['message' => 'user ID is:'.$users]);
    }
}
