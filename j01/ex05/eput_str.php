#!/usr/bin/php
<?php
function to_array($string)
{
    $exploded = explode(' ', $string);
    $filtered = array_filter($exploded);
    return array_slice($filtered, 0);
}

if ($argc == 2)
{
    $array = to_array($argv[1]);
    $res = implode(' ', $array);
    echo $res."\n";
}

?>