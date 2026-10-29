<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBookingFaceVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        // Thay thông tin hành khách/CCCD thì phải đối chiếu lại.
        if ($request->routeIs('passenger.store')) {
            $request->session()->forget([
                'booking.face_status',
                'booking.face_verification_hash',
            ]);
        }

        if (!$request->routeIs('booking.confirm', 'booking.store')) {
            return $next($request);
        }

        $passenger = $request->session()->get('booking.passenger');
        $faceImage = $request->session()->get('booking.face_image');
        $savedHash = $request->session()->get('booking.face_verification_hash');

        $currentHash = is_array($passenger) && is_string($faceImage)
            ? self::fingerprint($passenger, $faceImage)
            : null;

        if (
            $request->session()->get('booking.face_status') !== 'verified'
            || !is_string($savedHash)
            || !$currentHash
            || !hash_equals($savedHash, $currentHash)
        ) {
            $request->session()->forget([
                'booking.face_status',
                'booking.face_verification_hash',
            ]);

            if (!is_array($passenger) || empty($passenger['cccd_image'])) {
                return redirect()
                    ->route('passenger.create')
                    ->with('error', 'Vui lòng nhập thông tin và tải ảnh mặt trước CCCD.');
            }

            return redirect()
                ->route('face.create')
                ->with('error', 'Vui lòng đối chiếu khuôn mặt với CCCD trước khi đặt vé.');
        }

        return $next($request);
    }

    public static function fingerprint(array $passenger, string $faceImage): ?string
    {
        $cccdImage = $passenger['cccd_image'] ?? null;

        if (!is_string($cccdImage)) {
            return null;
        }

        $cccdPath = self::imagePath($cccdImage, 'uploads/cccd');
        $facePath = self::imagePath($faceImage, 'uploads/faces');

        if (!$cccdPath || !$facePath) {
            return null;
        }

        $cccdHash = hash_file('sha256', $cccdPath);
        $faceHash = hash_file('sha256', $facePath);

        if ($cccdHash === false || $faceHash === false) {
            return null;
        }

        // Ràng buộc kết quả đối chiếu với đúng thông tin và hai ảnh này.
        return hash('sha256', serialize($passenger) . '|' . $faceImage
            . '|' . $cccdHash . '|' . $faceHash);
    }

    public static function imagePath(string $relativePath, string $directory): ?string
    {
        $base = realpath(public_path($directory));
        $path = realpath(public_path($relativePath));

        if (
            $base === false
            || $path === false
            || !is_file($path)
            || !str_starts_with($path, $base . DIRECTORY_SEPARATOR)
        ) {
            return null;
        }

        return $path;
    }
}