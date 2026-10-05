<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    // Danh sách sân bay
    public function index()
    {
        $airports = Airport::orderBy('id', 'desc')->get();

        return view('admin.airports.index', compact('airports'));
    }

    // Trang thêm sân bay
    public function create()
    {
        return view('admin.airports.create');
    }

    // Lưu sân bay mới
    public function store(Request $request)
    {
        $request->validate(
            [
                'code' => 'required|string|max:10|unique:airports,code',
                'name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'status' => 'required|boolean',
            ],
            [
                'code.required' => 'Vui lòng nhập mã sân bay.',
                'code.unique' => 'Mã sân bay đã tồn tại.',
                'name.required' => 'Vui lòng nhập tên sân bay.',
                'city.required' => 'Vui lòng nhập thành phố.',
                'status.required' => 'Vui lòng chọn trạng thái.',
            ]
        );

        Airport::create([
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'city' => $request->city,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.airports.index')
            ->with('success', 'Thêm sân bay thành công.');
    }

    // Trang sửa sân bay
    public function edit(Airport $airport)
    {
        return view('admin.airports.edit', compact('airport'));
    }

    // Cập nhật sân bay
    public function update(Request $request, Airport $airport)
    {
        $request->validate(
            [
                'code' => 'required|string|max:10|unique:airports,code,' . $airport->id,
                'name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'status' => 'required|boolean',
            ],
            [
                'code.required' => 'Vui lòng nhập mã sân bay.',
                'code.unique' => 'Mã sân bay đã tồn tại.',
                'name.required' => 'Vui lòng nhập tên sân bay.',
                'city.required' => 'Vui lòng nhập thành phố.',
                'status.required' => 'Vui lòng chọn trạng thái.',
            ]
        );

        $airport->update([
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'city' => $request->city,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.airports.index')
            ->with('success', 'Cập nhật sân bay thành công.');
    }

    // Xóa sân bay
    public function destroy(Airport $airport)
    {
        $airport->delete();

        return redirect()
            ->route('admin.airports.index')
            ->with('success', 'Xóa sân bay thành công.');
    }
}