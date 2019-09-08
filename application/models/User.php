<?php

class User extends CI_Model
{

    public $id;
    public $username;
    public $password;
    public $idProfile;
    public $dateCreate;

    public function checkPassword($username, $password)
    {
        $query = $this->db
            ->select('*')
            ->from('user')
            ->where('username', $username)
            ->get();

        if ($query->num_rows() != 1) {
            return false;
        } else {
            $row = $query->row();
            if (!password_verify($password, $row->password)) {
                return false;
            }
        }

        $this->saveUser($query);
        return true;
    }

    public function usernameExist($username)
    {
        $query = $this->db
            ->select('username')
            ->from('user')
            ->where('username', $username)
            ->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function createAccount($username, $password, $profilValue)
    {
        $idProfile = 0;
        if ($profilValue == 'profilAdmin') {
            $idProfile = 1;
        }
        if ($profilValue == 'profilCommercial') {
            $idProfile = 2;
        }
/*
        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'idProfile' => $idProfile,
            'dateCreated' => gmdate('Y-m-d H:i:s', time() + 3600 * 2)
        );

        $this->db->insert('user', $data);
*/

        $sql = "insert into user (username, password, idProfile)
        values ('" . $username . "', '" . password_hash($password, PASSWORD_DEFAULT) . "'," . $idProfile . ")";

        $this->db->query($sql);
    }

    private function saveUser($query)
    {
        $this->id = $query->row()->id;
        $this->username = $query->row()->username;
        $this->password = $query->row()->password;
        $this->idProfile = $query->row()->idProfile;
        $this->dateCreate = $query->row()->dateCreate;
    }
}

?>