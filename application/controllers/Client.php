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

}
