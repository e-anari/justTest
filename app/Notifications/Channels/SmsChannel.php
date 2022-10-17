<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SmsChannel
{
    public function send($notify, Notification $notification)
    {
        try {

            $message = $notification->toSMS($notification)['content'];
            $receptor = $notification->toSMS($notification)['phone_number'];

            $response = Http::withHeaders([
                'apikey' => env('GHASEDAK_SMS_API_KEY'),
            ])->post('http://api.ghasedaksms.com/v2/sms/send/simple', [
                'message' => $message,
                'sender' => env('GHASEDAK_SMS_SENDER_NUMBER_5'),
                'receptor' => $receptor,
            ]);

            $result = \json_decode($response);
        } catch (\Throwable$th) {
            throw $th;
        }

    }
}
