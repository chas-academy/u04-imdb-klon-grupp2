<?php

if (!function_exists('format_date')) {
    function format_date($date, $format = 'd F') {
        return (new DateTime($date))->format($format);
    }
}