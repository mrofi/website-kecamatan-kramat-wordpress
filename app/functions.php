<?php

define('TITLE', 'Jaya Institute Dashboard');

function asset_themes($url)
{
    return asset('themes/adminLTE-2.0.4/'.$url);
}

function isMenuActive($url, $strict = false)
{
    $curUrl = URL::current();
    return ($strict) ? URL::to($url) == $curUrl : strpos($curUrl, URL::to($url)) !== false;
}