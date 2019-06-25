<?php

class mConnexion extends CI_Model {

    public function utilisateurTrouve() {

        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', $this->input->post('password'));
        $query = $this->db->get('user');

        if ($query->num_rows() == 1)
        {
            return true;
        } else {
            return false;
        }

    }


}
?>