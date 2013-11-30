<?php
class usersController{
	public $params = array();
	
	function login(){

		if (!empty($_POST['login'])) {

			$_SESSION['login'] = $_POST['login'];

			header('Location: '.WEBSITE_LINK.'home');      
  			exit();   
  		}	
		else{
			require_once("login.view.php");
		}
	}

	function logout(){
		session_destroy();
		header('Location: '.WEBSITE_LINK.'home');      
		exit();  
	}
}
?>