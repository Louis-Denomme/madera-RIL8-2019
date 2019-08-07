<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function index()
    {
        checkLogin();

        $this->load->view('parts/vHeader');

        $viewEnAttente = $this->load->view(
            '_devisList',
            [
                'title' => 'Devis en attente',
                'devisList' => [
                    'a',
                    'b'
                ]
            ],
            true
        );
        $viewAccepte = $this->load->view(
            '_devisList',
            [
                'title' => 'Devis acceptés',
                'devisList' => [
                    'a',
                    'b'
                ]
            ],
            true
        );
        $viewRefuse = $this->load->view(
            '_devisList',
            [
                'title' => 'Devis refusés',
                'devisList' => [
                    'a',
                    'b'
                ]
            ],
            true
        );

        $data = [
            'viewEnAttente' => $viewEnAttente,
            'viewAccepte' => $viewAccepte,
            'viewRefuse' => $viewRefuse
        ];

        $this->load->view('vHome', $data);

        $this->load->view('parts/vFooter');
    }
}
