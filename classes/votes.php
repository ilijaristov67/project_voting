<?php

class Vote
{

    private $connection;
    private $voter_id;
    private $nominee_id;
    private $category_id;
    private $comment;

    public function __construct($connection, $voter_id, $nominee_id, $category_id, $comment)
    {
        $this->setConnection($connection);
        $this->setVoter_id($voter_id);
        $this->setNominee_id($nominee_id);
        $this->setCategory_id($category_id);
        $this->setComment($comment);
    }

    public function saveVote()
    {

        $connection = $this->getConnection();

        $voterId = $this->getVoter_id();
        $nomineeId = $this->getNominee_id();
        $categoryId = $this->getCategory_id();
        $comment = $this->getComment();
        $sql = 'INSERT INTO votes (voter_id, nominee_id, category_id, comment, timestamp) 
                VALUES (:voter_id, :nominee_id, :category_id, :comment, CURRENT_TIMESTAMP)';

        $stmt = $connection->prepare($sql);

        $stmt->bindParam(":voter_id", $voterId, PDO::PARAM_INT);
        $stmt->bindParam(":nominee_id", $nomineeId, PDO::PARAM_INT);
        $stmt->bindParam(":category_id", $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);

        $voteSaved = $stmt->execute();

        return $voteSaved;
    }

    function getTopVoter()
    {

        $connection = $this->getConnection();
        $sql = "
            SELECT e.first_name, e.last_name, COUNT(v.voter_id) AS vote_count
            FROM votes v
            JOIN employees e ON v.voter_id = e.id
            GROUP BY v.voter_id
            ORDER BY vote_count DESC
            LIMIT 3
        ";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);;
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
     * Get the value of voter_id
     */
    public function getVoter_id()
    {
        return $this->voter_id;
    }

    /**
     * Set the value of voter_id
     *
     * @return  self
     */
    public function setVoter_id($voter_id)
    {
        $this->voter_id = $voter_id;

        return $this;
    }

    /**
     * Get the value of nominee_id
     */
    public function getNominee_id()
    {
        return $this->nominee_id;
    }

    /**
     * Set the value of nominee_id
     *
     * @return  self
     */
    public function setNominee_id($nominee_id)
    {
        $this->nominee_id = $nominee_id;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }
}
