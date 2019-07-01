<?php

class myDatabase
{
	public $isConn;
	protected $datab;
	
	public function __construct($username = "root", $password = "", $host="localhost", $dbname="myphpproject",$options=[])
	{
		$this->isConn=TRUE;
		try
		{
			$this->datab=new PDO("mysql:host={$host};dbname={$dbname},charset=utf8",$username,$password,$options);
			$this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		}
		catch (PDOException $e)
		{
			//throw new  Exсeption($e->getMessage());
		}
	}
	
	public function Disconnect()
	{
		$this->datab=NULL;
		$this->isConn=FALSE;
	}
	
	public function getRow($query,$params=[])
	{
		try
		{
			$stmt=$this->datab->prepare($query);
			$stmt->execute($params);
			return $stmt->fetch();
		}
		catch(PDOException $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	public function getRows($query,$params=[])
	{
		try
		{
			$stmt=$this->datab->prepare($query);
			$stmt->execute($params);
			return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	public function insertRow($query,$params=[])
	{
		try
		{
			$stmt=$this->datab->prepare($query);
			$stmt->execute($params);
			return TRUE;
		}
		catch(PDOException $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	public function updateRow($query,$params=[])
	{
		$this->insertRow($query,$params);
	}
	
	public function deliteRow($query,$params=[])
	{
		$this->insertRow($query,$params);
	}
}



class Database {
  
  	
    protected static $_pdo;

    public static function get_pdo()
    {
        if (empty(static::$_pdo))
        {
           $dsn =  'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHAR;
    		$opt = 
			[
        				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        				PDO::ATTR_EMULATE_PREPARES   => false,
   			];
  
         				static::$_pdo = new PDO($dsn, DB_USER, DB_PASS, $opt);;
        }

        return static::$_pdo;
    }

}