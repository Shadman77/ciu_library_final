<?php

class Account
{
    private $db; //handler

    //Connect to database and get handler
    public function __construct()
    {
        $this->db = new Database;
    }

    /**Create user table */
    public function createUserTable()
    {
        $query = 'CREATE TABLE user 
        ( id INT(11) NOT NULL , 
        firstname VARCHAR(255) NOT NULL , 
        lastname VARCHAR(255) NOT NULL , 
        password VARCHAR(255) NOT NULL , 
        cell_no VARCHAR(12) NOT NULL , 
        email VARCHAR(255) NOT NULL , 
        PRIMARY KEY (ID))';

        $this->db->query($query);
        $this->db->execute();
    }

    //Sign In
    public function signIn($id, $password)
    {
        $this->db->query("SELECT * FROM student WHERE id = :id");
        $this->db->bind(':id', $id);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) {
            if ($e->getCode() === '42S02') {
                /**If the table does not exist then we create a new table*/
                $this->createUserTable();
                return false; //since the table is just created the user does not exist
            }
        }

        if ($row) { //if user is found
            if($row->status != 'active'){
                return false;
            }

            $passwordCheck = password_verify($password, $row->password); //matching password

            if ($passwordCheck) { //if password is correct
                return true;
            } else { //if password is incorrect
                return false;
            }
        } else { //if user is not found
            return false;
        }
    }

    //Admin sign In
    public function adminSignIn($id, $password)
    {
        $this->db->query("SELECT * FROM admin WHERE id = :id");
        $this->db->bind(':id', $id);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) {
            //if something goes wrong with the query
            return false;
        }

        if ($row) { //if user is found

            //Check if the admin is active
            if ($row->status == 'pending') {
                return false;
            }

            $passwordCheck = password_verify($password, $row->password); //matching password

            if ($passwordCheck) { //if password is correct
                return true;
            } else { //if password is incorrect
                return false;
            }
        } else { //if user is not found
            return false;
        }
    }

    //Sign Up
    public function signUp($data)
    {
        $this->db->query("SELECT * FROM student WHERE id = :id");
        $this->db->bind(':id', $data['id']);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) {
            if ($e->getCode() === '42S02') {
                /**If the table does not exist then we create a new table*/
                //createUserTable();//Not sure if this is save
                die("Table is not found");
            }
            //die($e->getMessage());
        }

        if ($row) {
            return 0; //user exists
        } else {

            //Hashing the password
            $options = [
                'cost' => 10, //computation cost, more the better but slower +1 = twice the time and difficulty
            ];
            //This is suppose to be the recommended soln
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, $options);

            //preparing the statement
            $query = "INSERT INTO student (id, name, password, status, cell, email, department, school, credit_system, picture, last_issuer_id) 
            VALUES (:id, :name, :password, :status, :cell, :email, :department, :school, :credit_system, :picture, :last_issuer_id);";
            $this->db->query($query);

            //binding variables
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':status', 'pending');
            $this->db->bind(':cell', $data['cell_no']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':department', $data['department']);
            $this->db->bind(':school', $data['school']);
            $this->db->bind(':credit_system', $data['credit_system']);
            $this->db->bind(':picture', $data['image']);
            $this->db->bind(':last_issuer_id', 'none');


            //executing
            $success = $this->db->execute();
            if ($success) {
                return 1; //Sign up successfull
            } else {
                return -1; //something went wrong
            }
        }
    }

    //Admin Sign Up
    public function adminSignUp($data)
    {
        $this->db->query("SELECT * FROM admin WHERE id = :id");
        $this->db->bind(':id', $data['id']);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) {
            if ($e->getCode() === '42S02') {
                /**If the table does not exist then we create a new table*/
                //createUserTable();//Not sure if this is save
                die("Table is not found");
            }
            //die($e->getMessage());
        }

        if ($row) {
            return 0; //user exists
        } else {

            //Hashing the password
            $options = [
                'cost' => 10, //computation cost, more the better but slower +1 = twice the time and difficulty
            ];
            //This is suppose to be the recommended soln
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, $options);

            //preparing the statement
            $query = "INSERT INTO admin (id, name, password, status, cell, email, picture, issuer_admin_id) 
            VALUES (:id, :name, :password, :status, :cell, :email, :picture, :issuer_admin_id);";
            $this->db->query($query);

            //binding variables
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':status', 'pending');
            $this->db->bind(':cell', $data['cell_no']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':picture', $data['image']);
            $this->db->bind(':issuer_admin_id', 'none');


            //executing
            $success = $this->db->execute();
            if ($success) {
                return 1; //Sign up successfull
            } else {
                return -1; //something went wrong
            }
        }
    }

    //Get Students
    public function getStudentAccounts($status)
    {
        /**if status is all then we do not filter by status and use a different query */
        if ($status == 'all') {
            $query = "SELECT * FROM student ORDER BY renew_date DESC;";
            $this->db->query($query);
        } else {
            $query = "SELECT * FROM student WHERE status = :status ORDER BY renew_date DESC;";
            $this->db->query($query);
            $this->db->bind(':status', $status);
        }

        //Get results
        try {
            $results = $this->db->resultSet();
        } catch (Exception $e) {
            $results = false;
        }

        return $results;
    }

    //Get single student account
    public function getStudentAccount($id)
    {
        $this->db->query("SELECT * FROM student WHERE id = :id");
        $this->db->bind(':id', $id);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) {
            return false;
        }

        return $row;
    }

    //Update Student Account
    public function updateStudentAccount($data)
    {
        if ($data['image'] === 0) {

            $query = "UPDATE student 
            SET id = :id, name = :name, status = :status, 
            cell = :cell, email = :email, department = :department, 
            school = :school, credit_system = :credit_system, 
            renew_date = now(), valid_till = :valid_till, 
            last_issuer_id = :last_issuer_id 
            WHERE id = :old_id";

            $this->db->query($query);

            //binding variables
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':old_id', $data['old_id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':cell', $data['cell_no']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':department', $data['department']);
            $this->db->bind(':school', $data['school']);
            $this->db->bind(':credit_system', $data['credit_system']);
            $this->db->bind(':valid_till', date("Y-m-d", strtotime($_POST['valid_till'])));
            $this->db->bind(':last_issuer_id', $data['last_issuer_id']);
        } else {
            $query = "UPDATE student 
            SET id = :id, name = :name, status = :status, 
            cell = :cell, email = :email, department = :department, 
            school = :school, credit_system = :credit_system, 
            renew_date = now(), picture = :picture, valid_till = :valid_till, 
            last_issuer_id = :last_issuer_id 
            WHERE id = :old_id";

            $this->db->query($query);

            //binding variables
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':old_id', $data['old_id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':cell', $data['cell_no']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':department', $data['department']);
            $this->db->bind(':school', $data['school']);
            $this->db->bind(':credit_system', $data['credit_system']);
            $this->db->bind(':picture', $data['image']);
            $this->db->bind(':valid_till', date("Y-m-d", strtotime($_POST['valid_till'])));
            $this->db->bind(':last_issuer_id', $data['last_issuer_id']);
        }


        //executing
        $success = $this->db->execute();

        if ($success) {
            return true; //Update successfull
        } else {
            return false; //something went wrong
        }
    }

    //Delete Student Account
    public function deleteStudentAccount($id)
    {
        $query = "DELETE FROM student WHERE id = :id";
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

    //Get Admins
    public function getAdminAccounts($status)
    {
        /**if status is all then we do not filter by status and use a different query */
        if ($status == 'all') {
            $query = "SELECT * FROM admin ORDER BY create_date DESC;";
            $this->db->query($query);
        } else {
            $query = "SELECT * FROM admin WHERE status = :status ORDER BY create_date DESC;";
            $this->db->query($query);
            $this->db->bind(':status', $status);
        }

        //Get results
        try {
            $results = $this->db->resultSet();
        } catch (Exception $e) {
            $results = false;
        }

        return $results;
    }

    //Get single admin account
    public function getAdminAccount($id)
    {
        $this->db->query("SELECT * FROM admin WHERE id = :id");
        $this->db->bind(':id', $id);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) { }

        return $row;
    }

    //Update Admin Account
    public function updateAdminAccount($data)
    {
        if ($data['image'] == 0) {

            $query = "UPDATE admin 
            SET id = :id, name = :name, status = :status, 
            cell = :cell, email = :email,  
            issuer_admin_id = :issuer_admin_id 
            WHERE id = :old_id";

            $this->db->query($query);

            //binding variables
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':old_id', $data['old_id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':cell', $data['cell_no']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':issuer_admin_id', $data['issuer_admin_id']);
        }


        //executing
        $success = $this->db->execute();

        if ($success) {
            return true; //Update successfull
        } else {
            return false; //something went wrong
        }
    }

    //Delete Student Account
    public function deleteAdminAccount($id)
    {
        $query = "DELETE FROM admin WHERE id = :id";
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
