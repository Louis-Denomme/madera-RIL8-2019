<?php


class mMeasureType
{
    private $id;
    private $name;
    private $idMeasureUnit;

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
    public function getIdMeasureUnit()
    {
        return $this->idMeasureUnit;
    }

    /**
     * @param mixed $idMeasureUnit
     */
    public function setIdMeasureUnit($idMeasureUnit)
    {
        $this->idMeasureUnit = $idMeasureUnit;
    }



}