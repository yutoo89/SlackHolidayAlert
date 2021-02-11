<?php

namespace App;

class Slack
{
    /**
     * Slackにメッセージを投稿する
     *
     * @param string $url
     * @param string $message
     * @return void
     */
    public static function alert(string $url, string $message)
    {
        $url = $url;
        $POST_DATA = [
            'text' => $message,
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-type: application/json',
        ]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($POST_DATA));

        return curl_exec($curl);
    }
}
