<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password;

class SendPasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $token = Password::createToken($notifiable);

        $url = url('/reset-password/'.$token).'?email='.urlencode($notifiable->email);

        return (new MailMessage)
            ->subject('Definir Senha - Sistema Proenergia')
            ->greeting('Olá '.$notifiable->name.'!')
            ->line('Uma conta foi criada para você no Sistema Proenergia.')
            ->line('Clique no botão abaixo para definir sua senha e fazer login no sistema.')
            ->action('Definir Senha', $url)
            ->line('Este link expirará em 60 minutos.')
            ->line('Se você não solicitou esta conta, nenhuma ação é necessária.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
