<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $employee;
    public string $plainPassword;

    public function __construct(User $employee, string $plainPassword)
    {
        $this->employee = $employee;
        $this->plainPassword = $plainPassword;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thông tin tài khoản nhân viên Vietjet'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.employee-account'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}