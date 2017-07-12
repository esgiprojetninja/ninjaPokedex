<?php
namespace Pokemon\Entity;

class Admin {
    protected $id;
    protected $login;
    protected $password;
    protected $status;
    protected $date_created;
    protected $pwd_reset_token;
    protected $pwd_reset_token_creation_date;

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
     * Get the value of Login
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of Login
     *
     * @param mixed login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of Status
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of Status
     *
     * @param mixed status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * Get the value of Pwd Reset Token
     *
     * @return mixed
     */
    public function getPwdResetToken()
    {
        return $this->pwd_reset_token;
    }

    /**
     * Set the value of Pwd Reset Token
     *
     * @param mixed pwd_reset_token
     *
     * @return self
     */
    public function setPwdResetToken($pwd_reset_token)
    {
        $this->pwd_reset_token = $pwd_reset_token;

        return $this;
    }

    /**
     * Get the value of Pwd Reset Token Creation Date
     *
     * @return mixed
     */
    public function getPwdResetTokenCreationDate()
    {
        return $this->pwd_reset_token_creation_date;
    }

    /**
     * Set the value of Pwd Reset Token Creation Date
     *
     * @param mixed pwd_reset_token_creation_date
     *
     * @return self
     */
    public function setPwdResetTokenCreationDate($pwd_reset_token_creation_date)
    {
        $this->pwd_reset_token_creation_date = $pwd_reset_token_creation_date;

        return $this;
    }

}
