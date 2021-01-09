<?php

/**
 * It will create the 'delete button with from submit'.
 *
 * @param $url
 * @param $toolTip
 * @return string
 */
function deleteButtonWithFormSubmit($url, $toolTip)
{
    return '<form action="' . url($url) . '" method="POST">' . method_field('DELETE') . csrf_field() . '
            <a type="button" class="btn mb-2 btn-outline-link" title="Delete ' . $toolTip . '" onclick="commonDelete(this)">
            <span class="fe fe-trash fe-16"></span></a>
            </form>';
}
