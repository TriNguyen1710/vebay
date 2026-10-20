<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EmployeeAccountMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'nhanvien');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        $employees = $query
            ->orderBy('name')
            ->get();

        return view(
            'admin.employees.index',
            compact('employees')
        );
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'phone' => 'required|string|max:20',
                'password' => 'required|string|min:6|confirmed',
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên nhân viên.',
                'email.required' => 'Vui lòng nhập Gmail nhân viên.',
                'email.email' => 'Gmail không đúng định dạng.',
                'email.unique' => 'Email này đã tồn tại trong hệ thống.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            ]
        );

        $plainPassword = $request->password;

        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($plainPassword),
            'role' => 'nhanvien',
            'employee_account_confirmed_at' => null,
        ]);

        try {
            Mail::to($employee->email)
                ->send(
                    new EmployeeAccountMail(
                        $employee,
                        $plainPassword
                    )
                );
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.employees.index')
                ->with(
                    'success',
                    'Tạo nhân viên thành công nhưng gửi Email thất bại.'
                );
        }

        return redirect()
            ->route('admin.employees.index')
            ->with(
                'success',
                'Thêm nhân viên thành công và đã gửi thông tin đăng nhập qua Email.'
            );
    }

    public function confirmAccount(Request $request, User $user)
    {
        if (!$request->hasValidSignature()) {
            abort(403, 'Liên kết xác nhận không hợp lệ hoặc đã hết hạn.');
        }

        if ($user->role !== 'nhanvien') {
            abort(404);
        }

        if (!$user->employee_account_confirmed_at) {
            $user->update([
                'employee_account_confirmed_at' => now(),
            ]);
        }

        return response(
            '<!DOCTYPE html>
            <html lang="vi">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Xác nhận tài khoản - Vietjet</title>
            </head>
            <body style="
                margin:0;
                padding:0;
                background:#f3f6f9;
                font-family:Arial,Helvetica,sans-serif;
                color:#22313f;
            ">
                <div style="
                    min-height:100vh;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    padding:20px;
                    box-sizing:border-box;
                ">
                    <div style="
                        width:100%;
                        max-width:520px;
                        background:#ffffff;
                        border-radius:10px;
                        padding:40px 35px;
                        box-sizing:border-box;
                        text-align:center;
                        box-shadow:0 5px 20px rgba(0,0,0,0.08);
                    ">
                        <div style="
                            color:#003b70;
                            font-size:30px;
                            font-weight:bold;
                            margin-bottom:25px;
                        ">
                            Viet<span style="color:#f4b400;">jet</span>
                        </div>

                        <div style="
                            width:65px;
                            height:65px;
                            margin:0 auto 20px;
                            border-radius:50%;
                            background:#e9f7ef;
                            color:#198754;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:32px;
                            font-weight:bold;
                        ">
                            ✓
                        </div>

                        <h2 style="
                            margin:0 0 15px;
                            color:#003b70;
                            font-size:22px;
                        ">
                            Xác nhận thành công
                        </h2>

                        <p style="
                            margin:0;
                            color:#53626e;
                            font-size:14px;
                            line-height:1.7;
                        ">
                            Bạn đã xác nhận nhận được thông tin tài khoản nhân viên.
                            Admin có thể xem trạng thái xác nhận của bạn trên hệ thống.
                        </p>
                    </div>
                </div>
            </body>
            </html>'
        );
    }

    public function edit(User $user)
    {
        if ($user->role !== 'nhanvien') {
            abort(404);
        }

        return view(
            'admin.employees.edit',
            compact('user')
        );
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'nhanvien') {
            abort(404);
        }

        $request->validate(
            [
                'name' => 'required|string|max:255',

                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')
                        ->ignore($user->id),
                ],

                'phone' => 'required|string|max:20',

                'password' => 'nullable|string|min:6|confirmed',
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên nhân viên.',
                'email.required' => 'Vui lòng nhập Gmail nhân viên.',
                'email.email' => 'Gmail không đúng định dạng.',
                'email.unique' => 'Email này đã tồn tại trong hệ thống.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->email !== $user->email) {
            $data['employee_account_confirmed_at'] = null;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make(
                $request->password
            );
        }

        $user->update($data);

        return redirect()
            ->route('admin.employees.index')
            ->with(
                'success',
                'Cập nhật nhân viên thành công.'
            );
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'nhanvien') {
            abort(404);
        }

        $user->delete();

        return redirect()
            ->route('admin.employees.index')
            ->with(
                'success',
                'Xóa nhân viên thành công.'
            );
    }
}   