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
        unset($_SESSION['login']);
		session_destroy();
		header('Location: '.WEBSITE_LINK.'home');      
		exit();  
	}

	function myprojects(){
		$r = SPDO::getInstance()->prepare("SELECT * FROM  PROJECTS WHERE LOGIN = :LOGIN");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->bindValue(':LOGIN', $_SESSION['login'], PDO::PARAM_STR);
		$r->execute();
		$myprojects = $r->fetchAll();

		require_once("myprojects.view.php");
	}
}
?>