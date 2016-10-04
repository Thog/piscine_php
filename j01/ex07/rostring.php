#!/usr/bin/php
<?php

function to_array($string)
{
    $exploded = explode(' ', $string);
    $filtered = array_filter($exploded);
    return array_slice($filtered, 0);
}

if ($argc >= 2)
{
    $splitted_arg = to_array($argv[1]);
    if (count($splitted_arg))
    {
        foreach(array_splice($splitted_arg, 1) as $element)
            echo $element . " ";
        echo $splitted_arg[0] . "\n";
    }
}

?>