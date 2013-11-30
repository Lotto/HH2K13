<?php
use Imagine\Image\ImageInterface;
class homeController{
	
	function home(){


		$r = SPDO::getInstance()->prepare("SELECT * FROM  PHOTOS_MASTER");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute();
		$photosMaster = $r->fetchAll();
		print_r($photosMaster);
		


		//require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');
		//$imagine = new Imagine\Gd\Imagine();
		//$image = $imagine->open(WEBSITE_PATH.DS.'data'.DS.'master'.DS.'1.jpg');


		require_once("home.view.php");
	}
}
?>