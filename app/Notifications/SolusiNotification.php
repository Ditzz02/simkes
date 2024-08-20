<?php

namespace App\Notifications;

use App\Models\Konsultasi;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SolusiNotification extends Notification
{
    use Queueable;

    protected $konsultasi;

    public function __construct(Konsultasi $konsultasi)
    {
        $this->konsultasi = $konsultasi;
    }

    public function via($notifiable)
    {
        return ['mail']; // Pilih saluran notifikasi, bisa menggunakan 'database' juga
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Solusi untuk permasalahan Anda telah diberikan.')
            ->action('Lihat Konsultasi', route('konsul-show', $this->konsultasi->id))
            ->line('Terima kasih telah menggunakan layanan kami.');
    }

    public function toArray($notifiable)
    {
        return [
            'konsultasi_id' => $this->konsultasi->id,
            'topik' => $this->konsultasi->topik,
        ];
    }
}

