<?php
function auth($login, $passwd)
{
    if ((!$login && $login !== "0") || (!$passwd && $passwd !== "0"))
        return false;
    $account = unserialize(file_get_contents('../private/passwd'));
    if ($account)
        foreach ($account as $value)
            if ($value['login'] === $login && $value['passwd'] === hash('whirlpool', $passwd))
                return true;
    return false;
}
?>