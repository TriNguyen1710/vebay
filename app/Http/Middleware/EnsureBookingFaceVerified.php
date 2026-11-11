<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBookingFaceVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        // Thay thông tin hay giấy tờ:
        // mọi kết quả đối chiếu trước đây đều hết hiệu lực.
        if ($request->routeIs('passenger.store')) {
            $request->session()->forget([
                'booking.face_status',
                'booking.face_verification_hash',
                'booking.face_image',
                'booking.face_statuses',
                'booking.face_verification_hashes',
                'booking.face_images',
                'booking.is_demo',
            ]);
        }

        if (!$request->routeIs('booking.confirm', 'booking.store')) {
            return $next($request);
        }

        $count = max(
            1,
            min(
                5,
                (int) $request->session()->get(
                    'flight_search.passenger_count',
                    1
                )
            )
        );

        $passengers = $request->session()->get(
            'booking.passengers',
            []
        );

        if (!is_array($passengers)) {
            $passengers = [];
        }

        if (!$passengers && $count === 1) {
            $legacy = $request->session()->get(
                'booking.passenger'
            );

            if (is_array($legacy)) {
                $passengers = [$legacy];
            }
        }

        if (count($passengers) !== $count) {
            return redirect()
                ->route('passenger.create')
                ->with(
                    'error',
                    'Vui lòng nhập đầy đủ thông tin của tất cả hành khách.'
                );
        }

        $statuses = $request->session()->get(
            'booking.face_statuses',
            []
        );

        $hashes = $request->session()->get(
            'booking.face_verification_hashes',
            []
        );

        $images = $request->session()->get(
            'booking.face_images',
            []
        );

        if (!is_array($statuses)) {
            $statuses = [];
        }

        if (!is_array($hashes)) {
            $hashes = [];
        }

        if (!is_array($images)) {
            $images = [];
        }

        // Tương thích phiên bản một vé trước đây.
        if ($count === 1 && !$statuses) {
            $statuses[0] = $request->session()->get(
                'booking.face_status'
            );

            $hashes[0] = $request->session()->get(
                'booking.face_verification_hash'
            );

            $images[0] = $request->session()->get(
                'booking.face_image'
            );
        }

        $hasDemo = false;

        foreach ($passengers as $index => $person) {
            if (
                !is_array($person)
                || empty($person['cccd_image'])
            ) {
                return redirect()
                    ->route('passenger.create')
                    ->with(
                        'error',
                        'Vui lòng tải ảnh CCCD cho từng hành khách.'
                    );
            }

            $status = $statuses[$index] ?? null;
            $savedHash = $hashes[$index] ?? null;
            $faceImage = $images[$index] ?? null;

            $currentHash = is_string($faceImage)
                ? self::fingerprint($person, $faceImage)
                : null;

            if (
                !in_array($status, ['verified', 'demo'], true)
                || !is_string($savedHash)
                || !$currentHash
                || !hash_equals($savedHash, $currentHash)
            ) {
                return redirect()
                    ->route('face.create')
                    ->with(
                        'error',
                        'Hành khách ' . ($index + 1)
                        . ' chưa đối chiếu khuôn mặt thành công '
                        . 'hoặc dữ liệu đã thay đổi.'
                    );
            }

            if ($status === 'demo') {
                $hasDemo = true;
            }
        }

        if (
            $hasDemo
            && !app()->environment('local')
        ) {
            return redirect()
                ->route('face.create')
                ->with(
                    'error',
                    'Dữ liệu DEMO không được chấp nhận để đặt vé thật.'
                );
        }

        $request->session()->put(
            'booking.is_demo',
            $hasDemo
        );

        // Ở local, giấy tờ dùng chung được đánh dấu DEMO.
        // Khi triển khai, BookingController phải chặn
        // thanh toán và phát hành vé thật từ dữ liệu DEMO.
        return $next($request);
    }

    public static function fingerprint(
        array $passenger,
        string $faceImage
    ): ?string {
        $cccdImage = $passenger['cccd_image'] ?? null;

        if (!is_string($cccdImage)) {
            return null;
        }

        $cccdPath = self::imagePath(
            $cccdImage,
            'uploads/cccd'
        );

        $facePath = self::imagePath(
            $faceImage,
            'uploads/faces'
        );

        if (!$cccdPath || !$facePath) {
            return null;
        }

        $cccdHash = hash_file('sha256', $cccdPath);
        $faceHash = hash_file('sha256', $facePath);

        if (
            $cccdHash === false
            || $faceHash === false
        ) {
            return null;
        }

        return hash(
            'sha256',
            serialize($passenger)
            . '|'
            . $faceImage
            . '|'
            . $cccdHash
            . '|'
            . $faceHash
        );
    }

    public static function imagePath(
        string $relativePath,
        string $directory
    ): ?string {
        $base = realpath(
            public_path($directory)
        );

        $path = realpath(
            public_path($relativePath)
        );

        if (
            $base === false
            || $path === false
            || !is_file($path)
            || !str_starts_with(
                $path,
                $base . DIRECTORY_SEPARATOR
            )
        ) {
            return null;
        }

        return $path;
    }
}
