<?php
/**
 * @property mClient $client
 * @property mDevis $devis
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
		public function __construct() {
		parent::__construct();
//		checkLogin();
		$this->load->model('mClient', 'client');
		$this->load->model('mDevis', 'devis');

		// check perm
	}

    function index()
    {
        $this->load->view('parts/vHeader');

        //TODO recup les différentes listes depuis la bdd et faire les liens dans l'UI vers la page d'edition
        $viewEnAttente = $this->load->view(
            'Home/_devisList',
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
            'Home/_devisList',
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
            'Home/_devisList',
            [
                'title' => 'Devis refusés',
                'devisList' => [
                    'a',
                    'b'
                ]
            ],
            true
        );
		
		$clients = $this->client->getAll();

        $data = [
            'viewEnAttente' => $viewEnAttente,
            'viewAccepte' => $viewAccepte,
            'viewRefuse' => $viewRefuse,
            'clients' => $clients
        ];

        $this->load->view('Home/vHome', $data);

        $this->load->view('parts/vFooter');
    }
}
