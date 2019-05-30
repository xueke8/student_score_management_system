<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function showProfileForm()
    {
        $profile = Auth::guard('student')->user();

        return view('student.profile')->with('profile', $profile);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'id_number' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $student = Auth::guard('student')->user();

        $student->update($request->only(['id_number', 'phone', 'address']));

        return redirect()->route('student');
    }

    public function showPasswordForm()
    {
        return view('student.password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => '请输入旧密码',
            'new_password.required' => '请输入新密码',
            'new_password.min' => '密码至少6位',
            'confirm_password.required' => '请再次输入密码',
            'confirm_password.same' => '两次输入的密码不一致',
        ]);

        $passwords = $request->only(['old_password', 'new_password', 'confirm_password']);
        $student = Auth::guard('student')->user();

        if (!password_verify($passwords['old_password'], $student->password)) {
            return back()->withErrors(['old_password' => '原密码错误']);
        }

        $student->password = Hash::make($passwords['new_password']);
        $student->save();

        Auth::guard('student')->logout();

        return redirect()->route('student');
    }
}
