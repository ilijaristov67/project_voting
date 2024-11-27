<?php

class Employee
{
    private $connection;
    private $firstName;
    private $lastName;
    private $email;
    private $password;

    public function __construct($connection, $firstName, $lastName, $email, $password)
    {
        $this->setConnection($connection);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function saveUser()
    {
        $connection = $this->getConnection();
        $firstName = $this->getFirstName();
        $lastName = $this->getLastName();
        $email = $this->getEmail();
        $passwordHashed = password_hash($this->getPassword(), PASSWORD_BCRYPT);
        $sql = 'INSERT INTO employees (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :password)';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
        $stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordHashed, PDO::PARAM_STR);
        $user = $stmt->execute();
        return $user;
    }

    public function getUser()
    {
        $connection = $this->getConnection();
        $email = $this->getEmail();
        $sql = "SELECT * FROM employees WHERE email = :email";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function authenticateUser()
    {
        $connection = $this->getConnection();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $sql = "SELECT * FROM employees WHERE email = :email";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($user) && password_verify($password, $user['password'])) {
            return $user;
        }
        return;
    }

    /**
     * Get the value of connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set the value of connection
     *
     * @return  self
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

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
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
