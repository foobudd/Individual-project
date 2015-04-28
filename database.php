<?php
// filename: database.php, Jory Lord, cis355, 2015-02-26
// creates connection to the database.

// ----- Connect to database -----
class Database 
{
	private static $dbName = 'CIS355jblord' ; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'CIS355jblord';
	private static $dbUserPassword = 'jblord491310';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>