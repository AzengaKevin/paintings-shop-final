<?php namespace App\Core;

class Database{

    private $dbhost = \DB_SERVER;
    private $dbuser = \DB_USER;
    private $dbpass = \DB_PASS;
    private $dbname = \DB_NAME;

    private ?\PDO $pdo = null;
    private ?\PDOException $error = null;
    private ?\PDOStatement $stmt = null;

    private static ?Database $_instance = null;

    /**
     * Initialize a sing Database instance
     */
    public static function init() : Database
    {
        if(is_null(self::$_instance) || empty(self::$_instance)){
            self::$_instance = new self();
        }

        return self::$_instance;

    }

    function __construct()
    {
       $dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname . ';charset=utf8';

       $options = array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ 
       );

       try {
           if (is_null($this->pdo) || empty($this->pdo)) {
               $this->pdo = new \PDO($dsn, $this->dbuser, $this->dbpass, $options);
           }
       } catch (\PDOException $e) {
           $this->error = $e->getMessage();
       }

    }

    /**
     * Prepares a query and sets the internal stmt property
     * 
     * @param string query to compile
     */
    public function prepare($query)
    {
        $this->stmt = $this->pdo->prepare($query);
    }

    /**
     * Binds parameters for the compiled query
     * 
     * @param $param query parameter
     * @param $value value for the query parameter
     * @param $type the of the $value for the parameter
     */
    public function bind($param, $value, $type = NULL)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;

                default:
                    $type = \PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindParam($param, $value, $type);

    }
   
    /**
     * Excecutes internal PDOStatement
     * 
     * @return bool of whether the execution was successful
     */
   public function execute()
   {
       return $this->stmt->execute();
   }

   /**
    * Executes the internal statement and gets multiple results for the query
    *
    * @return array of the results
    */
   public function resultSet()
   {
       $this->execute();

       return $this->stmt->fetchAll();
   }

   /**
    * Executes the internal statement and gets single result for the query
    *
    * @return object of the result
    */   
   public function single()
   {
       $this->execute();

       return $this->stmt->fetch();
   }

   /**
    * Counts the number of items in the result
    * 
    * @return int number of items in result
    */
   public function rowCount()
   {
       return $this->stmt->rowCount();
   }

   /**
    * Gets the database last inserted id
    *
    * @return int last inserted id
    */
   public function lastInsertId()
   {
       return $this->pdo->lastInsertId();
   }

   /**
    * Begins a database transaction
    */
   public function beginTransacton()
   {
       $this->pdo->beginTransaction();
   }

   /**
    * Commits pending transaction
    */
   public function commit()
   {
       $this->pdo->commit();
   }

   /**
    * Gets any available errors
    * @return string
    */
   public function getErrorMessage()
   {
       if(!is_null($this->error)){
           return $this->error->getMessage();
       }
   }
}