<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SlackService
{
    const SLACK_URL = "https://slack.com/api/";
    const TOKEN = "you_token";
    const CHANNEL_ID = "chanel_id";

    public function sendMethod($url, $body) {
        $response = Http::withToken(self::TOKEN)->post(self::SLACK_URL . $url, $body);

        if ($response->failed()) {
            return false;
        }

        return $response->json();
    }

    public function postMessage($text) {
        return $this->sendMethod("chat.postMessage", [
            "channel" => self::CHANNEL_ID,
            "text" => $text
        ]);
    }
}
