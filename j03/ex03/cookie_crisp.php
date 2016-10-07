<?php

function entry_exist($value)
{
    return ($_GET[$value] || $_GET[$value] === "0");
}

switch ($_GET['action'])
{
    case "set":
		if (entry_exist('name') && entry_exist('value'))
            setcookie($_GET['name'], $_GET['value']);
        break;
    case "get":
	    if (entry_exist('name') && ($_COOKIE[$_GET['name']] || $_COOKIE[$_GET['name']] === "0") && !entry_exist('value'))
            echo $_COOKIE[$_GET['name']]."\n";
        break;
	case "del":
	    if (entry_exist('name') && !entry_exist('value'))
            setcookie($_GET['name'], '', 1);
        break;
}