<?php

namespace App\Notifications;

use App\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SendActiveCodeSMS extends Notification
{
    use Queueable;

    public $code;
    public $phone_number;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code, $phone_number)
    {
        $this->code = $code;
        $this->phone_number = $phone_number;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    public function toSMS($notifiable)
    {
        return [
            'content' => 'Hello test.This is your code : ' . $this->code,
            'phone_number' => $this->phone_number,
        ];

    }
}
