<?php
class usersController{
	public $params = array();
	
	function login(){
		print_r($_POST);
		exit();

		if(isset($_POST) && !empty($_POST)){
			echo "ok";
			exit();
		}
		else{
			require_once("login.view.php");
		}
	}
}
?>