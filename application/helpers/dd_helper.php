<?php

if (!function_exists('dd')) {
    function dd($data, $die = true)
    {
        echo '<pre style="font-size: 12px;">';
        print_r($data);
        $die and die();
        echo '</pre>';
    }
}
