<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefundSettingController extends Controller
{
    public function edit()
    {
        $refundPercentage = DB::table('settings')
            ->where(
                'key',
                'refund_percentage'
            )
            ->value('value');

        if ($refundPercentage === null) {
            $refundPercentage = 60;
        }

        return view(
            'admin.refund-settings.edit',
            compact('refundPercentage')
        );
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'refund_percentage' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],
        ], [
            'refund_percentage.required' =>
                'Vui lòng nhập tỷ lệ hoàn tiền.',
            'refund_percentage.numeric' =>
                'Tỷ lệ hoàn tiền phải là số.',
            'refund_percentage.min' =>
                'Tỷ lệ hoàn tiền không được nhỏ hơn 0%.',
            'refund_percentage.max' =>
                'Tỷ lệ hoàn tiền không được lớn hơn 100%.',
        ]);

        DB::table('settings')->updateOrInsert(
            [
                'key' => 'refund_percentage',
            ],
            [
                'value' => $validated['refund_percentage'],
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return redirect()
            ->route('admin.refund-settings.edit')
            ->with(
                'success',
                'Đã cập nhật tỷ lệ hoàn tiền khi hủy vé.'
            );
    }
}
