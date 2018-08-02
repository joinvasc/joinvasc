<?php

use Carbon\Carbon;

/**
 *
 * User: Harry
 * Date: 13/01/2017
 */

function format_date($date, $format = 'd/m/Y')
{
    if ($date) {
        return $date->format($format);
    }

    return null;
}

function to_date($value, $format = 'd/m/Y')
{
    if ($value instanceof Carbon || $value instanceof DateTime) {
        return $value;
    }

    if ($value) {
        return Carbon::createFromFormat($format, $value);
    }

    return null;
}