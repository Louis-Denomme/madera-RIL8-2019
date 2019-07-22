<?php


class mModel
{
    private $id;
    private $name;
    private $idExteriorFinish;
    private $idIsolatorType;
    private $idCoverType;
    private $frameQuality;
    private $idLine;
    private $createdAt;

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
    public function getIdExteriorFinish()
    {
        return $this->idExteriorFinish;
    }

    /**
     * @param mixed $idExteriorFinish
     */
    public function setIdExteriorFinish($idExteriorFinish)
    {
        $this->idExteriorFinish = $idExteriorFinish;
    }

    /**
     * @return mixed
     */
    public function getIdIsolatorType()
    {
        return $this->idIsolatorType;
    }

    /**
     * @param mixed $idIsolatorType
     */
    public function setIdIsolatorType($idIsolatorType)
    {
        $this->idIsolatorType = $idIsolatorType;
    }

    /**
     * @return mixed
     */
    public function getIdCoverType()
    {
        return $this->idCoverType;
    }

    /**
     * @param mixed $idCoverType
     */
    public function setIdCoverType($idCoverType)
    {
        $this->idCoverType = $idCoverType;
    }

    /**
     * @return mixed
     */
    public function getFrameQuality()
    {
        return $this->frameQuality;
    }

    /**
     * @param mixed $frameQuality
     */
    public function setFrameQuality($frameQuality)
    {
        $this->frameQuality = $frameQuality;
    }

    /**
     * @return mixed
     */
    public function getIdLine()
    {
        return $this->idLine;
    }

    /**
     * @param mixed $idLine
     */
    public function setIdLine($idLine)
    {
        $this->idLine = $idLine;
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


}