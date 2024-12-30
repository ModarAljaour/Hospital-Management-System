<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmetNotification extends Notification
{
    use Queueable;

    public $appointment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Appointment  $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("New Appointment")
            ->greeting("Hi " . ($this->appointment->name) . ", how are you?")
            ->line("A new appointment has been created (# " . ($this->appointment->name ?? 'No appointment name') . ")")
            ->line("Doctor (# " . ($this->appointment->doctor->name) . ") is waiting for you in # " . ($this->appointment->section->name))
            ->line("Your appointment date is # " . ($this->appointment->date))
            ->action('View Appointment', url('/'))
            ->line('Thank you, and we wish you a speedy recovery!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
