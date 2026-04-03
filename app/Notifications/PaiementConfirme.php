<?php

namespace App\Notifications;

use App\Models\Paiement;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaiementConfirme extends Notification
{
    public function __construct(private Paiement $paiement)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Confirmation de paiement - ' . $this->paiement->reference)
            ->greeting('Bonjour ' . $notifiable->prenom . ',')
            ->line('Votre paiement a ete enregistre avec succes.')
            ->line('Montant : ' . number_format($this->paiement->montant, 0, ',', ' ') . ' FCFA')
            ->line('Reference : ' . $this->paiement->reference)
            ->action('Afficher le recu', route('comptable.paiements.recu', $this->paiement))
            ->salutation('Cordialement, la Direction');
    }
}
