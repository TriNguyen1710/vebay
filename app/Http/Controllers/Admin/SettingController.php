<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $changeTicketFee = Setting::where('key', 'change_ticket_fee')->value('value');

        if ($changeTicketFee === null) {
            $changeTicketFee = 100000;
        }

        return view('admin.cai-dat', compact('changeTicketFee'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'change_ticket_fee' => [
                'required',
                'numeric',
                'min:0',
                'max:10000000',
            ],
        ], [
            'change_ticket_fee.required' => 'Vui lòng nhập phí đổi vé.',
            'change_ticket_fee.numeric' => 'Phí đổi vé phải là số.',
            'change_ticket_fee.min' => 'Phí đổi vé không được nhỏ hơn 0.',
            'change_ticket_fee.max' => 'Phí đổi vé không được lớn hơn 10.000.000đ.',
        ]);

        Setting::updateOrCreate(
            [
                'key' => 'change_ticket_fee',
            ],
            [
                'value' => (int) $validated['change_ticket_fee'],
            ]
        );

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Cập nhật phí đổi vé thành công.');
    }
}