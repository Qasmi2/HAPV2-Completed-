<?php

//Class DbConnect
class DbConnect
{
    //Variable to store database link
    private $host = "localhost";
    private $db_name = "protalv2";
    private $username = "root";
    private $password = "";
    
    private $con;

    //Class constructor
    function __construct()
    {

    }

    //This method will connect to the database
    function connect()
    {
        $this->con = null;    
        try
		{
            $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->con;
    }

}