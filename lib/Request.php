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
            $query = "SELECT * FROM request WHERE student_id = :student_id ORDER BY create_date";

            $this->db->query($query);

            $this->db->bind(':student_id', $_SESSION['student_id']);
        } else {
            $query = "SELECT * FROM request ORDER BY create_date";

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

    public function getRequestsBySearch($keyword, $search_by)
    {
        $query = "SELECT * FROM request";
        /**We add the filter later one by one */


        /**Search */
        switch ($search_by) {
            case 'student_id':
                $query = $query . " WHERE student_id = :keyword";
                break;
            case 'isbn':
                $query = $query . " WHERE isbn = :keyword";
                break;
        }

        $query = $query . " ORDER BY create_date";

        $this->db->query($query);

        /**Binding */
        $this->db->bind(':keyword', $keyword);

        //Get results
        try {
            $results = $this->db->resultSet();
        } catch (Exception $e) {
            die($e);
            $results = false;
        }

        return $results;
    }

    public function getSingleRequest($id)
    {
        $query = "SELECT * FROM request where id = :id";

        $this->db->query($query);

        $this->db->bind(':id', $id);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) {
            return false;
        }

        return $row;
    }

    public function deleteRequest($id)
    {
        $query = "DELETE FROM request WHERE id = :id";
        $this->db->query($query);

        $this->db->bind(':id', $id);

        //executing
        $success = $this->db->execute();

        if ($success) {
            return true; //Update successfull
        } else {
            return false; //something went wrong
        }
    }

    public function updateRequest($id)
    {
        $query = "UPDATE request 
        SET status = 'ready'  
        WHERE id = :id";
        $this->db->query($query);

        $this->db->bind(':id', $id);

        //executing
        $success = $this->db->execute();

        if ($success) {
            return true; //Update successfull
        } else {
            return false; //something went wrong
        }
    }
}
