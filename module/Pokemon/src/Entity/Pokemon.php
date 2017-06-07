<?php
namespace Pokemon\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Pokemon\Entity\Location;
use Pokemon\Entity\Type;
use Zend\Form\Annotation\Object;


/**
 * Class Pokemon
 * @package Pokedex\Entity
 *
 * @ORM\Entity
 * @ORM\Table("pokemon")
 * @ORM\Entity(repositoryClass="Pokedex\Repository\PokemonRepository")
 */
 class Pokemon {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;
    /**
     * @ORM\Column(name="name")
     */
    protected $name;
    /**
     * @ORM\Column(name="description")
     */
    protected $description;
    /**
     * @ORM\Column(name="image")
     */
    protected $image;
    /**
     * @ORM\Column(name="parent")
     */
    protected $parent;
    /**
     * @ORM\OneToMany(targetEntity="\Application\Entity\Location", mappedBy="pokemon")
     * @ORM\JoinColumn(name="id", referencedColumnName="pokemon_id")
    */
    protected $locations;
    /**
     * @ORM\ManyToMany(targetEntity="\Application\Entity\Type", inversedBy="pokemons")
     * @ORM\JoinTable(name="pokemon_tag",
     *      joinColumns={@ORM\JoinColumn(name="pokemon_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="type_id", referencedColumnName="id")}
     *      )
    */
    protected $types;

    /**
    * Constructor.
   */
    public function __construct() {
        $this->locations = new ArrayCollection();
        $this->types = new ArrayCollection();
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
     * Get the value of Location
     *
     * @return mixed
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Adds a new location to this pokemon
     *
     * @param mixed location
     *
     * @return self
     */
    public function addLocation($location)
    {
        $this->locations[] = $location;

        return $this;
    }

    // Returns types for this pokemon.
    public function getTypes()
    {
        return $this->types;
    }

    // Adds a new tag to this pokemon.
    public function addType($type)
    {
        $this->types[] = $type;
    }

    // Removes association between this pokemon and the given type.
    public function removeTypeAssociation($type)
    {
        $this->types->removeElement($type);
    }

}
