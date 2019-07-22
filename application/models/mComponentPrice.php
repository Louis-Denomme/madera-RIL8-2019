<?php


class mComponentPrice
{
    private $id;
    private $idComponent;
    private $idComponentHisto;
    private $price;
    private $isValid;
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
    public function getIdComponent()
    {
        return $this->idComponent;
    }

    /**
     * @param mixed $idComponent
     */
    public function setIdComponent($idComponent)
    {
        $this->idComponent = $idComponent;
    }

    /**
     * @return mixed
     */
    public function getIdComponentHisto()
    {
        return $this->idComponentHisto;
    }

    /**
     * @param mixed $idComponentHisto
     */
    public function setIdComponentHisto($idComponentHisto)
    {
        $this->idComponentHisto = $idComponentHisto;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
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