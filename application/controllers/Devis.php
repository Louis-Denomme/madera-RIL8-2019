<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Devis extends CI_Controller
{

    function index($idDevis)
    {
        checkLogin();

        $idDevis = intval($idDevis);
        if (!is_int($idDevis))
            show_error('ID incorrect ' . $idDevis);

        $this->load->view('parts/vHeader');

        //TODO

        $this->load->view('parts/vFooter');
    }
}
