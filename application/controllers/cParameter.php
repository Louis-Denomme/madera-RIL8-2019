<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cParameter extends CI_Controller
{

    public $currentMarge;

    function index()
    {
        $this->load->model('mMarge');
        $this->currentMarge = $this->mMarge;

        $data = array(
            'margeCommerciale' => $this->currentMarge->getMargeCommerciale(),
            'margeEntreprise' => $this->currentMarge->getMargeEntreprise()
        );

        $this->session->set_userdata($data);
        $this->loadView();
    }

    function loadView()
    {
        $this->load->view('parts/vHeader');
        $this->load->view('Parameter/vParameter');
        $this->load->view('parts/vFooter');
    }

    function updateParameter()
    {
        //   $this->currentMarge->setMargeCommerciale($this->input->post('margeCommerciale'));
        //   $this->currentMarge->setMargeEntreprise($this->input->post('margeEntreprise'));
        //var_dump($_POST);

        $margeCommerciale = get_post('margeCommerciale');
        $margeEntreprise = get_post('margeEntreprise');

        $data = [
            'margeCommerciale' => $margeCommerciale,
            'margeEntreprise' => $margeEntreprise
        ];


        $this->session->set_userdata($data);
        $this->validation();
    }

    function validation()
    {
        $margeCommerciale = $this->session->userdata('margeCommerciale');
        $margeEntreprise = $this->session->userdata('margeEntreprise');

        $this->load->model('mMarge');
        $this->db->trans_start();
        $this->mMarge->createMarge($margeCommerciale, $margeEntreprise);
        $this->db->trans_complete();
        if($this->db->trans_status() !== FALSE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Erreur, un problème est survenue lors de la définition de la marge']);
        }

    }
}
