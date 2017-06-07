<?php

namespace Pokemon\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Pokemon\Entity\Pokemon;
use Zend\Form\Annotation\Object;

/**
 * Class Pokemon
 * @package Pokedex\Entity
 *
 * @ORM\Entity
 * @ORM\Table("location")
 * @ORM\Entity(repositoryClass="Pokedex\Repository\LocationRepository")
 */
class Location {
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
    */
    protected $id;
    /**
     * @ORM\Column(name="longitude")
    */
    protected $longitude;
    /**
     * @ORM\Column(name="latitude")
    */
    protected $latitude;
    /**
     * @ORM\Column(name="date_created")
    */
    protected $date_created;
    /**
     * @ORM\ManyToOne(targetEntity="\Application\Entity\Pokemon", inversedBy="locations")
     * @ORM\JoinColumn(name="pokemon_id", referencedColumnName="id")
    */
    protected $pokemon;


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
     * Get the value of Longitude
     *
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the value of Longitude
     *
     * @param mixed longitude
     *
     * @return self
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get the value of Latitude
     *
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the value of Latitude
     *
     * @param mixed latitude
     *
     * @return self
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get the value of Date Created
     *
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Set the value of Date Created
     *
     * @param mixed date_created
     *
     * @return self
     */
    public function setDateCreated($date_created)
    {
        $this->date_created = $date_created;

        return $this;
    }

    /**
     * Returns associated pokemon.
     * @return \Application\Entity\Pokemon
    */
    public function getPokemon()
    {
        return $this->pokemon;
    }

    /**
     * Sets associated pokemon.
     * @param \Application\Entity\Pokemon $pokemon
    */
    public function setPokemon($pokemon)
    {
        $this->pokemon = $pokemon;
        $pokemon->addComment($this);
    }

}
