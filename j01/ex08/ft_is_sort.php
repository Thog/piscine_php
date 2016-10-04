<?php
function ft_is_sort($array)
{
    $sorted = $array;
    sort($sorted);
    foreach ($sorted as $key => $value)
        if ($value !== $array[$key])
            return false;
    return true;
}
?>