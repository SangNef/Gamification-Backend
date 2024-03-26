<?php

namespace App\Helper;

use Carbon\Carbon;

class TimeHelper
{
    public static function formatTime($timestamp)
    {
        $timeAgo = Carbon::parse($timestamp)->diffForHumans();
        return $timeAgo;
    }
}