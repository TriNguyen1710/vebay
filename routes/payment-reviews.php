<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentReviewController;

Route::middleware('auth')->group(function () {
    Route::get(
        '/doi-soat-thanh-toan/{booking}',
        [PaymentReviewController::class, 'customer']
    )->name('payment-reviews.customer');

    Route::post(
        '/doi-soat-thanh-toan/{booking}',
        [PaymentReviewController::class, 'store']
    )->middleware('throttle:10,1')->name('payment-reviews.store');

    Route::get(
        '/doi-soat-thanh-toan/anh/{reviewId}',
        [PaymentReviewController::class, 'image']
    )->whereNumber('reviewId')->name('payment-reviews.image');

    Route::middleware('admin')
        ->prefix('admin/doi-soat-thanh-toan')
        ->group(function () {
            Route::get(
                '/',
                [PaymentReviewController::class, 'index']
            )->name('admin.payment-reviews.index');

            Route::get(
                '/{reviewId}',
                [PaymentReviewController::class, 'show']
            )->whereNumber('reviewId')->name('admin.payment-reviews.show');

            Route::post(
                '/{reviewId}',
                [PaymentReviewController::class, 'decide']
            )->whereNumber('reviewId')->name('admin.payment-reviews.decide');
        });
});
