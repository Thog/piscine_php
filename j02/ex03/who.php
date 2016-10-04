#!/usr/bin/php
<?php
// Force timezone for date function

date_default_timezone_set('Europe/Paris');

$file = fopen("/var/run/utmpx", "r");
while ($utmpx = fread($file, 628))
{
    /*
    * Unpack data from binary
    * user: 256 bytes
    * id: int 4 bytes
    * tty_name: 32 bytes
    * pid: 4 bytes
    * status_type: 2 bytes
    * ???: 2 bytes
    * timestamp: 4 bytes
    * microsecond: 4 bytes
    * hostname: 256 bytes
    * padding: 64 bytes
    */
    $unpack = unpack("a256a/a4b/a32c/id/ie/I2f/a256g/i16h", $utmpx);
    $array[$unpack['c']] = $unpack;
}

// Sort data
ksort($array);
foreach ($array as $data)
{
    if ($data['e'] == 7)
    {
        echo str_pad(substr(trim($data['a']), 0, 8), 8, " ") . " ";
        echo str_pad(substr(trim($data['c']), 0, 8), 8, " ") . " ";
        echo date("M", $data["f1"]);
        echo str_pad(date("j", $data["f1"]), 3, " ", STR_PAD_LEFT) . " ". date("H:i", $data["f1"]);
        echo "\n";
    }
}
?>