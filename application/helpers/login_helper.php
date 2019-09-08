<?php

if (!function_exists('checkLogin')) {

    function checkLogin()
    {
        $CI = &get_instance();

        $CI->load->library('session');

        if (!$CI->session->currently_logged_in)
            show_error('You must be connected to see this');
    }
}

if (!function_exists('isLogedIn')) {

    function isLogedIn()
    {
        $CI = &get_instance();

        $CI->load->library('session');

        return $CI->session->currently_logged_in ? true : false;
    }
}
if (!function_exists('isAllowedToCreateAccount')){
    function isAllowedToCreateAccount()
    {
        $CI = &get_instance();
        $CI->load->library('session');

        // idProfile = 1 = admin
        if ($CI->session->userdata['idProfile'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}