<?php
class Database
{
    //getting the constants from the config.php
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    //properties
    private $dbHandler;
    private $error;
    private $statement;

    //Constructor
    public function __construct()
    {
        //set dsn
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        //set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //PDO Instance
        try {
            $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            die($this->error);
        }
    }

    //Methods
    public function query($query)
    {
        $this->statement = $this->dbHandler->prepare($query);
    }

    public function bind($param, $value, $type = NULL)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                case is_null($value):
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type); 
    }

    public function execute(){
        return $this->statement->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }
}
