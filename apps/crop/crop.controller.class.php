<?php
class cropController{

	public $params = array();
	
	function upload(){

		$idCrop = $this->param[0];

		require_once("upload.view.php");
	}
}
?>