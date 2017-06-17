<?php

namespace Pokemon\Entity;

class Location {
    protected $id_location;
    protected $longitude;
    protected $latitude;
    protected $id_pokemon;
    protected $date_created;

    /**
     * Get the value of Id Location
     *
     * @return mixed
     */
    public function getIdLocation()
    {
        return $this->id_location;
    }

    /**
     * Set the value of Id Location
     *
     * @param mixed id_location
     *
     * @return self
     */
    public function setIdLocation($id_location)
    {
        $this->id_location = $id_location;

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

    public function getPosition(){
      return ["latitutde"=>$this->latitude,"longitude"=>$this->longitude];
    }

}
