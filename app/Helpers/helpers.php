<?php

use Illuminate\Support\Str;

if (!function_exists('truncate_html')) {
    function truncate_html($html, $limit = 70)
    {
        return Str::limit(strip_tags($html), $limit);
    }
}


