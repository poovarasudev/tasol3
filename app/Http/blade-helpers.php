<?php

use Illuminate\Support\HtmlString;

function requiredSpan() {
    return new HtmlString('<span class="mandatory" style="color: red;">*</span>');
}

function getYesOrNoButton($value) {
    $text = $value ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>';
    return new HtmlString($text);
}

function setActive($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

/**
 * It will create a edit button.
 *
 * @param $url
 * @param $toolTip
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
 * @param $toolTip
 * @return string
 */
function deleteButton($url, $name)
{
    return '<a type="button" class="btn mb-2 btn-outline-link" href="javascript:void(0);" onclick="commonDelete(\'' . $url . '\', \'' . $name . '\')">
                    <span class="fe fe-trash fe-16"></span></a>';
}
