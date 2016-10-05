#!/usr/bin/php
<?php

/*
* Download a html page
*/
function curl_html($url)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $html = curl_exec($curl);
    curl_close($curl);
    return ($html);
}

/*
* Get all paths of img tags
*/
function retrieve_images($html, $url)
{
    preg_match_all("/<img[^>]+src=([^\s>]+)/i", $html, $matches);
    foreach ($matches[1] as $k => $v)
    {
        $matches[1][$k] = trim($v, "\"");
        if (!preg_match("/^http(s?):\/\//", $matches[1][$k]))
        {
            if (preg_match("/^\//", $matches[1][$k]))
            {
                preg_match("/^(http(s?):\/\/)([^\/]+)/", $url, $urlMatches);
                $matches[1][$k] = $urlMatches[1]."".$urlMatches[3]."".$matches[1][$k];
            } else
                $matches[1][$k] = $url."".$matches[1][$k];
        }
    }
    return ($matches);
}

/*
* Create a folder using the base url
*/
function create_folder($url)
{
    $url = preg_replace("/^.*?:\/\//", '', $url);
    if (file_exists($url) && is_dir($url))
        return ($url);
    mkdir($url);
    return ($url);
}

/*
* Get image file name using link
*/
function get_name($img)
{
    preg_match("/^.*?([^\/]+)$/", $img, $matches);
    print_r($img . $matches);
    if (substr($matches[1], -1) === "\"" || substr($matches[1], -1) === "'")
        return (substr($matches[1], 0, -1));
    return ($matches[1]);
}

/*
* Download the given images and save them to the target folder
*/
function download_images($imgs, $folder)
{
    foreach ($imgs[1] as $img)
    {
        $curl = curl_init($img);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER,1);
        $raw = curl_exec($curl);
        curl_close($curl);
        $fp = fopen($folder . "/" . get_name($img), 'w');
        if ($fp)
        {
            fwrite($fp, $raw);
            fclose($fp);
        }
    }
}

if ($argc < 1)
    exit();

$html = curl_html($argv[1]);

if (!empty($html))
{
    $imgs = retrieve_images($html, $argv[1]);
    $folder = create_folder($argv[1]);
    download_images($imgs, $folder);
}
?>