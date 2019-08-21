<?php

class Record
{
    private $db; //handler

    //Connect to database and get handler
    public function __construct()
    {
        $this->db = new Database;
    }

    //Adding a new book
    public function addBook($data)
    {
        $this->db->query("SELECT * FROM book WHERE isbn = :isbn");
        $this->db->bind(':isbn', $data['isbn']);

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
            return 0; //book already exists
        } else {

            //preparing the statement
            $query = "INSERT INTO book (isbn, title, author, publisher, year_published, edition, category, popularity_last_year, popularity_last_month, popularity_total, inventory, leased, picture) 
            VALUES (:isbn, :title, :author, :publisher, :year_published, :edition, :category, :popularity_last_year, :popularity_last_month, :popularity_total, :inventory, :leased, :picture);";
            $this->db->query($query);

            //binding variables
            $this->db->bind(':isbn', $data['isbn']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':author', $data['author']);
            $this->db->bind(':publisher', $data['publisher']);
            $this->db->bind(':year_published', $data['year_published']);
            $this->db->bind(':edition', $data['edition']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':popularity_last_year', 0);
            $this->db->bind(':popularity_last_month', 0);
            $this->db->bind(':popularity_total', 0);
            $this->db->bind(':inventory', $data['inventory']);
            $this->db->bind(':leased', 0);
            $this->db->bind(':picture', $data['image']);

            //executing
            $success = $this->db->execute();
            if ($success) {
                return 1; //Book successfully added
            } else {
                return -1; //something went wrong
            }
        }
    }

    //Get all books by the filters and search
    public function getAllBooks($limit, $keyword, $search_by)
    {
        $query = "SELECT * FROM book";
        /**We add the filter later one by one */


        /**Search */
        if ($search_by != 'all' && $keyword != 'all') {
            switch ($search_by) {
                case 'title':
                    $query = $query . " WHERE MATCH (title) AGAINST (:keyword IN NATURAL LANGUAGE MODE)";
                    break;
                case 'author':
                    $query = $query . " WHERE MATCH (author) AGAINST (:keyword IN NATURAL LANGUAGE MODE)";
                    break;
                case 'publisher':
                    $query = $query . " WHERE MATCH (publisher) AGAINST (:keyword IN NATURAL LANGUAGE MODE)";
                    break;
                case 'isbn':
                    $query = $query . " WHERE isbn = :keyword";
                    break;
            }
        }

        $query = $query . " ORDER BY create_date DESC";

        /**The max number of rows we take from the database*/
        if (($limit > 0) && (gettype($limit) == 'integer')) {
            $query = $query . " LIMIT $limit";
        }

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

    //Get single book
    public function getSingleBook($isbn)
    {
        $this->db->query("SELECT * FROM book WHERE isbn = :isbn");
        $this->db->bind(':isbn', $isbn);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) {
            return false;
        }

        return $row;
    }

    //Update book
    public function updateBook($data)
    {
        if ($data['image'] === 0) {

            $query = "UPDATE book 
            SET isbn = :isbn, title = :title, author = :author, publisher = :publisher, 
            year_published = :year_published, edition = :edition, category = :category, 
            inventory = :inventory 
            WHERE isbn = :old_isbn";

            $this->db->query($query);

            //binding variables
            $this->db->bind(':isbn', $data['isbn']);
            $this->db->bind(':old_isbn', $data['old_isbn']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':author', $data['author']);
            $this->db->bind(':publisher', $data['publisher']);
            $this->db->bind(':year_published', $data['year_published']);
            $this->db->bind(':edition', $data['edition']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':inventory', $data['inventory']);
        } else {
            $query = "UPDATE book 
            SET isbn = :isbn, title = :title, author = :author, publisher = :publisher, 
            year_published = :year_published, edition = :edition, category = :category, 
            inventory = :inventory, picture = :picture 
            WHERE isbn = :old_isbn";

            $this->db->query($query);

            //binding variables
            $this->db->bind(':isbn', $data['isbn']);
            $this->db->bind(':old_isbn', $data['old_isbn']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':author', $data['author']);
            $this->db->bind(':publisher', $data['publisher']);
            $this->db->bind(':year_published', $data['year_published']);
            $this->db->bind(':edition', $data['edition']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':inventory', $data['inventory']);
            $this->db->bind(':picture', $data['image']);
        }


        //executing
        $success = $this->db->execute();

        if ($success) {
            return true; //Update successfull
        } else {
            return false; //something went wrong
        }
    }

    //Delete Book
    public function deleteBook($isbn)
    {
        $query = "DELETE FROM book WHERE isbn = :isbn";
        $this->db->query($query);

        $this->db->bind(':isbn', $isbn);

        //executing
        $success = $this->db->execute();

        if ($success) {
            return true; //Update successfull
        } else {
            return false; //something went wrong
        }
    }

    /**LEASING */

    //Add lease
    public function addLease($student_id, $isbn, $issue_date)
    {
        $query = "INSERT INTO leasing (isbn, student_id, admin_id, due_date) 
        VALUES(:isbn, :student_id, :admin_id, :due_date)";
        $this->db->query($query);

        $this->db->bind(':isbn', $isbn);
        $this->db->bind(':student_id', $student_id);
        $this->db->bind(':admin_id', $_SESSION['admin_id']);
        $this->db->bind(':due_date', date("Y-m-d", strtotime($issue_date)));


        //executing
        $success = $this->db->execute();

        if ($success) {
            return true; //Update successfull
        } else {
            return false; //something went wrong
        }
    }

    public function changeBookLease($isbn, $prevLeased, $calc)
    {
        $newLeased = (int) $prevLeased;

        if ($calc === "add") {
            $newLeased++;
        } else {
            $newLeased--;
        }

        $query = "UPDATE book 
        SET leased = $newLeased 
        WHERE isbn = :isbn";

        $this->db->query($query);

        $this->db->bind(':isbn', $isbn);

        //executing
        $success = $this->db->execute();

        if ($success) {
            return true; //Update successfull
        } else {
            return false; //something went wrong
        }
    }

    public function getLeases()
    {
        $query = "SELECT * FROM leasing";

        $this->db->query($query);

        //Get results
        try {
            $results = $this->db->resultSet();
        } catch (Exception $e) {
            die($e);
            $results = false;
        }

        return $results;
    }

    public function getSingleLease($id)
    {
        $this->db->query("SELECT * FROM leasing WHERE id = :id");
        $this->db->bind(':id', $id);

        try {
            $row = $this->db->single();
        } catch (PDOException $e) {
            return false;
        }

        return $row;
    }

    public function deleteLease($id)
    {
        $query = "DELETE FROM leasing WHERE id = :id";
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
