<?php

namespace App;

class Helper
{
    public static function convertDate(string $date): string
    {
        $result = date_parse($date);
        $result = mktime(0,0,0, $result['month'], $result['day'], $result['year']);
        return date('Y-m-d H:i:s', $result);
    }
}