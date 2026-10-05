<?php

namespace App\Http\Controllers;

use App\Models\BaggagePackage;
use Illuminate\Http\Request;

class BaggageController extends Controller
{
    public function create()
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()
                ->route('flights.search.form')
                ->with('error', 'Vui lòng chọn chuyến bay trước.');
        }

        $carryOn = BaggagePackage::where('type', 'carry_on')
            ->where('status', true)
            ->first();

        $checkedPackages = BaggagePackage::where('type', 'checked')
            ->where('status', true)
            ->orderBy('weight')
            ->get();

        $tripType = session('flight_search.trip_type', 'one_way');

        return view('user.chon-hanh-ly', compact(
            'carryOn',
            'checkedPackages',
            'tripType',
            'booking'
        ));
    }

    public function store(Request $request)
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()
                ->route('flights.search.form')
                ->with('error', 'Vui lòng chọn chuyến bay trước.');
        }

        $tripType = session('flight_search.trip_type', 'one_way');

        if ($tripType === 'round_trip') {
            $request->validate(
                [
                    'outbound_baggage_package_id' => [
                        'nullable',
                        'integer',
                        'exists:baggage_packages,id',
                    ],
                    'return_baggage_package_id' => [
                        'nullable',
                        'integer',
                        'exists:baggage_packages,id',
                    ],
                ],
                [
                    'outbound_baggage_package_id.exists' =>
                        'Gói hành lý chiều đi không hợp lệ.',
                    'return_baggage_package_id.exists' =>
                        'Gói hành lý chiều về không hợp lệ.',
                ]
            );

            $outboundPackage = $this->findCheckedPackage(
                $request->outbound_baggage_package_id
            );

            $returnPackage = $this->findCheckedPackage(
                $request->return_baggage_package_id
            );

            session([
                'baggage.outbound' => [
                    'package_id' => $outboundPackage?->id,
                    'weight' => $outboundPackage?->weight ?? 0,
                    'price' => $outboundPackage?->price ?? 0,
                ],
                'baggage.return' => [
                    'package_id' => $returnPackage?->id,
                    'weight' => $returnPackage?->weight ?? 0,
                    'price' => $returnPackage?->price ?? 0,
                ],
            ]);
        } else {
            $request->validate(
                [
                    'baggage_package_id' => [
                        'nullable',
                        'integer',
                        'exists:baggage_packages,id',
                    ],
                ],
                [
                    'baggage_package_id.exists' =>
                        'Gói hành lý ký gửi không hợp lệ.',
                ]
            );

            $package = $this->findCheckedPackage(
                $request->baggage_package_id
            );

            session([
                'baggage' => [
                    'package_id' => $package?->id,
                    'weight' => $package?->weight ?? 0,
                    'price' => $package?->price ?? 0,
                ],
            ]);
        }

        return redirect()->route('face.create');
    }

    private function findCheckedPackage(?int $packageId): ?BaggagePackage
    {
        if (!$packageId) {
            return null;
        }

        return BaggagePackage::where('id', $packageId)
            ->where('type', 'checked')
            ->where('status', true)
            ->firstOrFail();
    }
}