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

        if ($user->role === 'nhanvien') {
            return view(
                'nhanvien.thong-tin-ca-nhan',
                compact('user')
            );
        }

        return view(
            'user.thong-tin-ca-nhan',
            compact('user')
        );
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'nhanvien') {
            $request->validate([
                'employee_action' => [
                    'nullable',
                    'in:profile,password',
                ],
            ]);

            if ($request->input('employee_action') === 'profile') {
                return $this->updateEmployeeProfile($request);
            }

            return $this->updateEmployeePassword($request);
        }

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

    private function updateEmployeeProfile(Request $request)
    {
        $validated = $request->validateWithBag(
            'employeeProfile',
            [
                'date_of_birth' => [
                    'required',
                    'date_format:Y-m-d',
                    'before:today',
                ],
                'gender' => [
                    'required',
                    'in:nam,nu,khac',
                ],
            ],
            [
                'date_of_birth.required' =>
                    'Vui lòng chọn ngày sinh.',

                'date_of_birth.date_format' =>
                    'Ngày sinh không hợp lệ.',

                'date_of_birth.before' =>
                    'Ngày sinh phải trước ngày hiện tại.',

                'gender.required' =>
                    'Vui lòng chọn giới tính.',

                'gender.in' =>
                    'Giới tính không hợp lệ.',
            ]
        );

        // Chỉ cập nhật hai trường của nhân viên đang đăng nhập.
        $user = $request->user();

        $user->date_of_birth = $validated['date_of_birth'];
        $user->gender = $validated['gender'];

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Cập nhật ngày sinh và giới tính thành công.'
            );
    }

    private function updateEmployeePassword(Request $request)
    {
        $validated = $request->validateWithBag(
            'employeePassword',
            [
                'current_password' => [
                    'required',
                    'string',
                    'current_password:web',
                ],
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'confirmed',
                    'different:current_password',
                    function ($attribute, $value, $fail) {
                        if (is_string($value) && strlen($value) > 72) {
                            $fail(
                                'Mật khẩu mới quá dài. Vui lòng chọn mật khẩu ngắn hơn.'
                            );
                        }
                    },
                ],
            ],
            [
                'current_password.required' =>
                    'Vui lòng nhập mật khẩu hiện tại.',

                'current_password.current_password' =>
                    'Mật khẩu hiện tại không đúng.',

                'password.required' =>
                    'Vui lòng nhập mật khẩu mới.',

                'password.min' =>
                    'Mật khẩu mới phải có ít nhất 6 ký tự.',

                'password.confirmed' =>
                    'Xác nhận mật khẩu mới không khớp.',

                'password.different' =>
                    'Mật khẩu mới phải khác mật khẩu hiện tại.',
            ]
        );

        // Chỉ đổi mật khẩu của chính nhân viên đang đăng nhập.
        $user = $request->user();

        $user->password = Hash::make(
            $validated['password']
        );

        $user->save();

        // Đổi mã phiên, giữ đăng nhập trên trình duyệt hiện tại.
        $request->session()->regenerate();

        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Đổi mật khẩu thành công. Lần đăng nhập sau hãy dùng mật khẩu mới.'
            );
    }
}