<?php


class mComponent
{
    private $id;
    private $name;
    private $idSupplier;
    private $idUseUnit;
    private $idComponentFamily;
    private $description;
    private $quality;
    private $idPrice;
    private $createdAt;
    private $updatedAt;

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
    public function getIdSupplier()
    {
        return $this->idSupplier;
    }

    /**
     * @param mixed $idSupplier
     */
    public function setIdSupplier($idSupplier)
    {
        $this->idSupplier = $idSupplier;
    }

    /**
     * @return mixed
     */
    public function getIdUseUnit()
    {
        return $this->idUseUnit;
    }

    /**
     * @param mixed $idUseUnit
     */
    public function setIdUseUnit($idUseUnit)
    {
        $this->idUseUnit = $idUseUnit;
    }

    /**
     * @return mixed
     */
    public function getIdComponentFamily()
    {
        return $this->idComponentFamily;
    }

    /**
     * @param mixed $idComponentFamily
     */
    public function setIdComponentFamily($idComponentFamily)
    {
        $this->idComponentFamily = $idComponentFamily;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param mixed $quality
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
    }

    /**
     * @return mixed
     */
    public function getIdPrice()
    {
        return $this->idPrice;
    }

    /**
     * @param mixed $idPrice
     */
    public function setIdPrice($idPrice)
    {
        $this->idPrice = $idPrice;
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