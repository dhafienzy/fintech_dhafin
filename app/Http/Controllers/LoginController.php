<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');

    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'email wajib diisi',
            'password.required'=>'Password wajib diisi'
        ]);
        $infologin=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($infologin)){
            if(Auth::user()){
                $userRole=Auth::user()->role_id;
                if($userRole===1){
                    return redirect()->route('data_transaksi')->with('sukses', 'anda berhasil login sebagai bank');
                }elseif($userRole===2){
                    return redirect()->route('menu')->with('sukses', 'anda berhasil login menjadi toko');
                }elseif($userRole===3){
                    return redirect()->route('home')->with('sukses', 'anda berhasil login menjadi user');
                }
                
            }
        }
        return redirect()->back()->withErrors([
            'email'=>'email atau password salah'
        ]);
    }
    
}
