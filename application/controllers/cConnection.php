<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cConnection extends CI_Controller
{


    function index()
    {
        $this->load->view('parts/vHeader');
        $this->load->view('vConnection');
        $this->load->view('parts/vFooter');
    }

    /**
     *  check if value is correct format
     */
    public function tryConnection()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username:', 'required|trim|xss_clean|callback_validation');
        $this->form_validation->set_rules('password', 'Password:', 'required|trim');

        if ($this->form_validation->run()) {
            $data = [
                'username' => $this->input->post('username'),
                'currently_logged_in' => true
            ];
            $this->session->set_userdata($data);
            redirect('index.php/cConnection/verifyConnection');
        } else {
            $this->load->view('parts/vHeader');
            $this->load->view('vConnection');
            $this->load->view('parts/vFooter');
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
        var_dump(password_hash('admin',PASSWORD_DEFAULT));
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