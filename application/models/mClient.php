<?php

class mClient extends CI_Model {

	private $id;
	private $name;
	private $mail;
	private $phone;
	private $idAdress;
	private $createdAt;
	private $updatedAt;

	public function __construct() {
		parent::__construct();
		$this->_fields = [];
		$this->_tblName = 'client';
	}

	/* ------------------------------------------------------------------------ */
	/* 								SELECT									  */
	/* ------------------------------------------------------------------------ */

	/**
	 * getAll clients
	 * @return type
	 */
	public function getAll() {
		$query = $this->db->get($this->_tblName);
		$data = $query->result_array();
		$query->free_result();
		return $data;
	}
	
	/**
	 * get un client par son ID
	 * @param type $CLIENT_ID
	 * @return type
	 */
	public function getByID($CLIENT_ID) {
		$this->db->select('*');
		$this->db->from($this->_tblName);
		$this->db->where('id', $CLIENT_ID);
		$query = $this->db->get();
		$data = $query->result_array();
		$query->free_result();
		if(!empty($data))
			return $data[0];
		else 
			return [];
	}

	/* ------------------------------------------------------------------------ */
	/* 								UPDATE										*/
	/* ------------------------------------------------------------------------ */
	
	/**
	 * Update un client avec les données contenues dans $data
	 * @param type $data
	 * @param type $CLIENT_ID
	 * @return type
	 */
	public function update($data, $CLIENT_ID) {
		$this->db->from($this->_tblName);
		foreach ($data as $k => $value) {
			$this->db->set($k, $value);
		}
		$this->db->where('id', $CLIENT_ID);
		$this->db->update();
		return $this->db->affected_rows();
	}

	/* ------------------------------------------------------------------------ */
	/* 								INSERT									  */
	/* ------------------------------------------------------------------------ */

	/**
	 * Insert un nouveau client
	 * Renvoi l'id inséré
	 * @param type $data
	 * @return type
	 */
	public function insert($data) {
		$this->db->insert($this->_tblName, $data);
		return $this->db->insert_id();
	}

	/* ------------------------------------------------------------------------ */
	/* 								DELETE									  */
	/* ------------------------------------------------------------------------ */

	/**
	 * Delete un client
	 * @param type $CLIENT_ID
	 */
	public function delete($CLIENT_ID) {
		$this->db->delete('devis', ['idClient' => $CLIENT_ID]);
		$this->db->delete($this->_tblName, ['id' => $CLIENT_ID]);
	}

	/* ------------------------------------------------------------------------ */
	/* 							GETTER / SETTER								  */
	/* ------------------------------------------------------------------------ */

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getMail() {
		return $this->mail;
	}

	/**
	 * @param mixed $mail
	 */
	public function setMail($mail) {
		$this->mail = $mail;
	}

	/**
	 * @return mixed
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @param mixed $phone
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * @return mixed
	 */
	public function getIdAdress() {
		return $this->idAdress;
	}

	/**
	 * @param mixed $idAdress
	 */
	public function setIdAdress($idAdress) {
		$this->idAdress = $idAdress;
	}

	/**
	 * @return mixed
	 */
	public function getCreateDate() {
		return $this->createDate;
	}

	/**
	 * @param mixed $createDate
	 */
	public function setCreateDate($createDate) {
		$this->createDate = $createDate;
	}

	/**
	 * @return mixed
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * @param mixed $createdAt
	 */
	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * @param mixed $updatedAt
	 */
	public function setUpdatedAt($updatedAt) {
		$this->updatedAt = $updatedAt;
	}

}
