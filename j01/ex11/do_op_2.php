#!/usr/bin/php
<?php
if ($argc != 2)
    echo "Incorrect Parameters";
else
{
    $tmp = str_replace(" ", "", $argv[1]);
    $v1 = intval($tmp);
    $v1_length = strlen((string)$v1);
    $op = substr(substr($tmp, $v1_length), 0, 1);
    $v2 = substr(substr($tmp, $v1_length), 1);
    if (!is_numeric($v1) || !is_numeric($v2))
    {
        echo "Syntax Error\n";
        exit();
    }

    switch ($op)
    {
        case "*":
            echo $v1 * $v2;
            break;
        case "+":
            echo $v1 + $v2;
            break;
        case "-":
            echo $v1 - $v2;
           break;
        case "/":
            echo $v1 / $v2;
            break;
        case "%":
            echo $v1 % $v2;
            break;
        default:
            echo "Syntax Error";
            break;
    }
}
echo "\n";
?>