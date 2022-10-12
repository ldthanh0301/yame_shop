<?php 
define('DB_HOST', 'localhost');
define('DB_NAME', 'yame_shop');
define('DB_USER','root');
define('DB_PASSWORD','');

class Database {
    private static $instance=null;
    public $connectDB;

    function __construct()
    {   
        $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        // Check connection
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }
        $this->connectDB = $mysqli;
    }
    public static function getInstance() {
        if ( self::$instance ==null) {
            self::$instance = new self();
        }
        return self::$instance ;
    }
}

