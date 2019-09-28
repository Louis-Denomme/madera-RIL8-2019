<?php


class mDevis extends CI_Model
{
    private $id;
    private $idModel;
    private $idClient;
    private $reference;
    private $state;

    private $createdBy;
    private $createdAt;
    private $updatedBy;
    private $updatedAt;
	
	public function __construct() {
		parent::__construct();
		$this->_fields = [];
		$this->_tblName = 'devis';
	}
	
	/**
	 * getAll devis
	 * @return type
	 */
	public function getAll() {
		$query = $this->db->get($this->_tblName);
		$data = $query->result_array();
		$query->free_result();
		return $data;
	}
	
	/**
	 * Renvoi le nombre de devis par client
	 * @param type $idClient
	 */
	public function getCountDevisByClient($idClient) {
		$this->db->from($this->_tblName);
		$this->db->where('idClient', $idClient);
		return $this->db->count_all_results();
	}

    /* Getters and setters */
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdModel()
    {
        return $this->idModel;
    }

    /**
     * @param mixed $idModel
     */
    public function setIdModel($idModel)
    {
        $this->idModel = $idModel;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param mixed $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}