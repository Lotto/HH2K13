<?php
class projectsController{

	public $params = array();

	function myprojects(){

		if(isset($_SESSION['login'])){
			$this->projects(true);
		}
		else{			
			header('Location: '.WEBSITE_LINK.'projects');      
			exit();  
		}
	}

	function view(){

		$r = SPDO::getInstance()->prepare("
			SELECT 
				PM.ID AS MASTER_ID, 
				PM.WIDTH AS MASTER_WIDTH, 
				PM.HEIGHT AS MASTER_HEIGHT,
				P.ID AS PROJECT_ID,
				P.SUBJECT AS PROJECT_SUBJECT,
				P.LOGIN AS PROJECT_LOGIN,
				PC.ID AS CROP_ID,
				PC.LEFT AS CROP_LEFT,
				PC.TOP AS CROP_TOP,
				PC.WIDTH AS CROP_WIDTH,
				PC.HEIGHT AS CROP_HEIGHT
			FROM PHOTOS_MASTER PM
			LEFT JOIN PROJECTS P ON P.ID_MASTER=PM.ID
			LEFT JOIN PROJECTS_CROP PC ON P.ID=PC.ID_PROJECT
			WHERE P.ID=:PROJECT_ID
			ORDER BY P.ID ASC");

		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->bindValue(':PROJECT_ID', $this->params[0], PDO::PARAM_INT);
		$r->execute();
		$crops = $r->fetchAll();

		$r = SPDO::getInstance()->prepare("
			SELECT ID, ID_CROP
			FROM PHOTOS_CROP			
			WHERE ID_CROP IN (SELECT ID FROM PROJECTS_CROP WHERE ID_PROJECT=:PROJECT_ID)
			ORDER BY ID_CROP ASC");

		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->bindValue(':PROJECT_ID', $this->params[0], PDO::PARAM_INT);
		$r->execute();
		$photosCrop = $r->fetchAll();


		require_once("view.view.php");
	}

	function projects($myprojects = false){

		$sqlWhere = ($myprojects==true) ? ' WHERE P.LOGIN = :LOGIN ' : '' ;

		$r = SPDO::getInstance()->prepare("
			SELECT 
				PM.ID AS MASTER_ID, 
				PM.WIDTH AS MASTER_WIDTH, 
				PM.HEIGHT AS MASTER_HEIGHT,
				P.ID AS PROJECT_ID,
				P.SUBJECT AS PROJECT_SUBJECT,
				P.LOGIN AS PROJECT_LOGIN,
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

		require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');
		require_once(WEBSITE_PATH.DS.'inc'.DS.'class'.DS.'SPDO.class.php');

		$idMaster = $this->params[0];
		$r = SPDO::getInstance()->prepare("SELECT * FROM  PHOTOS_MASTER WHERE ID = ?");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute(array($idMaster));
		$photosMaster = $r->fetchAll();

		$photoMaster = $photosMaster[0];

		if (!empty($_POST)) {

			if (!empty($_POST['subject']) AND count($_POST) > 1) {

				$imagine = new Imagine\Gd\Imagine();
				
				

				$insert = SPDO::getInstance()->prepare("INSERT INTO PROJECTS(ID_MASTER, SUBJECT, LOGIN) VALUES(:idMaster, :subject, :login)");
				$insert->execute(array(
						'idMaster' => $idMaster,
						'subject'  => $_POST['subject'],
						'login' => (isset($_SESSION['login']) && !empty($_SESSION['login'])) ? $_SESSION['login'] : 'visiteur'
					));

				$idProject = SPDO::getInstance()->lastInsertId();

				foreach ($_POST as $key => $crop) {
					
					if ($key != 'subject') {
						
						$insertCrop = SPDO::getInstance()->prepare("INSERT INTO `PROJECTS_CROP`(`ID_PROJECT`, `WIDTH`, `HEIGHT`, `LEFT`, `TOP`) VALUES (:idProject,:width,:height,:left,:top)");

						$insertCrop->execute(array(
								'idProject' => $idProject,
								'width'     => $crop['width'],
								'height'    => $crop['height'],
								'left'      => $crop['left'],
								'top'       => $crop['top']
							));
						$idCrop = SPDO::getInstance()->lastInsertId();

						$image = $imagine->open(WEBSITE_PATH.DS.'data'.DS.'master'.DS.$idMaster.'.jpg');
						$size = new Imagine\Image\Box($crop['width'], $crop['height']);
						$point = new Imagine\Image\Point($crop['left'], $crop['top']);
						$imageCrop = $image->crop($point, $size)->save(WEBSITE_PATH.DS.'data'.DS.'crop'.DS.$idCrop.'.jpg');
					}
				}

				header('Location: '.WEBSITE_LINK.'home');      
				exit();
			}
			else {

				$erreur = "N'oublie pas de renseigner un titre et au moins un crop' Piczle.";
			}
		}
	}

	function validate() {

		$idProject = $this->params[0];

		require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');
		require_once(WEBSITE_PATH.DS.'inc'.DS.'class'.DS.'SPDO.class.php');

		$r = SPDO::getInstance()->prepare("SELECT * FROM  PROJECTS WHERE ID = ?");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute(array($idProject));
		$projects = $r->fetchAll();

		if (empty($projects))
			$erreurFatale = 'Aïe :( Cet identifiant n\'est associé à aucun projet. <a href="'.WEBSITE_LINK.'projects">Retournez à la page des projets ?</a>';
		else {

			$project = $projects[0];
			$idMaster = $project->ID_MASTER;

			if (!empty($_POST)) {

				$imagine = new Imagine\Gd\Imagine();

				$insert = SPDO::getInstance()->prepare("INSERT INTO VALID_PROJECTS(ID_PROJECT) VALUES(:idProject)");
				$insert->execute(array(
						'idProject' => $idProject
					));
				$idValidProject = SPDO::getInstance()->lastInsertId();

				$image = $imagine->open(WEBSITE_PATH.DS.'data'.DS.'master'.DS.$idMaster.'.jpg');

				foreach ($_POST as $idCrop => $idPiczle) {
								
					$selectCrop = SPDO::getInstance()->prepare("SELECT * FROM  PROJECTS_CROP WHERE ID = :idCrop");
					$selectCrop->setFetchMode(PDO::FETCH_OBJ);
					$selectCrop->execute(array(
						'idCrop' => $idCrop
						));
					$crops = $selectCrop->fetchAll();
					$crop = $crops[0];

					$imagePiczle = $imagine->open(WEBSITE_PATH.DS.'data'.DS.'piczle'.DS.$idPiczle.'.jpg');
					$position = new Imagine\Image\Point($crop->LEFT, $crop->TOP);
					$image->paste($imagePiczle, $position);
				}

				$image->save(WEBSITE_PATH.DS.'data'.DS.'valid'.DS.$idValidProject.'.jpg');

				header('Location: '.WEBSITE_LINK.'home');
				exit();
			}
			else {

					$erreur = "N'oublie pas de renseigner un titre et au moins un crop' Piczle.";
			}
		}

		require_once("validate.view.php");
	}
}
?>