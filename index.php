<?php

require_once __DIR__ . '/vendor/autoload.php';

App\Slack::alert(
    $_ENV['URL'],
    'テスト投稿'
);
