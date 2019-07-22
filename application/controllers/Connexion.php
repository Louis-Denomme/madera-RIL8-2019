<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connexion extends CI_Controller{


    function index(){
        $this->chargerVue();
    }

    function chargerVue(){
        $this->load->view('vConnexion');
    }

    // login action
    public function tentativeConnexion()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username:', 'required|trim|xss_clean|callback_validation');
        $this->form_validation->set_rules('password', 'Password:', 'required|trim');

        if ($this->form_validation->run())
        {
            $data = array(
                'username' => $this->input->post('username'),
                'currently_logged_in' => 1
            );
            $this->session->set_userdata($data);
            redirect('index.php/Connexion/verificationConnexion');
        }
        else {
            $this->load->view('vConnexion');
        }
    }

    public function verificationConnexion()
    {
        if ($this->session->userdata('currently_logged_in'))
        {
            $this->load->view('vAccueil');
        } else {
            redirect('index.php/Connexion/erreurConnexion');
        }
    }

    public function erreurConnexion()
    {
        $this->load->view('invalide');
    }



    public function validation()
    {
        $this->load->model('mConnexion');

        if ($this->mConnexion->utilisateurTrouve())
        {

            return true;
        } else {
            $this->form_validation->set_message('validation', 'Identifiant ou mot de passe incorrect');
            return false;
        }
    }

    public function deconnexion()
    {
        $this->session->sess_destroy();
        redirect('index.php/Connexion/chargerVue');
    }

}
?>