<?php
require_once('auth.php');
session_start();

// If user have provided the correct data and if they are correct, make the session
if ($_GET['login'] && $_GET['passwd'] && auth($_GET['login'], $_GET['passwd']))
{
    $_SESSION['loggued_on_user'] = $_GET['login'];
    echo "OK\n";
} else
{
    $_SESSION['loggued_on_user'] = "";
    echo "ERROR\n";
}