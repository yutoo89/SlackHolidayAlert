<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Calendar;
use App\Slack;
use Carbon\Carbon;

// 何日前に通知するか
$notifyBeforeDays = 7;
date_default_timezone_set('Asia/Tokyo');

$calender = new Calendar($_ENV['GOOGLE_MAP_API_KEY']);
$target = Carbon::today()->addDays($notifyBeforeDays);
$holiday = $calender->checkHoliday($target);

if ($holiday) {
    $message = $target->format('Y年m月d日') . "は" . $holiday . "です";
    $slack = new Slack($_ENV['OAUTH_ACCESS_TOKEN']);
    $slack->alert('#general', $message);
}
