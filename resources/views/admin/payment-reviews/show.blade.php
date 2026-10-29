@extends('admin.payment-reviews.layout')

@section('content')
<h1>Đối soát #{{ $review->id }} — {{ $review->booking_code }}</h1>

<p>
    <a href="{{ route('admin.payment-reviews.index') }}">
        ← Danh sách yêu cầu
    </a>
</p>

<div class="grid">
    <section class="card">
        <h2>Ảnh bill khách gửi</h2>

        <a
            href="{{ route('payment-reviews.image', $review->id) }}"
            target="_blank"
            rel="noopener"
        >
            <img
                class="bill"
                src="{{ route('payment-reviews.image', $review->id) }}"
                alt="Bill chuyển khoản khách gửi đối soát"
            >
        </a>

        <p class="muted">Bấm ảnh để xem kích thước đầy đủ.</p>
    </section>

    <section class="card">
        <h2>Thông tin đối soát</h2>

        <p>
            Khách hàng:
            <strong>{{ $review->customer_name ?? '---' }}</strong>
        </p>

        <p>
            Số tiền lúc gửi yêu cầu:
            <strong>{{ number_format($review->expected_amount, 0, ',', '.') }}đ</strong>
        </p>

        <p>
            Nội dung yêu cầu của đơn:
            <strong>VJ {{ $review->booking_code }}</strong>
        </p>

        <p>
            Nội dung OCR ghi nhận:
            <strong>{{ $review->receipt_content ?? 'Chưa đọc được / khách chọn ảnh mới' }}</strong>
        </p>

        <p>
            Mã giao dịch OCR ghi nhận:
            <strong>{{ $review->transaction_code ?? 'Chưa đọc được / khách chọn ảnh mới' }}</strong>
        </p>

        <p>Lời nhắn: {{ $review->message }}</p>

        <p>
            Trạng thái yêu cầu:
            <span class="badge {{ $review->status }}">
                {{ ['pending'=>'Chờ xử lý','approved'=>'Đã duyệt','rejected'=>'Đã từ chối'][$review->status] ?? $review->status }}
            </span>
        </p>

        @if($booking)
            <p>
                Đơn hiện tại:
                {{ $booking->booking_status }} / {{ $booking->payment_status }}
            </p>

            <a
                class="button secondary"
                href="{{ route('admin.bookings.show', $booking->id) }}"
            >Xem đơn vé</a>

            @if(
                $booking->booking_status !== 'pending'
                || $booking->payment_status !== 'unpaid'
                || !$booking->expires_at
                || $booking->expires_at->isPast()
            )
                <div class="notice" style="margin-top:15px">
                    Đơn không còn đủ điều kiện giữ ghế để duyệt kích hoạt vé.
                    Nếu khách đã chuyển tiền, cần xử lý ghế hoặc hoàn tiền riêng.
                </div>
            @endif
        @endif

        @if($review->reviewed_at)
            <div class="notice" style="margin-top:15px">
                <strong>Kết quả xử lý</strong>

                <p>{{ $review->reviewer_note }}</p>

                <p>
                    Người xử lý: {{ $review->reviewer_name ?? '---' }}
                    <br>
                    {{ \Carbon\Carbon::parse($review->reviewed_at, config('app.timezone'))->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                </p>

                @if($review->approved_transaction_code)
                    <p>
                        Mã giao dịch đã duyệt:
                        {{ $review->approved_transaction_code }}
                        <br>
                        Thực nhận:
                        {{ number_format($review->received_amount, 0, ',', '.') }}đ
                    </p>
                @endif
            </div>
        @endif
    </section>
</div>

@if($booking)
    <section class="card">
        <h2>Vé trong đơn</h2>

        <div class="scroll">
            <table>
                <thead>
                    <tr>
                        <th>Mã vé</th>
                        <th>Hành khách</th>
                        <th>Chuyến bay</th>
                        <th>Hành trình</th>
                        <th>Ngày bay</th>
                        <th>Ghế</th>
                        <th>Trạng thái vé</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($booking->tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_code }}</td>
                            <td>{{ $ticket->passenger_name }}</td>
                            <td>{{ $ticket->flight?->flight_code ?? '---' }}</td>

                            <td>
                                {{ $ticket->flight?->departureAirport?->city ?? '---' }}
                                →
                                {{ $ticket->flight?->arrivalAirport?->city ?? '---' }}
                            </td>

                            <td>
                                {{ $ticket->flight?->flight_date?->format('d/m/Y') ?? '---' }}
                            </td>

                            <td>{{ $ticket->flightSeat?->seat_number ?? '---' }}</td>
                            <td>{{ $ticket->ticket_status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endif

@if($review->status === 'pending')
    <section class="card">
        <h2>Xử lý yêu cầu</h2>

        <p class="notice">
            Chỉ duyệt sau khi đã kiểm tra giao dịch nhận tiền.
            Bill sai nội dung không được tự xem là bằng chứng
            tiền đã vào tài khoản.
        </p>

        @if(
            $booking
            && $booking->booking_status === 'pending'
            && $booking->payment_status === 'unpaid'
            && $booking->expires_at
            && !$booking->expires_at->isPast()
        )
            <form
                method="POST"
                action="{{ route('admin.payment-reviews.decide', $review->id) }}"
            >
                @csrf
                <input type="hidden" name="decision" value="approve">

                <label for="transaction_code">Mã giao dịch đã đối soát</label>
                <input
                    id="transaction_code"
                    name="transaction_code"
                    value="{{ old('transaction_code', $review->transaction_code) }}"
                    required
                    minlength="6"
                    maxlength="80"
                    pattern="[A-Za-z0-9-]{6,80}"
                >

                <label for="received_amount">Số tiền thực nhận (đồng)</label>
                <input
                    id="received_amount"
                    name="received_amount"
                    type="number"
                    min="1"
                    step="1"
                    value="{{ old('received_amount') }}"
                    required
                >

                <label for="approve_note">Ghi chú duyệt</label>
                <textarea
                    id="approve_note"
                    name="note"
                    required
                    minlength="3"
                    maxlength="1000"
                >{{ old('decision') === 'approve' ? old('note') : '' }}</textarea>

                <label class="checkbox">
                    <input
                        type="checkbox"
                        name="bank_confirmed"
                        value="1"
                        required
                    >
                    Tôi đã kiểm tra giao dịch nhận tiền, mã giao dịch
                    và số tiền thuộc đơn này.
                </label>

                <button type="submit">
                    Duyệt thanh toán và kích hoạt vé
                </button>
            </form>
        @endif

        <form
            method="POST"
            action="{{ route('admin.payment-reviews.decide', $review->id) }}"
            class="decision"
        >
            @csrf
            <input type="hidden" name="decision" value="reject">

            <label for="reject_note">
                Lý do từ chối / hướng xử lý tiếp theo
            </label>

            <textarea
                id="reject_note"
                name="note"
                required
                minlength="3"
                maxlength="1000"
                placeholder="Ghi rõ lý do và hướng xử lý cho khách."
            >{{ old('decision') === 'reject' ? old('note') : '' }}</textarea>

            <button type="submit" class="danger">
                Từ chối yêu cầu
            </button>
        </form>
    </section>
@endif
@endsection
