<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|digits:8',
            'password' => 'required|min:6',
            'identity' => ['required', Rule::in(['student', 'teacher'])]
        ], [
            'id.required' => '教师号或学号是必须的',
            'id.digits' => '教师号或学号只能是8位数',
            'password.required' => '密码是必须的',
            'password.min' => '密码最短是6位',
            'identity.min' => '身份是必须勾选',
            'identity.in' => '身份只能是student或者teacher',
        ]);

        $identity = $request->post('identity', 'student');

        $credentials = $request->only(['id', 'password']);
        $remember = $request->get('remember', false);

        if (Auth::guard($identity)->attempt($credentials, $remember)) {
            return redirect()->route($identity);
        }

        return redirect()->back()->withErrors([
            'id' => '登录名或密码错误'
        ]);
    }

    public function logout()
    {
        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        }

        if (Auth::guard('teacher')->check()) {
            Auth::guard('teacher')->logout();
        }

        return redirect()->route('login');
    }
}
