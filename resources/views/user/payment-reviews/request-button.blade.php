@if(
    auth()->check()
    && auth()->user()->role === 'user'
    && (int) $booking->user_id === (int) auth()->id()
    && $booking->payment_status !== 'paid'
    && (int) data_get(session('receipt_check'), 'booking_id', 0) === (int) $booking->id
)
    <section style="margin:18px 0;padding:20px;border:1px solid #dbe4ed;border-radius:10px;background:#fff">
        <strong style="color:#003b70">
            Bạn đã chuyển tiền nhưng hóa đơn chưa được duyệt?
        </strong>

        <p style="font-size:13px;line-height:1.7;margin:10px 0">
            Gửi yêu cầu để admin đối soát giao dịch với đơn đặt vé.
            Bạn không cần chuyển tiền lại.
        </p>

        <a
            href="{{ route('payment-reviews.customer', $booking->id) }}"
            style="display:inline-block;padding:12px 18px;border-radius:6px;background:#003b70;color:white;font-size:13px;font-weight:bold"
        >
            Đã chuyển tiền? Gửi yêu cầu đối soát
        </a>
    </section>
@endif
