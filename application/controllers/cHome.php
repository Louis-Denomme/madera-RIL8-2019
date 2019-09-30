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
        $dicoDevisEnCours = array("coucou", "ccco");

        $data = array(
            'dicoDevisEnCours' => $dicoDevisEnCours,
        );
        $this->load->view("vHome");
    }

    public function loadCreateAccountView()
    {
        $this->load->view('parts/vHeader');
        $this->load->view('vCreateAccount');
        $this->load->view('parts/vFooter');
    }

    public function tryCreateAccount()
    {

        $this->load->helper('security');
        $this->load->library('form_validation');


        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        $this->form_validation->set_rules('lastname', '"Nom"', 'required|trim');
        $this->form_validation->set_rules('firstname', '"Prénom"', 'required|trim');
        $this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', '"Identifiant"', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('password', '"Mot de passe"', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirmPassword', '"Confirmation mot de passe"', 'required|matches[password]');

        if ($this->form_validation->run() && $this->validation()) {
            redirect('index.php/Home');
        } else {
            $this->loadCreateAccountView();
        }

    }

    function sendEmailCreationAccount($email)
    {
        $this->load->config('email');
        $this->load->library('email');

        $from = $this->config->item('smtp_user');
        $to = $email;
        $subject = 'Création de compte réussi !';
        $message = 'Identifiant : ' . $this->input->post('username') . '\n Mot de passe : ' . $this->input->post('password');

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
        //var_dump("validation");
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $profil = $this->input->post('profil');

        $this->load->model('User');
        $this->User->createAccount($username, $password, $profil);
        if (!$this->form_validation->is_unique($username,'user.username')) {
            // is_unique == false ==  exist in db! success create
            return true;
        } else {
            // is_unique == true == not  exist in db! error create
            return false;
        }
    }
}

?>