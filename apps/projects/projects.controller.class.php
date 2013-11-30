<?php
class projectsController{
	public $params = array();

	function projects(){

		require_once("projects.view.php");
	}

	function create(){

		$idMaster = $this->params[0];
		$r = SPDO::getInstance()->prepare("SELECT * FROM  PHOTOS_MASTER WHERE ID = ?");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute(array($idMaster));
		$photosMaster = $r->fetchAll();

		$photoMaster = $photosMaster[0];

		if (!empty($_POST)) {
			
			if (!empty($_POST['subject']) AND count($_POST) > 1) {

				$insert = SPDO::getInstance()->prepare("INSERT INTO PROJECTS(ID_MASTER, SUBJECT) VALUES(:idMaster, :subject)");
				$insert->execute(array(
						'idMaster' => $idMaster,
						'subject'  => $_POST['subject']
					));

				$idProject = SPDO::getInstance()->lastInsertId();

				foreach ($_POST as $key => $crop) {
					
					if ($key != 'subject') {
						
						debug($crop);
						$insertCrop = SPDO::getInstance()->prepare("INSERT INTO `PROJECTS_CROP`(`ID_PROJECT`, `WIDTH`, `HEIGHT`, `LEFT`, `TOP`) VALUES (:idProject,:width,:height,:left,:top)");

						$insertCrop->execute(array(
								'idProject' => $idProject,
								'width'     => $crop['width'],
								'height'    => $crop['height'],
								'left'      => $crop['left'],
								'top'       => $crop['top']
							));
					}
				}
			}
			else {

				echo "string";
			}
		}

		require_once("create.view.php");
	}
}
?>