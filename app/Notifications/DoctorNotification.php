<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorNotification extends Notification
{
    use Queueable;

    public $appointment;

    public function __construct(Appointment $appointment)
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("تم حجز موعد جديد")
            ->greeting("مرحباً " . $this->appointment->doctor->name . " , ") // استخدام اسم الطبيب من جدول الأطباء
            ->line("تم حجز موعد جديد.")
            ->line("تفاصيل الحجز : ")
            ->line("اسم المريض: " . ($this->appointment->name)) // استخدام اسم المريض من جدول الحجز
            ->line("التاريخ: " . ($this->appointment->date))
            ->action('عرض الحجز', url('/'))
            ->line('نتمنى لك يومًا سعيدًا!');
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
