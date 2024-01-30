<?php

use Dotenv\Dotenv;

$dot_env = Dotenv::createImmutable(dirname(__DIR__));
$dot_env->load();

class Database
{
    //connection properties
    private $host;
    private $user;
    private $password;
    private $database;

    //database connection handler
    private $dbh;

    //error handler
    private $error;

    //statement handler
    private $stmt;
    //open connection
    public function __construct()
    {
        $this->host = $_ENV["DB_HOST"];
        $this->database = $_ENV["DB_NAME"];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $dsn = "mysql:host=".$this->host.";dbname=".$this->database;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //try to establish a connection
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        }catch (PDOException $err){
            $this->error = $err->getMessage();
        }
    }

    //write query helper functions using the stmt property
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }
    //creating the bind function
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch (true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    //function to execute
    public function execute(){
        return $this->stmt->execute();
    }
    //create a function that will check if the statement was successfully executed
    public function confirm_result(){
        return $this->stmt->lastInsertId;
    }
    //command to fetch data in a result set inn associative array
    public function fetchMultiple(){
        //execute before fetching
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //command count fetch data in a single set.
    public function fetchSingle(){
        //execute before fetching
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Command fetches the total number of records in a column

    public function fetchColumn(){
        $this->execute();
        return $this->stmt->fetchColumn();
    }

    public function rowCount(){
        $this->execute();
        return $this->stmt->rowCount();
    }

    public function lastInserted(){
        $this->execute();
        return $this->stmt->lastInsertId();
    }

}

