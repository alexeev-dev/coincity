<?php
function compile_assets($path) {
    return env('APP_ENV') == 'production' ? mix($path) : asset($path);
}

