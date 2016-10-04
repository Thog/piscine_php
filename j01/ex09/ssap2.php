<?php
function is_sort($entry, $next_entry)
{
    $entry = strtolower($entry);
    $next_entry = strtolower($next_entry);
    $order = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $length = strlen($entry) < strlen($next_entry) ? strlen($entry) : strlen($next_entry);
    for ($i = 0; $i < $length; $i++)
    {
        $entry_char = substr($entry, $i, 1);
        $next_entry_char = substr($next_entry, $i, 1);
        $entry_priority = array_search($entry_char, $order);
        $next_entry_priority = array_search($next_entry_char, $order);
        $entry_priority = $entry_priority === false ? ord($entry_char) + 100 : $entry_priority;
        $next_entry_priority = $next_entry_priority === false ? ord($next_entry_char) + 100 : $next_entry_priority;
        if ($next_entry_priority < $entry_priority)
            return false;
        if ($next_entry_priority > $entry_priority)
            return true;
    }
    return strlen($entry) <= strlen($next_entry) ? true : false;
}

function is_not_null($value)
{
    if ($value === "0")
        return true;
    return !($value === null || empty($value));
}

$res = array();

unset($argv[0]);
foreach($argv as $arg)
{
    $tmp = array_filter(explode(" ", $arg), 'is_not_null');
    foreach ($tmp as $v2)
        $res[] = $v2;
}


for ($i = 0; $i < count($res) - 1;)
{
    if (is_sort($res[$i], $res[$i + 1]))
        $i++;
    else
    {
        $temp = $res[$i];
        $res[$i] = $res[$i + 1];
        $res[$i + 1] = $temp;
        $i = 0;
    }
}

foreach ($res as $elem)
    echo $elem . "\n";
?>