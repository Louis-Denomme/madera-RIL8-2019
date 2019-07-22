<?php


class mLine
{
    private $id;
    private $name;
    private $idDefaultModel;
    private $createdAt;

    //<editor-fold desc="Getters and Setters">
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIdDefaultModel()
    {
        return $this->idDefaultModel;
    }

    /**
     * @param mixed $idDefaultModel
     */
    public function setIdDefaultModel($idDefaultModel)
    {
        $this->idDefaultModel = $idDefaultModel;
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
    //</editor-fold>



}