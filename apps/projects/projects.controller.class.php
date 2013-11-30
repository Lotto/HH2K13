<?php
class projectsController{
	public $params = array();

	function myprojects(){
		$this->projects(true);
	}

	function projects($myprojects = false){

		$sqlWhere = ($myprojects==true) ? '' : ' WHERE P.LOGIN = :LOGIN ' ;

		$r = SPDO::getInstance()->prepare("
			SELECT 
				PM.ID AS MASTER_ID, 
				PM.WIDTH AS MASTER_WIDTH, 
				PM.HEIGHT AS MASTER_HEIGHT,
				P.ID AS PROJECT_ID,
				P.SUBJECT AS PROJECT_SUBJECT,
				PC.ID AS CROP_ID,
				PC.LEFT AS CROP_LEFT,
				PC.TOP AS CROP_TOP,
				PC.WIDTH AS CROP_WIDTH,
				PC.HEIGHT AS CROP_HEIGHT
			FROM PHOTOS_MASTER PM
			LEFT JOIN PROJECTS P ON P.ID_MASTER=PM.ID
			LEFT JOIN PROJECTS_CROP PC ON P.ID=PC.ID_PROJECT
			".$sqlWhere."
			ORDER BY P.ID ASC");
		$r->setFetchMode(PDO::FETCH_OBJ);
		if($myprojects==true){
			$r->bindValue(':LOGIN', $_SESSION['login'], PDO::PARAM_STR);
		}
		$r->execute();
		$projects = $r->fetchAll();

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

				$insert = SPDO::getInstance()->prepare("INSERT INTO PROJECTS(ID_MASTER, SUBJECT, LOGIN) VALUES(:idMaster, :subject, :login)");
				$insert->execute(array(
						'idMaster' => $idMaster,
						'subject'  => $_POST['subject'],
						'login' => $_SESSION['login']
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