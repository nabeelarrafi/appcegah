<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Master\Auth\LoginDetail;

class AuthController extends Controller
{
    public function login()
    {
        if(\Session::has('id_user') && \Session::has('token')) return redirect()->route('Admin:Dashboard:Index');
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if(!\Auth::attempt(['username' => $username, 'password' => $request->password])) return redirect()->route('Admin:Login')->withInput()->with('error', 'Username or password is invalid!');

        $id_user = User::where('username', $username)->first()->id_user;
        $token   = bcrypt($id_user);

        LoginDetail::create([
            'id_user' => $id_user,
            'token' => $token,
            'created_by' => $id_user,
            'updated_by' => $id_user,
            'is_active' => 1,
        ]);

        \Session::put('id_user', $id_user);
        \Session::put('token', $token);

        return redirect()->route('Admin:Dashboard:Index');
    }

    public function logout()
    {
        LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['token', \Session::get('token')]
        ])->update([
            'is_active' => 0
        ]);
        \Session::flush();

        return redirect()->route('Admin:Login');
    }
}
