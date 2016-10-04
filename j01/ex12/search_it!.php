#!/usr/bin/php
<?php
if ($argc >= 3)
{
    // Copy the target key
    $to_find = $argv[1];

    // Remove arg 0 and 1
    unset($argv[0], $argv[1]);

    // Reverse args
    $argv = array_reverse($argv);
    foreach ($argv as $arg)
    {
        $tmp = explode(":", $arg);
        if ($to_find === $tmp[0] && count($tmp) === 2)
        {
            echo $tmp[1] . "\n";
            break;
        }
    }
}
?>