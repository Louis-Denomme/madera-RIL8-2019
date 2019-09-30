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
        $this->db->select('devis.id, devis.etat, client.nom');
        $this->db->from('devis');
        $this->db->join('client', 'devis.idClient = client.id','INNER');
        $query = $this->db->get();

        //var_dump($query->result());

        $tableAttente = array();
        $tableValide = array();
        $tableRefuse = array();

        foreach ($query->result() as $row){
            //var_dump($row);
            if ($row->etat == 1 || $row->etat == 3){
                array_push($tableAttente, $row->id);
            }else if($row->etat == 4){
                array_push($tableValide, $row->id);
            }else if($row->etat == 5){
                array_push($tableRefuse, $row->id);
            }
        }

        $viewEnAttente = $this->load->view(
            'Home/_devisList',
            [
                'etat' => 1,
                'title' => 'Devis en attente de validation client',
                'devisList' => $tableAttente
            ],
            true
        );
        $viewAccepte = $this->load->view(
            'Home/_devisList',
            [
                'etat' => 2,
                'title' => 'Devis acceptés',
                'devisList' => $tableValide
            ],
            true
        );
        $viewRefuse = $this->load->view(
            'Home/_devisList',
            [
                'etat' => 3,
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
