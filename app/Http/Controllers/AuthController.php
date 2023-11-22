<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(request $request)
    {
        $user = User::where('username',$request->username)->first();
        if ($user) {
            if ($user->role == 'admin') {
                $auth = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
                if ($auth) {
                    return redirect('admin');
                }
            }
            if ($request->username == $user->username && $request->password == $user->password) {
                $request->session()->put('user',$user);
                return redirect('user');
            }
        }
        return redirect()->back()->with('message','username atau password tidak valid');
    }
    public function store(request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username|alpha_dash',
            'password' => 'required',
        ], [
            'name.required' => 'Nama harus Diisi',
            'username.required' => 'Username harus Diisi',
            'username.unique' => 'Username Sudah Dipakai',
            'username.without_spaces' => 'Username tidak boleh menggunakan spasi',
            'password.required' => 'Password Harus Diisi',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'password'=>$request->password,
        ]);

        $request->session()->put('user',$user);

        return redirect('user');
    }
    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }
}
