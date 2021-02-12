<?php

namespace App;

use Carbon\Carbon;

class Calendar
{
    // Googleの提供する日本の祝日カレンダー
    private $calendarId = 'japanese__ja@holiday.calendar.google.com';
    private $googleMapApiKey;

    public function __construct(string $googleMapApiKey)
    {
        $this->googleMapApiKey = $googleMapApiKey;
    }

    /**
     * 指定した期間の祝日を取得する
     *
     * @param Carbon $start
     * @param Carbon $end
     * @return array
     */
    public function holidays(Carbon $start, Carbon $end)
    {
        $calendar_id = urlencode($this->calendarId);

        $url = "https://www.googleapis.com/calendar/v3/calendars/" . $calendar_id . "/events?";
        $query = [
            'key' => $this->googleMapApiKey,
            'timeMin' => $start->format('Y-m-d\TH:i:s\Z'),
            'timeMax' => $end->format('Y-m-d\TH:i:s\Z'),
            'maxResults' => 50,
            'orderBy' => 'startTime',
            'singleEvents' => 'true'
        ];

        $holidays = [];
        if ($data = file_get_contents($url . http_build_query($query), true)) {
            $data = json_decode($data);
            foreach ($data->items as $row) {
                $holiday = Carbon::parse($row->start->date);
                $holidays[$holiday->format('Y-m-d')] = [
                    'name' => $row->summary,
                    'date' => $holiday,
                ];
            }
        }

        return $holidays;
    }

    /**
     * 指定した日付が祝日であれば何の日であるか返す
     *
     * @param Carbon $target
     * @return string|null
     */
    public function checkHoliday(Carbon $target)
    {
        $start = Carbon::parse($target->format("Y-m-d"));
        $end = $start->copy()->addDay();
        $holidays = $this->holidays($start, $end);
        if (count($holidays)) {
            return array_shift($holidays)['name'];
        }
        return null;
    }
}
