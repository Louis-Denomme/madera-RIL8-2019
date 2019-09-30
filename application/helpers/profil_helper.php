<?php

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