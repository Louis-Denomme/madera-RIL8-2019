<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cHome extends CI_Controller
{

    public $CI = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
    }

    function index()
    {
        $this->loadView();
    }

    function loadView()
    {
        $dicoDevisEnCours = array("coucou","ccco");

        $data = array(
            'dicoDevisEnCours' => $dicoDevisEnCours,
        );
        $this->load->view("vHome");
    }

    public function isAllowedToCreateAccount()
    {
        // idProfile = 1 = admin
        if ($this->session->userdata['idProfile'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function loadCreateAccountView()
    {
        $this->load->view('vCreateAccount');
    }

    public function tryCreateAccount()
    {

        $this->load->helper('security');
        $this->load->library('form_validation');


        $this->form_validation->set_rules('name', 'Nom :', 'required|trim');
        $this->form_validation->set_rules('firstname', 'Prénom :', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Identifiant:', 'required|trim');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirmPassword', 'Confirmer mot de passe', 'required|matches[password]');

        if ($this->form_validation->run() && $this->validation()) {
            $this->load->view('vHome');
        } else {
            $this->load->view('vCreateAccount');
        }

    }

    function sendEmailCreationAccount($email) {
        $this->load->config('email');
        $this->load->library('email');

        $from = $this->config->item('smtp_user');
        $to = $email;
        $subject = 'Création de compte réussi !';
        $message = 'Identifiant : '.$this->input->post('username').'\n Mot de passe : '.$this->input->post('password');

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function validation()
    {
        var_dump("validation");
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $profil = $this->input->post('profil');

        $this->load->model('User');
        if ($this->User->usernameExist($username)) {
            $this->form_validation->set_message('validation', 'L\'identifiant renseigné existe déjà !');
            return false;
        }

        $this->User->createAccount($username, $password, $profil);
        if ($this->User->usernameExist($username)) {
           // $this->sendEmailCreationAccount($email);
            return true;
        } else {
            return false;
        }
    }
}

?>