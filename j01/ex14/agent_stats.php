#!/usr/bin/php
<?php
    if ($argc != 2)
        exit();

    $data = array();
    $stdin = fopen("php://stdin", "r");
    while ($stdin && !feof($stdin))
    {
        $line = fgets($stdin);
        if ($line)
        {
            $tmp = explode(';', $line);
            if (array_key_exists(1, $tmp) && is_numeric($tmp[1]))
            {
                if ($tmp[2] === "moulinette")
                    $data[$tmp[0]]['note_moulinette'] = $tmp[1];
                else
                    $data[$tmp[0]]['note'][] = $tmp[1];
            }
        }
    }
    ksort($data);
    $moyenne_user = array();
    $moyenne = 0;
    $count_moyenne = 0;
    foreach ($data as $name => $content)
    {
        foreach ($content['note'] as $value)
        {
            if ($argv[1] === "moyenne_user" || $argv[1] === "ecart_moulinette")
            {
                if (!array_key_exists($name, $moyenne_user))
                    $moyenne_user[$name] = 0;
                $moyenne_user[$name] = $moyenne_user[$name] + intval($value);
            }
            else {
                $moyenne += intval($value);
                $count_moyenne++;
            }
        }
        if (array_key_exists($name, $moyenne_user))
            $moyenne_user[$name] /= count($content['note']);
    }

    if ($count_moyenne !== 0)
        $moyenne /= $count_moyenne;

    if ($argv[1] === "moyenne_user")
    {
        foreach ($moyenne_user as $name => $value)
            echo "$name:$value\n";
    }
    else if ($argv[1] === "ecart_moulinette")
    {
        foreach ($moyenne_user as $name => $value)
        {
            if (array_key_exists('note_moulinette', $data[$name]))
            {
                $value -= intval($data[$name]['note_moulinette']);
                echo "$name:$value\n";
            }
        }

    }
    else if ($argv[1] === "moyenne")
    {
        echo "$moyenne\n";
    }
?>