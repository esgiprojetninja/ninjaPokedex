<?php

namespace Pokemon\Entity;

class Type {
    protected $id_type;
    protected $name_type;
    protected $color;

    /**
     * Get the value of Id Type
     *
     * @return mixed
     */
    public function getIdType()
    {
        return $this->id_type;
    }

    /**
     * Set the value of Id Type
     *
     * @param mixed id_type
     *
     * @return self
     */
    public function setIdType($id_type)
    {
        $this->id_type = $id_type;

        return $this;
    }

    /**
     * Get the value of Name Type
     *
     * @return mixed
     */
    public function getNameType()
    {
        return $this->name_type;
    }

    /**
     * Set the value of Name Type
     *
     * @param mixed name_type
     *
     * @return self
     */
    public function setNameType($name_type)
    {
        $this->name_type = $name_type;

        return $this;
    }

    /**
     * Get the value of Color
     *
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of Color
     *
     * @param mixed color
     *
     * @return self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

}
