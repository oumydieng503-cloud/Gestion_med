<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmee extends Mailable
{
    use Queueable, SerializesModels;

    // On passe la réservation au constructeur
    // pour pouvoir l'utiliser dans le template
    public function __construct(public Reservation $reservation)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Votre rendez-vous est confirmé — MediCare',
        );
    }

    public function content(): Content
    {
        return new Content(
            // On va créer ce template juste après
            view: 'emails.reservation-confirmee',
        );
    }
}