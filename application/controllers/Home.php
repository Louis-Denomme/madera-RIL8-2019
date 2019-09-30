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

        $tableAttente = $this->devis->getAllByEtat([1, 3]);
        $tableValide = $this->devis->getAllByEtat(4);
        $tableRefuse = $this->devis->getAllByEtat(5);


        $viewEnAttente = $this->load->view(
            'Home/_devisList',
            [
                'title' => 'Devis en attente de validation client',
                'devisList' => $tableAttente
            ],
            true
        );
        $viewAccepte = $this->load->view(
            'Home/_devisList',
            [
                'title' => 'Devis acceptés',
                'devisList' => $tableValide
            ],
            true
        );
        $viewRefuse = $this->load->view(
            'Home/_devisList',
            [
                'title' => 'Devis refusés',
                'devisList' => $tableRefuse
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
