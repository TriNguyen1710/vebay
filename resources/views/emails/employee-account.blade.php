<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <title>Tài khoản nhân viên Vietjet</title>
</head>

<body style="
    margin: 0;
    padding: 0;
    background: #f3f6f9;
    font-family: Arial, Helvetica, sans-serif;
    color: #22313f;
">

<table
    width="100%"
    cellpadding="0"
    cellspacing="0"
    border="0"
    style="background: #f3f6f9; padding: 35px 15px;"
>
    <tr>
        <td align="center">

            <table
                width="600"
                cellpadding="0"
                cellspacing="0"
                border="0"
                style="
                    max-width: 600px;
                    width: 100%;
                    background: #ffffff;
                    border-radius: 10px;
                    overflow: hidden;
                "
            >

                <tr>
                    <td
                        style="
                            background: #00294f;
                            padding: 25px 30px;
                            text-align: center;
                        "
                    >
                        <div
                            style="
                                color: #ffffff;
                                font-size: 30px;
                                font-weight: bold;
                            "
                        >
                            Viet<span style="color: #f4b400;">jet</span>
                        </div>

                        <div
                            style="
                                margin-top: 7px;
                                color: #cad9e4;
                                font-size: 13px;
                            "
                        >
                            Hệ thống quản lý đặt vé máy bay
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 32px 35px;">

                        <h2
                            style="
                                margin: 0 0 18px;
                                color: #003b70;
                                font-size: 21px;
                            "
                        >
                            Tài khoản nhân viên
                        </h2>

                        <p
                            style="
                                margin: 0 0 14px;
                                line-height: 1.7;
                                font-size: 14px;
                            "
                        >
                            Xin chào
                            <strong>{{ $employee->name }}</strong>,
                        </p>

                        <p
                            style="
                                margin: 0 0 20px;
                                line-height: 1.7;
                                font-size: 14px;
                            "
                        >
                            Admin đã tạo tài khoản nhân viên cho bạn
                            trên hệ thống Vietjet.
                        </p>

                        <table
                            width="100%"
                            cellpadding="0"
                            cellspacing="0"
                            border="0"
                            style="
                                background: #edf5fb;
                                border: 1px solid #d5e3ed;
                                border-radius: 8px;
                            "
                        >

                            <tr>
                                <td
                                    style="
                                        padding: 18px 20px 8px;
                                        color: #74818c;
                                        font-size: 12px;
                                    "
                                >
                                    EMAIL ĐĂNG NHẬP
                                </td>
                            </tr>

                            <tr>
                                <td
                                    style="
                                        padding: 0 20px 17px;
                                        color: #003b70;
                                        font-size: 16px;
                                        font-weight: bold;
                                    "
                                >
                                    {{ $employee->email }}
                                </td>
                            </tr>

                            <tr>
                                <td
                                    style="
                                        padding: 0 20px 8px;
                                        color: #74818c;
                                        font-size: 12px;
                                    "
                                >
                                    MẬT KHẨU
                                </td>
                            </tr>

                            <tr>
                                <td
                                    style="
                                        padding: 0 20px 18px;
                                        color: #003b70;
                                        font-size: 16px;
                                        font-weight: bold;
                                    "
                                >
                                    {{ $plainPassword }}
                                </td>
                            </tr>

                        </table>

                        <p
                            style="
                                margin: 22px 0 0;
                                line-height: 1.7;
                                color: #53626e;
                                font-size: 13px;
                            "
                        >
                            Vui lòng sử dụng Email và mật khẩu trên
                            để đăng nhập vào hệ thống nhân viên.
                        </p>

                        <p
                            style="
                                margin: 20px 0 15px;
                                line-height: 1.7;
                                color: #53626e;
                                font-size: 13px;
                            "
                        >
                            Sau khi đã nhận được thông tin tài khoản,
                            vui lòng bấm nút bên dưới để xác nhận với Admin.
                        </p>

                        <table
                            width="100%"
                            cellpadding="0"
                            cellspacing="0"
                            border="0"
                        >
                            <tr>
                                <td align="center" style="padding: 5px 0 10px;">

                                    <a
                                        href="{{ $confirmationUrl }}"
                                        style="
                                            display: inline-block;
                                            padding: 14px 24px;
                                            background: #003b70;
                                            color: #ffffff;
                                            text-decoration: none;
                                            border-radius: 6px;
                                            font-size: 13px;
                                            font-weight: bold;
                                        "
                                    >
                                        XÁC NHẬN ĐÃ NHẬN TÀI KHOẢN
                                    </a>

                                </td>
                            </tr>
                        </table>

                        <p
                            style="
                                margin: 12px 0 0;
                                line-height: 1.7;
                                color: #74818c;
                                font-size: 11px;
                                text-align: center;
                            "
                        >
                            Liên kết xác nhận có hiệu lực trong 7 ngày.
                        </p>

                    </td>
                </tr>

                <tr>
                    <td
                        style="
                            padding: 18px 30px;
                            background: #f7f9fb;
                            border-top: 1px solid #dfe6eb;
                            text-align: center;
                            color: #74818c;
                            font-size: 11px;
                        "
                    >
                        Vietjet Administration - Hệ thống đặt vé máy bay
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>

</html>