<?php
function compile_assets($path)
{
    return env('APP_ENV') == 'production' ? mix($path) : asset($path);
}

function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}


