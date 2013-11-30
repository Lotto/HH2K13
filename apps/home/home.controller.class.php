<?php
class homeController{
	
	function home(){
		$r = SPDO::getInstance()->prepare("SELECT * FROM  `items` LIMIT 0 , 30");
		$r->setFetchMode(PDO::FETCH_ASSOC);
		$r->execute();
		$tmp = $r->fetch();
		print_r($tmp);


		require_once("home.view.php");
	}
}
?>