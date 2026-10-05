<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role')
            ->orderBy('name')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:4|confirmed',
                'role' => 'required|in:user,nhanvien',
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên.',

                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'email.unique' => 'Email này đã được sử dụng.',

                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải có ít nhất 4 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',

                'role.required' => 'Vui lòng chọn loại tài khoản.',
                'role.in' => 'Loại tài khoản không hợp lệ.',
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Thêm tài khoản thành công.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',

                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],

                'role' => 'required|in:user,nhanvien,admin',

                'password' => 'nullable|string|min:4|confirmed',
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên.',

                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'email.unique' => 'Email này đã được sử dụng.',

                'role.required' => 'Vui lòng chọn loại tài khoản.',
                'role.in' => 'Loại tài khoản không hợp lệ.',

                'password.min' => 'Mật khẩu phải có ít nhất 4 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            ]
        );

        /*
         * Không cho Admin đang đăng nhập tự đổi quyền
         * của chính mình thành user hoặc nhân viên.
         */
        if (
            auth()->id() === $user->id &&
            $request->role !== 'admin'
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Bạn không thể tự thay đổi quyền Admin của chính mình.'
                );
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Cập nhật tài khoản thành công.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Bạn không thể xóa tài khoản đang đăng nhập.'
                );
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Xóa tài khoản thành công.');
    }
}