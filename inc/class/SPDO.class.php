<?php
class SPDO{
	private $PDOInstance = NULL;
	private static $instance = NULL;
	
	public function __construct(){
		$this->PDOInstance = new PDO('mysql:host='.DATABASE_HOST.';dbname='.DATABASE_NAME, DATABASE_LOGIN, DATABASE_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	
	public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new SPDO();
		}
		
		return self::$instance;
	}
	
	public function prepare($query){
		return $this->PDOInstance->prepare($query);
	}
	
	public function lastInsertId(){
		return $this->PDOInstance->lastInsertId();
	}
}
?>
