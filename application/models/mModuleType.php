<?php


class mModuleType
{
    private $id;
    private $name;
    private $idUsageUnit;

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
    public function getIdUsageUnit()
    {
        return $this->idUsageUnit;
    }

    /**
     * @param mixed $idUsageUnit
     */
    public function setIdUsageUnit($idUsageUnit)
    {
        $this->idUsageUnit = $idUsageUnit;
    }


}