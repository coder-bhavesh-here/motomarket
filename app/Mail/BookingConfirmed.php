<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected $booking,) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $tour = Tour::find($this->booking->tour_id);
        return new Envelope(
            from: new Address('hello@worldonmoto.com', 'World On Moto'),
            replyTo: [
                new Address('hello@worldonmoto.com', 'World On Moto'),
            ],
            subject: 'Booking Confirmed for : ' . $tour->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.booking.confirmed',
            with: [
                'booking' => $this->booking,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
