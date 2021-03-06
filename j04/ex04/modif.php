<?php

function entry_exist($value)
{
    return ($_POST[$value] || $_POST[$value] === "0");
}

// Check if sended data are correct
if (entry_exist('login') && entry_exist('oldpw') && entry_exist('newpw') && $_POST['submit'] && $_POST['submit'] === "OK")
{
    // Unserialize the account database
    $account = unserialize(file_get_contents('../private/passwd'));

    // If the database exist, try to update the password otherwise, abort !
    if ($account)
    {
        $exist = 0;
        foreach ($account as $k => $v)
        {
            if ($v['login'] === $_POST['login'] && $v['passwd'] === hash('whirlpool', $_POST['oldpw']))
            {
                $exist = 1;
                $account[$k]['passwd'] =  hash('whirlpool', $_POST['newpw']);
            }
        }

        if ($exist)
        {
            file_put_contents('../private/passwd', serialize($account));
            echo "OK\n";
        } else
            echo "ERROR\n";
    } else
        echo "ERROR\n";
} else
    echo "ERROR\n";
?>