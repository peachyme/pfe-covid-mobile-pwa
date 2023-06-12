<?php

namespace App\Notifications;

use DateTime;
use Carbon\Carbon;
use App\Models\Reunion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProtocoleNotification extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $reunions = Reunion::all();
        $today = Carbon::now()->format('d-m-Y');

        foreach ($reunions as $reunion) {
            $date = new DateTime($reunion->debut_reunion);
            if ($date->format('d-m-Y') == $today) {
                if ($reunion->protocole) {
                    return [
                        'user_id' => $this->user['id'],
                        'pdf' => $reunion->protocole,
                    ];
                }
            }
        }
    }
}
