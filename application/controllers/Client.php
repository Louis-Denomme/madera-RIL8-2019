<?php

/**
 * @property mClient $client
 * @property mDevis $devis
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller {

	public function __construct() {
		parent::__construct();
//		checkLogin();
		$this->load->model('mClient', 'client');
		$this->load->model('mDevis', 'devis');

		// check perm
	}

	public function index() {
		$this->load->view('parts/vHeader');
		$data = [];

		// Queries
		$clients = $this->client->getAll();
		foreach ($clients as $k => $v) {
			$clients[$k]['nb_devis'] = $this->devis->getCountDevisByClient($v['id']);
		}
		$data['clients'] = $clients;
		$this->load->view('Client/vHome', $data);
		$this->load->view('parts/vFooter');
	}

	/**
	 * Renvoi la vue d'un nouveau client
	 */
	public function openDialogAddNewClient() {
		echo $this->load->view('Client/dialog/vNewClient', [], true);
	}

	/**
	 * Ajoute un nouveau client
	 */
	public function addNewClient() {
		// Récupère les données envoyées en POST par l'appel Ajax
		$data = [
			'nom' => get_post('nomClient', null),
			'email' => get_post('emailClient', null),
			'telephone' => get_post('telClient', null)
		];

		// Vérification de données non vide
		if (empty($data['nom'])) {
			echo json_encode(['error' => 'Le nom est vide']);
			exit;
		}
		if (empty($data['email'])) {
			echo json_encode(['error' => 'Le mail est vide']);
			exit;
		}
		if (empty($data['telephone'])) {
			echo json_encode(['error' => 'Le numéro de téléphone est vide']);
			exit;
		}

		// début transaction SQL
		$this->db->trans_start();
		$this->client->insert($data);
		$this->db->trans_complete();
		if ($this->db->trans_status() !== FALSE) {
			echo json_encode(['success' => true]);
		} else {
			echo json_encode(['error' => 'Erreur lors de l\'ajout du client']);
		}
	}

}
