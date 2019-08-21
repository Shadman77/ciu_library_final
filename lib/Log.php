<?php

class Log
{
    private $db; //handler

    //Connect to database and get handler
    public function __construct()
    {
        $this->db = new Database;
    }

    public function addLog($action, $student_id, $admin_id)
    {
        $query = "INSERT INTO log (action, student_id, admin_id) 
        VALUES (:action, :student_id, :admin_id)";

        $this->db->query($query);

        $this->db->bind(':action', $action);
        $this->db->bind(':student_id', $student_id);
        $this->db->bind(':admin_id', $admin_id);

        //executing
        $success = $this->db->execute();
        if ($success) {
            return true; //Book successfully added
        } else {
            return false; //something went wrong
        }
    }
}
