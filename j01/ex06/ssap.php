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
    $words = array();
    $i = 1;
    while ($i < $argc)
    {
        $arg_words = to_array($argv[$i]);
        $words = array_merge($words, $arg_words);
        $i++;
    }

    asort($words);

    foreach ($words as $elem)
    {
        echo $elem ."\n";
    }
}

?>