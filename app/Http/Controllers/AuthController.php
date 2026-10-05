<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.dang-ky');
    }

    public function register(Request $request)
    {
        $inline = $request->boolean('inline_register');

        if ($inline && Auth::check()) {
            return $this->redirectTheoQuyen();
        }

        $request->validateWithBag(
            $inline ? 'inlineRegister' : 'default',
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'date_of_birth' => 'required|date|before:today',
                'gender' => 'required|in:nam,nu,khac',
                'phone' => 'required|string|max:20',
                'password' => 'required|min:4|confirmed',
            ],
            [
                'name.required' => 'Vui lòng nhập họ và tên.',
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
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải có ít nhất 4 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        if ($inline) {
            Auth::login($user);
            $request->session()->regenerate();

            return $this->redirectAfterInlineAuth('Đăng ký tài khoản thành công.');
        }

        return redirect()
            ->route('dang-nhap')
            ->with(
                'success',
                'Đăng ký tài khoản thành công. Vui lòng đăng nhập.'
            );
    }

    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectTheoQuyen();
        }

        if ($request->filled('redirect')) {
            $redirectUrl = $request->query('redirect');

            if (
                is_string($redirectUrl)
                && str_starts_with($redirectUrl, url('/'))
            ) {
                session([
                    'url.intended' => $redirectUrl,
                ]);
            }
        }

        return view('auth.dang-nhap');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
            ]
        );

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectTheoQuyen();
        }

        return back()
            ->withErrors([
                'email' => 'Email hoặc mật khẩu không chính xác.',
            ])
            ->onlyInput('email');
    }


    public function loginInline(Request $request)
    {
        $request->validateWithBag(
            'inlineLogin',
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
            ]
        );

        $credentials = $request->only(
            'email',
            'password'
        );

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors(
                    [
                        'email' => 'Email hoặc mật khẩu không chính xác.',
                    ],
                    'inlineLogin'
                )
                ->withInput()
                ->with(
                    'show_inline_login',
                    true
                );
        }

        $request->session()->regenerate();

        return $this->redirectAfterInlineAuth('Đăng nhập thành công.');
    }

    private function redirectAfterInlineAuth(string $message)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.trang-chu');
        }

        if ($user->role === 'nhanvien') {
            return redirect()
                ->route('nhanvien.trang-chu');
        }

        $tripType = session(
            'flight_search.trip_type',
            'one_way'
        );

        if ($tripType === 'round_trip') {
            $hasBooking =
                session('booking.outbound.flight_id')
                && session('booking.outbound.seat_id')
                && session('booking.return.flight_id')
                && session('booking.return.seat_id');
        } else {
            $hasBooking =
                session('booking.flight_id')
                && session('booking.seat_id');
        }

        if ($hasBooking) {
            return redirect()
                ->route('passenger.create')
                ->with(
                    'success',
                    $message . ' Thông tin chuyến bay và ghế đã chọn được giữ lại.'
                );
        }

        return back()
            ->with(
                'success',
                $message
            );
    }

    private function redirectTheoQuyen()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.trang-chu');
        }

        if ($user->role === 'nhanvien') {
            return redirect()->route('nhanvien.trang-chu');
        }

        return redirect()->intended(
            route('trang-chu')
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('trang-chu')
            ->with(
                'success',
                'Đăng xuất thành công.'
            );
    }
}
