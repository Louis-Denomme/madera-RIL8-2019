<?php


class mMarge extends CI_Model
{
    private $id;
    private $margeCommerciale;
    private $margeEntreprise;
    private $dateCreation;

    /**
     * mMarge constructor.
     */
    public function __construct()
    {
        $query = $this->db
            ->select('*')
            ->from('marge')
            ->order_by('dateCreation', 'desc')
            ->limit(1)
            ->get();

        if ($query->num_rows() == 1) {
          $row = $query->row();
          $this->id = $row->id;
          $this->margeCommerciale = $row->margeCommerciale;
          $this->margeEntreprise = $row->margeEntreprise;
          $this->dateCreation = $row->dateCreation;
        }
    }

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
    public function getMargeCommerciale()
    {
        return $this->margeCommerciale;
    }

    /**
     * @param mixed $margeCommerciale
     */
    public function setMargeCommerciale($margeCommerciale)
    {
        $this->margeCommerciale = $margeCommerciale;
    }

    /**
     * @return mixed
     */
    public function getMargeEntreprise()
    {
        return $this->margeEntreprise;
    }

    /**
     * @param mixed $margeEntreprise
     */
    public function setMargeEntreprise($margeEntreprise)
    {
        $this->margeEntreprise = $margeEntreprise;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->DateCreation;
    }

    /**
     * @param mixed $DateCreation
     */
    public function setDateCreation($DateCreation)
    {
        $this->DateCreation = $DateCreation;
    }

    /**
     * @return mixed
     */
    public function getDateModification()
    {
        return $this->DateModification;
    }

    /**
     * @param mixed $DateModification
     */
    public function setDateModification($DateModification)
    {
        $this->DateModification = $DateModification;
    }

    public function createMarge($margeCommerciale, $margeEntreprise)
    {
        if($margeCommerciale == $this->margeCommerciale && $margeEntreprise == $this->margeEntreprise){return;}
        if($margeCommerciale == null){$margeCommerciale = 0;}
        if($margeEntreprise == null){$margeEntreprise = 0;}

        $sql = "insert into marge ( margeCommerciale, margeEntreprise)
        values (" . $margeCommerciale . ", " . $margeEntreprise . ")";

        $this->db->query($sql);
    }
}

