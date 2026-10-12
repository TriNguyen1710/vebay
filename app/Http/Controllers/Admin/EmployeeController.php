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