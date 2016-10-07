<?php
require_once('auth.php');
session_start();

function entry_exist($value)
{
    return ($_GET[$value] || $_GET[$value] === "0");
}

// If user have provided the correct data and if they are correct, make the session
if (entry_exist('login') && entry_exist('passwd') && auth($_GET['login'], $_GET['passwd']))
{
    $_SESSION['loggued_on_user'] = $_GET['login'];
    echo "OK\n";
} else
{
    $_SESSION['loggued_on_user'] = "";
    echo "ERROR\n";
}