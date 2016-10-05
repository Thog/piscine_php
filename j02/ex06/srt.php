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

// save all file lines in a row array
$buffer = fopen($argv[1], 'r');
while ($buffer && !feof($buffer))
    $array[] = fgets($buffer);


// intialize vars
$index = 0;
$time = array();
$data = array();
$key_id = 0;

foreach($array as $key => $value)
{
    // Index number
    if ($index == 0)
    {
        $key_id = $value;
        var_dump($array);
    }
    // Time string
    else if (is_time($value))
    {
        $time[intval($key_id)] = $value;
        $index = 1;
    }
    // Additional string
    else if ($index == 2)
        $data[$time[intval($key_id)]] = $value;
    // End of a section, reset index
    else if ($index == 3)
        $index = -1;
    $index++;
}

// Sort all entries by the date str
ksort($data);
sort($time);

// Destroy $array, we don't need it anymore
unset($array);

// Get the last element of the $time array
$last = end(array_unique($time));

// Print the sorted response entries
foreach($time as $key => $time)
{
    echo $key . "\n" . $time  . $data[$time];
    if ($time !== $last)
        echo "\n";
}
?>