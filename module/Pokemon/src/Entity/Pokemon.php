<?php

namespace Pokemon\Entity;

class Pokemon {
    protected $id_pokemon;
    protected $name;
    protected $description;
    protected $id_parent;
    protected $image;
    protected $id_national;
    protected $type1;
    protected $type2;
    protected $parent;
    protected $evolutions;


    /**
     * Get the value of Id Pokemon
     *
     * @return mixed
     */
    public function getIdPokemon()
    {
        return $this->id_pokemon;
    }

    /**
     * Set the value of Id Pokemon
     *
     * @param mixed id_pokemon
     *
     * @return self
     */
    public function setIdPokemon($id_pokemon)
    {
        $this->id_pokemon = $id_pokemon;

        return $this;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of Id Parent
     *
     * @return mixed
     */
    public function getIdParent()
    {
        return $this->id_parent;
    }

    /**
     * Set the value of Id Parent
     *
     * @param mixed id_parent
     *
     * @return self
     */
    public function setIdParent($id_parent)
    {
        $this->id_parent = $id_parent;

        return $this;
    }

    /**
     * Get the value of Image
     *
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of Image
     *
     * @param mixed image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of Id National
     *
     * @return mixed
     */
    public function getIdNational()
    {
        return $this->id_national;
    }

    /**
     * Set the value of Id National
     *
     * @param mixed id_national
     *
     * @return self
     */
    public function setIdNational($id_national)
    {
        $this->id_national = $id_national;

        return $this;
    }


    /**
     * Get the value of Type
     *
     * @return mixed
     */
    public function getType1()
    {
        return $this->type1;
    }

    /**
     * Set the value of Type
     *
     * @param mixed type1
     *
     * @return self
     */
    public function setType1($type1)
    {
        $this->type1 = $type1;

        return $this;
    }

    /**
     * Get the value of Type
     *
     * @return mixed
     */
    public function getType2()
    {
        return $this->type2;
    }

    /**
     * Set the value of Type
     *
     * @param mixed type2
     *
     * @return self
     */
    public function setType2($type2)
    {
        $this->type2 = $type2;

        return $this;
    }


    /**
     * Get the value of Parent
     *
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the value of Parent
     *
     * @param mixed parent
     *
     * @return self
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get the value of Evolution
     *
     * @return mixed
     */
    public function getEvolutions()
    {
        return $this->evolutions;
    }

    /**
     * Set the value of Evolution
     *
     * @param mixed evolutions
     *
     * @return self
     */
    public function setEvolutions($evolutions)
    {
        $this->evolutions = $evolutions;

        return $this;
    }

}
