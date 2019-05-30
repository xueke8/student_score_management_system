<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function showProfileForm()
    {
        $profile = Auth::guard('teacher')->user();

        return view('teacher.profile')->with('profile', $profile);
    }

    public function updateProfile(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();

        if ($phone = $request->get('phone')) {
            $teacher->phone = $phone;
            $teacher->save();
        }

        return redirect()->route('teacher');
    }

    public function showPasswordForm()
    {
        return view('teacher.password');
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
        $teacher = Auth::guard('teacher')->user();

        if (!password_verify($passwords['old_password'], $teacher->password)) {
            return back()->withErrors(['old_password' => '原密码错误']);
        }

        $teacher->password = Hash::make($passwords['new_password']);
        $teacher->save();

        Auth::guard('teacher')->logout();

        return redirect()->route('teacher');
    }
}
