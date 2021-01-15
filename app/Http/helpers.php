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

function formatTeamName($teamName)
{
    if (!stripos($teamName, 'team')) {
        $teamName .= ' Team';
    }
    return $teamName;
}

function authNotificationReadedNow($teamName)
{
    auth()->user()->notificationReadAtNow();
}
