#!/usr/bin/php
<?php
if ($argc >= 2)
    echo trim(preg_replace("/[ \t\r]+/", " ", $argv[1])) ."\n";
?>