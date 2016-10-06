<?php

// Check if sended data are correct
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] === "OK")
{
    // Create the cache if it doesn't exit
    if (!file_exists('../private'))
        mkdir("../private");
    if (!file_exists('../private/passwd'))
        file_put_contents('../private/passwd', null);

    // Unserialize the account database
    $database = unserialize(file_get_contents('../private/passwd'));

    // If the database exist, make sure to check if the user isn't already registered
    if ($database)
    {
        $exist = 0;
        foreach ($database as $k => $v)
            if ($v['login'] === $_POST['login'])
                $exist = 1;
    }

    // The user already exist, abort!
    if ($exist)
        echo "ERROR\n";
    else
    {
        // Save the new user to the database and serialize it again
        $tmp['login'] = $_POST['login'];
        $tmp['passwd'] = hash('whirlpool', $_POST['passwd']);
        $database[] = $tmp;
        file_put_contents('../private/passwd', serialize($database));
        echo "OK\n";
    }
} else
    echo "ERROR\n";
?>