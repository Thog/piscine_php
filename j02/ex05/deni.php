#!/usr/bin/php
<?php

// Incorrect args or file not found
if ($argc != 3 || !file_exists($argv[1]))
    exit();

// Open the file
$buffer = fopen($argv[1], 'r');
while ($buffer && !feof($buffer))
    $array[] = explode(";", fgets($buffer));
fclose($buffer);

// copy the first array line
$head = $array[0];

// Remove head of the array
unset($array[0]);

// Trim all value of head to remove unwanted chars
foreach ($head as $k => $v)
    $head[$k] = trim($v);

// Search for the key in the first line of the csv
$index = array_search($argv[2], $head);

// Index not found in csv, stop now
if ($index === false)
    exit();

foreach ($head as $key => $value)
{
    $tmp = array();

    // Scan the data to match with the head key, and save the matching values
    foreach ($array as $v)
        if (isset($v[$index]))
            $tmp[trim($v[$index])] = trim($v[$key]);
    $value = $tmp;
}

// Commander part
$stdin = fopen("php://stdin", "r");
while ($stdin && !feof($stdin))
{
    echo "Entrez votre commande: ";
    $order = fgets($stdin);
    if ($order)
        eval($order);
}

// Clean up, and end
fclose($stdin);
echo "\n";
?>