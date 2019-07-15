<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator_model extends CI_Model {

    private $_table = "user";

    function __construct() {
        $this->load->library('encrypt');
    }

    public function validate($mail, $password) {
        if (($passwd_crypt = $this->_getUser($mail)) !== FALSE)
            return (bool) ($password == $passwd_crypt);
        return false;
    }

    private function _getUser($mail) {
        $user = $this->db->select(array('mail', 'password'))->get_where($this->_table, array('mail' => $mail))->row();
        if (isset($user->password))
            return $this->encrypt->decode($user->password);
        return false;
    }
}