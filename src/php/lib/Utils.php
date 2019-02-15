<?php
/**
 * Created by PhpStorm.
 * User: nicholasagner
 * Date: 2019-02-14
 * Time: 14:41
 */
function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
