<?php

namespace App\Formatters;

use DateTime;
use DateTimeInterface;

class DateTimeFormatter
{
    /**
     * @param DateTime|null $dateTime
     * @param string $format
     * @return string|null
     */
    public static function format(?DateTime $dateTime, string $format = DateTimeInterface::ATOM): ?string
    {
        if (is_null($dateTime)) {
            return null;
        }

        return $dateTime->format($format);
    }
}
