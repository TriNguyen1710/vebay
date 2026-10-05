<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aircraft;
use Illuminate\Http\Request;

class AircraftController extends Controller
{
    // Danh sách máy bay
    public function index()
    {
        $aircrafts = Aircraft::orderBy('id', 'desc')->get();

        return view('admin.aircraft.index', compact('aircrafts'));
    }

    // Trang thêm máy bay
    public function create()
    {
        return view('admin.aircraft.create');
    }

    // Lưu máy bay
    public function store(Request $request)
    {
        $request->validate(
            [
                'code' => 'required|string|max:50|unique:aircraft,code',
                'name' => 'required|string|max:255',
                'rows' => 'required|integer|min:1|max:100',
                'seats_per_row' => 'required|integer|min:1|max:10',
                'status' => 'required|boolean',
            ],
            [
                'code.required' => 'Vui lòng nhập mã máy bay.',
                'code.unique' => 'Mã máy bay đã tồn tại.',

                'name.required' => 'Vui lòng nhập tên hoặc loại máy bay.',

                'rows.required' => 'Vui lòng nhập số hàng ghế.',
                'rows.integer' => 'Số hàng ghế phải là số nguyên.',
                'rows.min' => 'Máy bay phải có ít nhất 1 hàng ghế.',

                'seats_per_row.required' => 'Vui lòng nhập số ghế mỗi hàng.',
                'seats_per_row.integer' => 'Số ghế mỗi hàng phải là số nguyên.',
                'seats_per_row.min' => 'Mỗi hàng phải có ít nhất 1 ghế.',

                'status.required' => 'Vui lòng chọn trạng thái.',
            ]
        );

        $totalSeats = $request->rows * $request->seats_per_row;

        Aircraft::create([
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'rows' => $request->rows,
            'seats_per_row' => $request->seats_per_row,
            'total_seats' => $totalSeats,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.aircraft.index')
            ->with('success', 'Thêm máy bay thành công.');
    }

    // Trang sửa máy bay
    public function edit(Aircraft $aircraft)
    {
        return view('admin.aircraft.edit', compact('aircraft'));
    }

    // Cập nhật máy bay
    public function update(Request $request, Aircraft $aircraft)
    {
        $request->validate(
            [
                'code' => 'required|string|max:50|unique:aircraft,code,' . $aircraft->id,
                'name' => 'required|string|max:255',
                'rows' => 'required|integer|min:1|max:100',
                'seats_per_row' => 'required|integer|min:1|max:10',
                'status' => 'required|boolean',
            ],
            [
                'code.required' => 'Vui lòng nhập mã máy bay.',
                'code.unique' => 'Mã máy bay đã tồn tại.',

                'name.required' => 'Vui lòng nhập tên hoặc loại máy bay.',

                'rows.required' => 'Vui lòng nhập số hàng ghế.',
                'rows.integer' => 'Số hàng ghế phải là số nguyên.',

                'seats_per_row.required' => 'Vui lòng nhập số ghế mỗi hàng.',
                'seats_per_row.integer' => 'Số ghế mỗi hàng phải là số nguyên.',

                'status.required' => 'Vui lòng chọn trạng thái.',
            ]
        );

        $totalSeats = $request->rows * $request->seats_per_row;

        $aircraft->update([
            'code' => strtoupper($request->code),
            'name' => $request->name,
            'rows' => $request->rows,
            'seats_per_row' => $request->seats_per_row,
            'total_seats' => $totalSeats,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.aircraft.index')
            ->with('success', 'Cập nhật máy bay thành công.');
    }

    // Xóa máy bay
    public function destroy(Aircraft $aircraft)
    {
        $aircraft->delete();

        return redirect()
            ->route('admin.aircraft.index')
            ->with('success', 'Xóa máy bay thành công.');
    }
}