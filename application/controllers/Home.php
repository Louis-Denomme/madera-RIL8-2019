<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function index()
    {
        //checkLogin();

        $this->load->view('parts/vHeader');

        //TODO recup les différentes listes depuis la bdd et faire les liens dans l'UI vers la page d'edition
        $viewEnAttente = $this->load->view(
            'Home/_devisList',
            [
                'title' => 'Devis en attente',
                'devisList' => [
                    1,
                    2
                ]
            ],
            true
        );
        $viewAccepte = $this->load->view(
            'Home/_devisList',
            [
                'title' => 'Devis acceptés',
                'devisList' => [
                    1,
                    2
                ]
            ],
            true
        );
        $viewRefuse = $this->load->view(
            'Home/_devisList',
            [
                'title' => 'Devis refusés',
                'devisList' => [
                    1,
                    2
                ]
            ],
            true
        );

        $data = [
            'viewEnAttente' => $viewEnAttente,
            'viewAccepte' => $viewAccepte,
            'viewRefuse' => $viewRefuse,
            'clients' => [
                ['id' => 1, 'nom' => 'Jean', 'prenom' => 'michel']
            ]
        ];

        $this->load->view('Home/vHome', $data);

        $this->load->view('parts/vFooter');
    }
}
