<?php

namespace App\Http\Controllers;

use App\Models\BaggagePackage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BaggageController extends Controller
{
    /**
     * Số lượng hành khách đang đặt vé.
     */
    private function passengerCount(): int
    {
        return max(
            1,
            min(
                5,
                (int) session('flight_search.passenger_count', 1)
            )
        );
    }

    /**
     * Kiểm tra đã nhập đủ thông tin hành khách.
     */
    private function hasPassengers(): bool
    {
        $count = $this->passengerCount();

        $passengers = session('booking.passengers', []);

        if (
            is_array($passengers)
            && count($passengers) === $count
        ) {
            foreach ($passengers as $passenger) {
                if (
                    empty($passenger['full_name'])
                    || empty($passenger['cccd_image'])
                ) {
                    return false;
                }
            }

            return true;
        }

        /*
         * Tương thích với cách lưu một hành khách cũ.
         */
        if ($count === 1) {
            $passenger = session('booking.passenger');

            return is_array($passenger)
                && !empty($passenger['full_name'])
                && !empty($passenger['cccd_image']);
        }

        return false;
    }

    /**
     * Lấy gói hành lý ký gửi đang mở bán.
     */
    private function checkedPackageRule()
    {
        return Rule::exists('baggage_packages', 'id')
            ->where('type', 'checked')
            ->where('status', 1);
    }

    /**
     * Thông tin gói hành lý để lưu session.
     */
    private function packageData(
        ?BaggagePackage $package
    ): array {
        return [
            'package_id' => $package?->id,
            'weight' => $package?->weight ?? 0,
            'price' => $package?->price ?? 0,
        ];
    }

    /**
     * Tìm gói hành lý đã chọn.
     */
    private function findCheckedPackage(
        $packageId
    ): ?BaggagePackage {
        if ($packageId === null || $packageId === '') {
            return null;
        }

        return BaggagePackage::where('id', $packageId)
            ->where('type', 'checked')
            ->where('status', 1)
            ->firstOrFail();
    }

    /**
     * Hiển thị trang chọn hành lý.
     */
    public function create()
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Vui lòng chọn chuyến bay trước.'
                );
        }

        if (!$this->hasPassengers()) {
            return redirect()
                ->route('passenger.create')
                ->with(
                    'error',
                    'Vui lòng nhập đầy đủ thông tin hành khách trước.'
                );
        }

        $carryOn = BaggagePackage::where(
            'type',
            'carry_on'
        )
            ->where('status', 1)
            ->first();

        $checkedPackages = BaggagePackage::where(
            'type',
            'checked'
        )
            ->where('status', 1)
            ->orderBy('weight')
            ->get();

        $tripType = session(
            'flight_search.trip_type',
            'one_way'
        );

        $passengerCount = $this->passengerCount();

        $passengers = session(
            'booking.passengers',
            []
        );

        if (!is_array($passengers)) {
            $passengers = [];
        }

        if (
            $passengerCount === 1
            && empty($passengers)
        ) {
            $passengers = [
                session('booking.passenger', [])
            ];
        }

        /*
         * Dữ liệu hành lý nhiều người trước đó.
         */
        $passengerBaggage = session(
            'baggage.passengers',
            []
        );

        if (!is_array($passengerBaggage)) {
            $passengerBaggage = [];
        }

        /*
         * Dữ liệu hành lý một người theo luồng cũ.
         */
        $singleBaggage = session('baggage', []);

        $outboundBaggage = session(
            'baggage.outbound',
            []
        );

        $returnBaggage = session(
            'baggage.return',
            []
        );

        return view(
            'user.chon-hanh-ly',
            compact(
                'carryOn',
                'checkedPackages',
                'tripType',
                'booking',
                'passengerCount',
                'passengers',
                'passengerBaggage',
                'singleBaggage',
                'outboundBaggage',
                'returnBaggage'
            )
        );
    }

    /**
     * Lưu lựa chọn hành lý.
     */
    public function store(Request $request)
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()
                ->route('flights.search.form')
                ->with(
                    'error',
                    'Vui lòng chọn chuyến bay trước.'
                );
        }

        if (!$this->hasPassengers()) {
            return redirect()
                ->route('passenger.create')
                ->with(
                    'error',
                    'Vui lòng nhập đầy đủ thông tin hành khách trước.'
                );
        }

        $tripType = session(
            'flight_search.trip_type',
            'one_way'
        );

        $passengerCount = $this->passengerCount();

        /*
        |--------------------------------------------------------------------------
        | TRƯỜNG HỢP CHỈ ĐẶT MỘT VÉ
        |--------------------------------------------------------------------------
        |
        | Giữ nguyên tên input và session của hệ thống cũ.
        |
        */

        if ($passengerCount === 1) {

            if ($tripType === 'round_trip') {

                $validated = $request->validate(
                    [
                        'outbound_baggage_package_id' => [
                            'nullable',
                            'integer',
                            $this->checkedPackageRule(),
                        ],

                        'return_baggage_package_id' => [
                            'nullable',
                            'integer',
                            $this->checkedPackageRule(),
                        ],
                    ],
                    [
                        'outbound_baggage_package_id.exists' =>
                            'Gói hành lý chiều đi không hợp lệ.',

                        'return_baggage_package_id.exists' =>
                            'Gói hành lý chiều về không hợp lệ.',
                    ]
                );

                $outboundPackage =
                    $this->findCheckedPackage(
                        $validated[
                            'outbound_baggage_package_id'
                        ] ?? null
                    );

                $returnPackage =
                    $this->findCheckedPackage(
                        $validated[
                            'return_baggage_package_id'
                        ] ?? null
                    );

                session([
                    'baggage.outbound' =>
                        $this->packageData($outboundPackage),

                    'baggage.return' =>
                        $this->packageData($returnPackage),
                ]);

            } else {

                $validated = $request->validate(
                    [
                        'baggage_package_id' => [
                            'nullable',
                            'integer',
                            $this->checkedPackageRule(),
                        ],
                    ],
                    [
                        'baggage_package_id.exists' =>
                            'Gói hành lý ký gửi không hợp lệ.',
                    ]
                );

                $package = $this->findCheckedPackage(
                    $validated['baggage_package_id'] ?? null
                );

                session([
                    'baggage' => $this->packageData($package),
                ]);
            }

            /*
             * Không sử dụng dữ liệu nhóm từ lần đặt trước.
             */
            session()->forget('baggage.passengers');

            return redirect()->route('face.create');
        }

        /*
        |--------------------------------------------------------------------------
        | TRƯỜNG HỢP ĐẶT 2–5 VÉ
        |--------------------------------------------------------------------------
        |
        | Mỗi hành khách có gói hành lý của riêng mình.
        | Nếu khứ hồi thì có gói chiều đi và chiều về.
        |
        */

        $rules = [
            'baggage' => [
                'required',
                'array',
                'size:' . $passengerCount,
            ],
        ];

        if ($tripType === 'round_trip') {
            $rules['baggage.*.outbound_package_id'] = [
                'nullable',
                'integer',
                $this->checkedPackageRule(),
            ];

            $rules['baggage.*.return_package_id'] = [
                'nullable',
                'integer',
                $this->checkedPackageRule(),
            ];
        } else {
            $rules['baggage.*.package_id'] = [
                'nullable',
                'integer',
                $this->checkedPackageRule(),
            ];
        }

        $validated = $request->validate(
            $rules,
            [
                'baggage.required' =>
                    'Thiếu thông tin hành lý của hành khách.',

                'baggage.array' =>
                    'Dữ liệu hành lý không hợp lệ.',

                'baggage.size' =>
                    "Cần chọn hành lý cho đủ {$passengerCount} hành khách.",

                'baggage.*.package_id.exists' =>
                    'Có gói hành lý không hợp lệ.',

                'baggage.*.outbound_package_id.exists' =>
                    'Có gói hành lý chiều đi không hợp lệ.',

                'baggage.*.return_package_id.exists' =>
                    'Có gói hành lý chiều về không hợp lệ.',
            ]
        );

        $baggageInput = $validated['baggage'];

        $result = [];
        $totalPrice = 0;

        /*
         * Dùng chỉ số 0, 1, 2, 3, 4 để ghép
         * hành lý với hành khách tương ứng.
         */
        for ($i = 0; $i < $passengerCount; $i++) {

            $item = $baggageInput[$i] ?? [];

            if ($tripType === 'round_trip') {

                $outboundPackage =
                    $this->findCheckedPackage(
                        $item['outbound_package_id'] ?? null
                    );

                $returnPackage =
                    $this->findCheckedPackage(
                        $item['return_package_id'] ?? null
                    );

                $outboundData =
                    $this->packageData($outboundPackage);

                $returnData =
                    $this->packageData($returnPackage);

                $result[$i] = [
                    'outbound' => $outboundData,
                    'return' => $returnData,
                ];

                $totalPrice +=
                    (float) $outboundData['price']
                    + (float) $returnData['price'];

            } else {

                $package = $this->findCheckedPackage(
                    $item['package_id'] ?? null
                );

                $packageData =
                    $this->packageData($package);

                $result[$i] = [
                    'one_way' => $packageData,
                ];

                $totalPrice +=
                    (float) $packageData['price'];
            }
        }

        /*
         * Lưu danh sách hành lý từng người.
         */
        session([
            'baggage.passengers' => $result,

            'baggage.total_price' => $totalPrice,
        ]);

        return redirect()->route('face.create');
    }
}
