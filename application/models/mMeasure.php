<?php


class mMeasure
{
    private $id;
    private $idTypeMeasure;
    private $idComponent;
    private $idModule;
    private $value;
    private $createdAt;

    //<editor-fold desc="Getters and setters">
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
    public function getIdTypeMeasure()
    {
        return $this->idTypeMeasure;
    }

    /**
     * @param mixed $idTypeMeasure
     */
    public function setIdTypeMeasure($idTypeMeasure)
    {
        $this->idTypeMeasure = $idTypeMeasure;
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
    public function getIdModule()
    {
        return $this->idModule;
    }

    /**
     * @param mixed $idModule
     */
    public function setIdModule($idModule)
    {
        $this->idModule = $idModule;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
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