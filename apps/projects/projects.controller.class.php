<?php
class projectsController{
	public $params = array();

	function projects(){

		require_once("projects.view.php");
	}

	function new(){

		require_once("new.view.php");
	}
}
?>