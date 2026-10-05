<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view(
            'user.thong-tin-ca-nhan',
            compact('user')
        );
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],
                'date_of_birth' => ['required', 'date', 'before:today'],
                'gender' => ['required', 'in:nam,nu,khac'],
                'phone' => ['required', 'string', 'max:20'],
                'current_password' => ['nullable', 'string'],
                'password' => ['nullable', 'string', 'min:4', 'confirmed'],
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên.',
                'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'email.unique' => 'Email này đã được sử dụng.',
                'date_of_birth.required' => 'Vui lòng chọn ngày sinh.',
                'date_of_birth.date' => 'Ngày sinh không hợp lệ.',
                'date_of_birth.before' => 'Ngày sinh phải trước ngày hiện tại.',
                'gender.required' => 'Vui lòng chọn giới tính.',
                'gender.in' => 'Giới tính không hợp lệ.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
                'password.min' => 'Mật khẩu mới phải có ít nhất 4 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            ]
        );

        if (!empty($validated['password'])) {
            if (empty($validated['current_password'])) {
                return back()
                    ->withErrors([
                        'current_password' => 'Vui lòng nhập mật khẩu hiện tại.',
                    ])
                    ->withInput();
            }

            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()
                    ->withErrors([
                        'current_password' => 'Mật khẩu hiện tại không đúng.',
                    ])
                    ->withInput();
            }
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->date_of_birth = $validated['date_of_birth'];
        $user->gender = $validated['gender'];
        $user->phone = $validated['phone'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Cập nhật thông tin cá nhân thành công.');
    }
}
