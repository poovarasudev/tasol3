<?php

use Illuminate\Support\HtmlString;

function requiredSpan() {
    return htmlString('<span class="mandatory" style="color: red;">*</span>');
}

function htmlString($html) {
    return new HtmlString($html);
}

function getYesOrNoBadge($value) {
    $badge = $value ? '<button class="btn badge-success btn-sm">Yes</button>' : '<button class="btn badge-danger btn-sm">No</button>';
    return new HtmlString($badge);
}

function setActive($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

/**
 * It will create a edit button.
 *
 * @param $url
 * @return string
 */
function editButton($url)
{
    return '<a type="button" class="btn mb-2 btn-outline-link" href=' . $url . '>
                    <span class="fe fe-edit fe-16"></span></a>';
}

/**
 * It will create a edit button.
 *
 * @param $url
 * @param $name
 * @return string
 */
function deleteButton($url, $name)
{
    return '<a type="button" class="btn mb-2 btn-outline-link" href="javascript:void(0);" onclick="commonDelete(\'' . $url . '\', \'' . $name . '\')">
                    <span class="fe fe-trash fe-16"></span></a>';
}

/**
 * It will create a view button.
 *
 * @param $url
 * @return string
 */
function viewButton($url)
{
    return '<a type="button" class="btn mb-2 btn-outline-link" href="' . $url . '">
                    <span class="fe fe-eye fe-16"></span></a>';
}

function formattedPermissionName($name) {
    return ucwords(str_replace('_', ' ', str_replace('.', ' - ', $name)));
}

function getSingularOrPlural($name, $count) {
    return ($count > 0) ? ($name . 's') : $name;
}

function getYesOrNo($value) {
    return $value ? 'Yes' : 'No';
}
