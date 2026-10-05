<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaggagePackage;
use Illuminate\Http\Request;

class BaggagePackageController extends Controller
{
    public function index()
    {
        $carryOn = BaggagePackage::where('type', 'carry_on')->first();

        $checkedPackages = BaggagePackage::where('type', 'checked')
            ->orderBy('weight')
            ->get();

        return view('admin.baggage.index', compact(
            'carryOn',
            'checkedPackages'
        ));
    }

    public function updateCarryOn(Request $request)
    {
        $validated = $request->validate(
            [
                'weight' => ['required', 'integer', 'min:0', 'max:100'],
                'status' => ['required', 'boolean'],
            ],
            [
                'weight.required' => 'Vui lòng nhập số kg hành lý xách tay.',
                'weight.integer' => 'Số kg hành lý xách tay phải là số nguyên.',
                'weight.min' => 'Số kg hành lý xách tay không được nhỏ hơn 0.',
                'weight.max' => 'Số kg hành lý xách tay không được lớn hơn 100.',
                'status.required' => 'Vui lòng chọn trạng thái.',
                'status.boolean' => 'Trạng thái không hợp lệ.',
            ]
        );

        $carryOn = BaggagePackage::firstOrNew([
            'type' => 'carry_on',
        ]);

        $carryOn->name = 'Hành lý xách tay';
        $carryOn->weight = $validated['weight'];
        $carryOn->price = 0;
        $carryOn->status = $validated['status'];
        $carryOn->save();

        return redirect()
            ->route('admin.baggage.index')
            ->with('success', 'Cập nhật hành lý xách tay thành công.');
    }

    public function createChecked()
    {
        return view('admin.baggage.create');
    }

    public function storeChecked(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'weight' => ['required', 'integer', 'min:1', 'max:100'],
                'price' => ['required', 'numeric', 'min:0'],
                'status' => ['required', 'boolean'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên gói hành lý.',
                'weight.required' => 'Vui lòng nhập số kg.',
                'weight.integer' => 'Số kg phải là số nguyên.',
                'weight.min' => 'Số kg phải lớn hơn 0.',
                'weight.max' => 'Số kg không được lớn hơn 100.',
                'price.required' => 'Vui lòng nhập giá gói hành lý.',
                'price.numeric' => 'Giá gói hành lý phải là số.',
                'price.min' => 'Giá gói hành lý không được nhỏ hơn 0.',
                'status.required' => 'Vui lòng chọn trạng thái.',
                'status.boolean' => 'Trạng thái không hợp lệ.',
            ]
        );

        BaggagePackage::create([
            'type' => 'checked',
            'name' => $validated['name'],
            'weight' => $validated['weight'],
            'price' => $validated['price'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.baggage.index')
            ->with('success', 'Thêm gói hành lý ký gửi thành công.');
    }

    public function editChecked(BaggagePackage $baggagePackage)
    {
        if ($baggagePackage->type !== 'checked') {
            abort(404);
        }

        return view('admin.baggage.edit', compact('baggagePackage'));
    }

    public function updateChecked(
        Request $request,
        BaggagePackage $baggagePackage
    ) {
        if ($baggagePackage->type !== 'checked') {
            abort(404);
        }

        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'weight' => ['required', 'integer', 'min:1', 'max:100'],
                'price' => ['required', 'numeric', 'min:0'],
                'status' => ['required', 'boolean'],
            ],
            [
                'name.required' => 'Vui lòng nhập tên gói hành lý.',
                'weight.required' => 'Vui lòng nhập số kg.',
                'weight.integer' => 'Số kg phải là số nguyên.',
                'weight.min' => 'Số kg phải lớn hơn 0.',
                'weight.max' => 'Số kg không được lớn hơn 100.',
                'price.required' => 'Vui lòng nhập giá gói hành lý.',
                'price.numeric' => 'Giá gói hành lý phải là số.',
                'price.min' => 'Giá gói hành lý không được nhỏ hơn 0.',
                'status.required' => 'Vui lòng chọn trạng thái.',
                'status.boolean' => 'Trạng thái không hợp lệ.',
            ]
        );

        $baggagePackage->update([
            'name' => $validated['name'],
            'weight' => $validated['weight'],
            'price' => $validated['price'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.baggage.index')
            ->with('success', 'Cập nhật gói hành lý ký gửi thành công.');
    }

    public function destroyChecked(BaggagePackage $baggagePackage)
    {
        if ($baggagePackage->type !== 'checked') {
            abort(404);
        }

        $baggagePackage->delete();

        return redirect()
            ->route('admin.baggage.index')
            ->with('success', 'Xóa gói hành lý ký gửi thành công.');
    }
}