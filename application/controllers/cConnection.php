<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cConnection extends CI_Controller
{


    function index()
    {
        $this->loadView();
    }

    function loadView()
    {
        $this->load->view('vConnection');
    }

    /**
     *  check if value is correct format
     */
    public function tryConnection()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Identifiant:', 'required|trim|xss_clean|callback_validation');
        $this->form_validation->set_rules('password', 'mot de passe:', 'required|trim');
        if ($this->form_validation->run()) {
            $data = array(
                'username' => $this->input->post('username'),
                'idProfile' => $this->User->idProfile,
                'currently_logged_in' => 1
            );
            $this->session->set_userdata($data);
            //redirect('index.php/cConnection/verifyConnection');
            $this->verifyConnection();
        } else {
            $this->load->view('vConnection');
        }
    }

    public function verifyConnection()
    {
        if ($this->session->userdata('currently_logged_in')) {
            //$this->load->view('vHome');
            redirect('index.php/cHome');
        } else {
            //redirect('index.php/cConnection/errorConnection');
            $this->errorConnection();
        }
    }

    public function errorConnection()
    {
        $this->load->view('vInvalid');
    }


    public function validation()
    {
        $this->load->model('User');
        var_dump(password_hash('test',PASSWORD_DEFAULT));
        if ($this->User->checkPassword($this->input->post('username'), $this->input->post('password'))) {
            return true;
        } else {
            $this->form_validation->set_message('validation', 'Identifiant ou mot de passe incorrect');
            return false;
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        //redirect('index.php/cConnection/loadView');
        $this->loadView();
    }
}

?>