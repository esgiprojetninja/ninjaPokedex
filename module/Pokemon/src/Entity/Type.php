<?php

namespace Pokemon\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation\Object;


/**
 * Class Pokemon
 * @package Pokedex\Entity
 *
 * @ORM\Entity
 * @ORM\Table("type")
 */
class Type {
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
    */
    protected $id;
    /**
     * @ORM\Column(name="name")
    */
    protected $name;
    /**
     * @ORM\ManyToMany(targetEntity="\Application\Entity\Pokemon", mappedBy="types")
    */
    protected $pokemons;

    // Constructor.
    public function __construct()
    {
        $this->pokemons = new ArrayCollection();
    }

    // Returns pokemons associated with this type.
    public function getPokemons()
    {
        return $this->pokemons;
    }

    // Adds a pokemon into collection of pokemons related to this type.
    public function addPokemon($pokemon)
    {
        $this->pokemons[] = $pokemon;
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

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

}
