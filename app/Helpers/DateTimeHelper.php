<?php

namespace App\Helpers;

use DateTime;

/**
 * Description of DateTimeHelper
 *
 * @author H1
 */
class DateTimeHelper
{
    /**
     * It's a good practice if we get the date time everywhere,
     * because we can change the time zone at any time if needed.
     *
     * @return DateTime
     */
    public static function getDateTimeObj(): DateTime
    {
        return new DateTime();
    }
}
