<?php

class User extends CI_Model
{

    public $id;
    public $username;
    public $password;
    public $idProfile;
    public $dateCreate;


    public function getPasswordByUsername($username)
    {
        $query = $this->db
            ->select('*')
            ->from('user')
            ->where('username', $username)
            ->get();
        if ($query->num_rows() != 1) {
            return null;
        } else {
            $row = $query->row();
            $password = $row->password;
            return $password;
        }
    }

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

        $sql = "insert into user (username, password, idProfile)
        values ('" . $username . "', '" . password_hash($password, PASSWORD_DEFAULT) . "'," . $idProfile . ")";

        $this->db->query($sql);
    }

    public function updateAccount($data)
    {
        $sql = "update user 
            set idProfile = '" . $data['idProfile'] . "', 
                password = '" . password_hash($data['password'], PASSWORD_DEFAULT) . "' 
            where username = '" . $data['username'] . "'";

        $this->password = $data['password'];
        $this->idProfile = $data['idProfile'];

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