<?php
/* Here, we create the pdo class
* Connect to the db
* bind the values and return rows and results
*/

class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $db_handler;
    private $statement;
    private $error;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // A GOOD WAY TO HANDLE ERROR
        ];

        // CREATE A NEW PDO INSTANCE
        try{
            $this->db_handler = new PDO($dsn, $this->user, $this->pass, $options);
        }catch(PDOException $err){
            $this->error = $err->getMessage();
            echo $this->error;
        }
    }

    // prepar statement with query
    public function query($sql){
        $this->statement = $this->db_handler->prepare($sql);
    }
    // Now, we need a function to bind the value
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
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

        $this->statement->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute(){
        return $this->statement->execute();
    }

    // Get all result set as array of object
    public function resultArray(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }
    // get a single row as object
    public function singleRow(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // get the row count
    public function rowCount(){
        return $this->statement->rowCount();
    }
}