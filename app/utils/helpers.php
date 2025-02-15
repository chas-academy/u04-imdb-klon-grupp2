<?php

function formatDate($date)
{
    $dateTime = new DateTime($date);
    $currentYear = (new DateTime)->format('Y');
    $dateYear = $dateTime->format('Y');

    if ($dateYear === $currentYear) {
        return $dateTime->format('d F');
    } else {
        return $dateTime->format('d F Y');
    }
}

function validateBreakpoint(string $breakpoint)
{
    $validBreakpoints = ['base', 'sm', 'md', 'lg'];
    if (! in_array($breakpoint, $validBreakpoints)) {
        throw new Exception("$breakpoint is not a valid breakpoint");
    }
}

function generateSectionGridVariable(string $breakpoint, int $number)
{
    validateBreakpoint($breakpoint);

    return '--section-grid-cols-'.$breakpoint.': repeat('.$number.', minmax(0, 1fr))';
}

function getFileUrl($path, $file)
{
    return filter_var($file, FILTER_VALIDATE_URL) ? $file : url($path.'/'.$file);
}
