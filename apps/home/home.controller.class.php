<?php
class homeController{

	public $params = array();
	
	function home(){

		$r = SPDO::getInstance()->prepare("SELECT * FROM  PHOTOS_MASTER");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute();
		$photosMaster = $r->fetchAll();
		
		require_once("home.view.php");
	}

    function download() {
        $type = $this->params[0];
        $id = $this->params[1];
        $path = WEBSITE_LINK . "data/" . $type . "/" . $id . ".jpg";
        require_once("home.download.php");
    }

}
?>