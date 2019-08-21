<?php

class Request
{
    private $db; //handler

    //Connect to database and get handler
    public function __construct()
    {
        $this->db = new Database;
    }

    public function addRequest($isbn)
    {
        $query = "INSERT INTO request (student_id, isbn, status) 
        VALUES (:student_id, :isbn, 'pending')";

        $this->db->query($query);

        $this->db->bind(':student_id', $_SESSION['student_id']);
        $this->db->bind(':isbn', $isbn);

        //executing
        if ($this->db->execute()) {
            return 1; //Sign up successfull
        } else {
            return -1; //something went wrong
        }
    }

    public function getRequests()
    {
        if (isset($_SESSION['student_id'])) {
            $query = "SELECT * FROM request WHERE student_id = :student_id ORDER BY create_date DESC";

            $this->db->query($query);

            $this->db->bind(':student_id', $_SESSION['student_id']);
        } else {
            $query = "SELECT * FROM request ORDER BY create_date DESC";

            $this->db->query($query);
        }

        //Get results
        try {
            $results = $this->db->resultSet();
        } catch (Exception $e) {
            die($e);
            $results = false;
        }

        return $results;
    }
}
