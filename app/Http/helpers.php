<?php

function glue(array $array, $glue = ',')
{
    return implode($glue, $array);
}

function isNullOrEmpty($value)
{
    return ($value == '' || $value == null);
}

function getDisplayValue($value)
{
    return isNullOrEmpty($value) ? '-' : $value;
}

function isEmptyArray($array)
{
    return count($array) == 0;
}
