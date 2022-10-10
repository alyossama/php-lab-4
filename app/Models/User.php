<?php

require_once __DIR__ . "\../Database/DatabaseConnections.php";

class User extends DatabaseConnection
{
    private $id;
    private $name;
    private $email;
    private $gender;
    private $email_status;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of email_status
     */
    public function getEmail_status()
    {
        return $this->email_status;
    }

    /**
     * Set the value of email_status
     *
     * @return  self
     */
    public function setEmail_status($email_status)
    {
        $this->email_status = $email_status;

        return $this;
    }


    //Create
    public function create()
    {
        $query = "INSERT INTO `users` (name,email,gender,mail_status)
                     VALUES
                     ('$this->name','$this->email','$this->gender','$this->email_status')";
        return $this->runDML($query);
    }







    //Read
    public function read()
    {
        $query = "SELECT * FROM `users`";
        return $this->runDQL($query);
    }

    // Get by ID

    public function getById()
    {
        $query = "SELECT * FROM users where id = '$this->id'";
        return $this->runDQL($query);
    }



    //Update
    public function update()
    {
        $query = "UPDATE users 
    SET name = '$this->name', email = '$this->email', gender = '$this->gender', mail_status = '$this->email_status'
    WHERE id = '$this->id'";
        return $this->runDML($query);
    }


    //Delete
    public function delete()
    {
        $query = "DELETE FROM `users` WHERE id = '$this->id'";
        return $this->runDML($query);
    }



    // Check if email exists in database
    public function emailExists()
    {
        $query = "SELECT * FROM `users` WHERE `users`.`email` = '$this->email'";
        return $this->runDQL($query);
    }

    // Check if email exists in database for certain id
    public function emailExistsForSpecificId()
    {
        $query = "SELECT * FROM users WHERE users.email = '$this->email' AND users.id = '$this->id'";
        return $this->runDQL($query);
    }
}
