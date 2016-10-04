#!/usr/bin/php
<?php

function callback($matches)
{
    return $matches[1] . "" . strtoupper($matches[2]) . "" . $matches[3];
}

// If args are incorrect or the file doesn't exist, exit!
if ($argc < 2 || !file_exists($argv[1]))
	exit();

// retrieve the page content
$read = fopen($argv[1], 'r');
$page = "";
while ($read && !feof($read))
    $page .= fgets($read);

$page = preg_replace_callback("/(<a )(.*?)(>)(.*)(<\/a>)/si", function($matches)
{
    // Replace for title attribute
    $matches[0] = preg_replace_callback("/( title=\")(.*?)(\")/mi", 'callback', $matches[0]);
    
    // Replace inside of tag
    $matches[0] = preg_replace_callback("/(>)(.*?)(<)/si", 'callback', $matches[0]);

    return ($matches[0]);
}, $page);

// Print the modified page
echo $page;
?>