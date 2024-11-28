<?php

class Category
{
    private $connection;
    private $category;

    public function __construct($connection, $category)
    {
        $this->setConnection($connection);
        $this->setCategory($category);
    }

    public function getAllCategories()
    {
        $connection = $this->getConnection();
        $sql = "SELECT * FROM categories";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
}
