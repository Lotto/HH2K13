<?php
class homeController{

	public $params = array();
	
	function home(){

		$r = SPDO::getInstance()->prepare("
			SELECT P.ID_MASTER AS MASTER_ID, VP.ID AS VALID_ID 
			FROM VALID_PROJECTS VP
			LEFT JOIN PROJECTS P ON P.ID=VP.ID_PROJECT
			ORDER BY VP.ID DESC");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute();
		$finalPhotos = $r->fetchAll();
		
		require_once("home.view.php");
	}

}
?>