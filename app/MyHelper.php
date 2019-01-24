<?php
if (!function_exists('is_current_route')) {
    function is_current_route($path, $active = 'active')
    {
        return call_user_func_array('Request::is', (array) $path) ? $active : '';
    }
}

if (!function_exists('format_message')) {
    function format_message($message, $type)
    {
        return "<div class='alert bg-$type' role='alert'><em class='fa fa-comment mr-2'></em> $message <a href='#' class='float-right'><em class='fa fa-remove'></em></a></div>";
    }
}
