#!/usr/bin/php
<?php

/*
* Regex to match a srt date
*/
function is_time($a)
{
    return preg_match("/^[0-9][0-9]:[0-9][0-9]:[0-9][0-9],[0-9][0-9][0-9] --> [0-9][0-9]:[0-9][0-9]:[0-9][0-9],[0-9][0-9][0-9]$/", $a);
}

// Incorrect args or file not found
if ($argc != 2 || !file_exists($argv[1]))
    exit();

$buffer = fopen($argv[1], 'r');
while ($buffer && !feof($buffer))
    $array[] = fgets($buffer);

foreach($array as $key => $value)
    if (is_time($value))
        $time[$key] = $value;

sort($time);
$index = 0;

foreach($array as $value)
{
    if (is_time($value))
    {
        echo $time[$index];
        $index++;
    } else
        echo $value;
}
?>