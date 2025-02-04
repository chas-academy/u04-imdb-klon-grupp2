<?php

if (!function_exists('format_date')) {
    function format_date($date) {
        $dateTime = new DateTime($date);
        $currentYear = (new DateTime())->format('Y');
        $dateYear = $dateTime->format('Y');

        if ($dateYear === $currentYear) {
            return $dateTime->format('d F');
        } else {
            return $dateTime->format('d F Y');
        }
    }
}