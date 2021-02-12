<?php

namespace App;

class Slack
{
    private $oauthAccessToken;

    public function __construct(string $oauthAccessToken)
    {
        $this->oauthAccessToken = $oauthAccessToken;
    }

    /**
     * Slackにメッセージを投稿する
     *
     * @param string $channel
     * @param string $message
     * @return string|bool
     */
    public function alert(string $channel, string $message)
    {
        $url = 'https://slack.com/api/chat.postMessage';
        $POST_DATA = [
            'channel' => $channel,
            'text' => $message,
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-type: application/json; charset=utf-8',
            'Authorization: Bearer ' . $this->oauthAccessToken,
        ]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($POST_DATA));

        return curl_exec($curl);
    }
}
