#!/usr/bin/php
<?php
if ($argc != 4)
    echo "Incorrect Parameters";
else
{
    $v1 = trim($argv[1], " \t");
    $op = trim($argv[2], " \t");
    $v2 = trim($argv[3], " \t");

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
    }
}
echo "\n";
?>