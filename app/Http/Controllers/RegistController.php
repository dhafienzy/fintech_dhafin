<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Saldo;
use Illuminate\Support\Facades\Hash;

class RegistController extends Controller
{
    function create(){
        return view('auth.register');
    }

    function register(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 3;
        $user->save();

        if ($user->role_id == 3){
            Saldo::create([
                'user_id' => $user->id,
                'saldo' => 0
            ]);
        }

        return redirect()->route('auth')->with('Success', 'Silahkan Anda Login');
    }
}
