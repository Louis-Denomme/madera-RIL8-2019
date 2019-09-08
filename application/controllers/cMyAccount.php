<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cMyAccount extends CI_Controller
{

    public $username;
    public $profil;

    function index()
    {
        $this->username = $this->session->userdata['username'];
        $this->profil = $this->session->userdata['idProfile'] == 1 ? 'Admin' : 'Commercial';
        $this->loadView();
    }

    function loadView()
    {
        $this->load->view('parts/vHeader');
        $this->load->view('MyAccount/vMyAccount');
        $this->load->view('parts/vFooter');
    }

    function loadViewChangePassword()
    {
        $this->load->view('parts/vHeader');
        $this->load->view('MyAccount/vChangePassword');
        $this->load->view('parts/vFooter');
    }

    function passwordMatches()
    {
        $this->load->model('User');
        $passwordHashedFromDB = $this->User->getPasswordByUsername($this->session->userdata['username']);
        $passwordFromUI = $this->input->post('oldPassword');

        if (password_verify($passwordFromUI,$passwordHashedFromDB)) {
            return true;
        } else {
            $this->form_validation->set_message('passwordMatches', 'Le mot de passe saisie est incorrect');
            return false;
        }
    }

    function tryChangePassword()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        $this->form_validation->set_rules('oldPassword', '"Ancien mot de passe"', 'required|trim|callback_passwordMatches');
        $this->form_validation->set_rules('newPassword', '"Nouveau mot de passe"', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirmNewPassword', '"Confirmation nouveau mot de passe"', 'required|matches[newPassword]');

        if ($this->form_validation->run()) {
            $this->load->model('User');

            $data = array(
                'username' => $this->session->userdata['username'],
                'password' => $this->input->post('newPassword'),
                'idProfile' => $this->session->userdata['idProfile']
            );
            $this->User->updateAccount($data);
            redirect('index.php/Home');
        } else {
            $this->loadViewChangePassword();
        }


    }

}

?>