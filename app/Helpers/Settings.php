<?php

namespace App\Helpers;

use http\Exception\InvalidArgumentException;

class Settings
{
    public static function getStudyDays(): array
    {
        return [
            1 => __('Monday'),
            2 => __('Tuesday'),
            3 => __('Wednesday'),
            4 => __('Thursday'),
            5 => __('Friday'),
        ];
    }

    public static function getDayNameByIndex(int $index)
    {
        return self::getStudyDays()[$index] ?? null;
    }

    public static function getStudyTimes(): array
    {
        return [
            '07:00:00',
            '08:00:00',
            '09:00:00',
            '10:00:00',
            '11:00:00',
            '13:00:00',
            '14:00:00',
            '15:00:00',
            '16:00:00',
        ];
    }

    public static function getSectionCodes(): array
    {

        return [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'F' => 'F',
            'G' => 'G',
            'H' => 'H',
            'I' => 'I',
            'J' => 'J',
            'K' => 'K',
            'L' => 'L',
            'M' => 'M',
            'N' => 'N',
            'O' => 'O',
            'P' => 'P',
            'Q' => 'Q',
            'R' => 'R',
            'S' => 'S',
            'T' => 'T',
            'U' => 'U',
            'V' => 'V',
            'W' => 'W',
            'X' => 'X',
            'Y' => 'Y',
            'Z' => 'Z',
        ];
    }
}
