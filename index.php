<?php

require_once __DIR__ . '/vendor/autoload.php';

$slack = new App\Slack($_ENV['OAUTH_ACCESS_TOKEN']);
$slack->alert('#general', 'botとして投稿');
