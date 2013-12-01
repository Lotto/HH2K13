<?php
class cropController{

	public $params = array();
	
	function upload(){

		$idProject = $this->params[0];

		$r = SPDO::getInstance()->prepare("SELECT * FROM PROJECTS_CROP WHERE ID_PROJECT = ?");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute(array($idProject));
		$crops = $r->fetchAll();

		if (!empty($crops)) {

			$selectMaster = SPDO::getInstance()->prepare("SELECT PHOTOS_MASTER.* FROM PHOTOS_MASTER, PROJECTS WHERE PROJECTS.ID_MASTER = PHOTOS_MASTER.ID AND PROJECTS.ID = ?");
			$selectMaster->setFetchMode(PDO::FETCH_OBJ);
			$selectMaster->execute(array($idProject));
			$masters = $selectMaster->fetchAll();
			$master = $masters[0];

			$message = "Fait glisser ton Piczle sur le crop de ton choix ou clique tout simplement dessus !";

            if (!empty($_POST['piczle'])) { // AJAX DRAG & DROP
                $file = $_POST['piczle'];
                $path = "/tmp/".md5(rand().time()).'.jpg';

                // Encode it correctly
                $encodedData = str_replace(' ','+',$file);
                $decodedData = base64_decode($encodedData);

                // Finally, save the image
                file_put_contents($path, $decodedData) ;

                $_FILES['piczle']["tmp_name"] = $path;
            }

			if(!empty($_FILES['piczle']) AND isset($_POST['crop']) AND !empty($_POST['crop']))
			{

				require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');
				require_once(WEBSITE_PATH.DS.'inc'.DS.'class'.DS.'SPDO.class.php');
				
				$image = $_FILES['piczle'];

				if (empty($image['tmp_name']))
					$erreur = 'Oh... :( Impossible de récupérer votre Piczle';
				else
				{
					$selectCrop = SPDO::getInstance()->prepare("SELECT * FROM PROJECTS_CROP WHERE ID = ?");
					$selectCrop->setFetchMode(PDO::FETCH_OBJ);
					$selectCrop->execute(array($_POST['crop']));
					$crops = $selectCrop->fetchAll();

					if (!empty($crops)) {
						
						$crop = $crops[0];

						$imagine = new Imagine\Gd\Imagine();
						
						$image = $imagine->open($image['tmp_name']);
						$width = $image->getSize()->getWidth();
						$height = $image->getSize()->getHeight();
						
						if ($width != $crop->WIDTH OR $height != $crop->HEIGHT)
							$erreur = "Votre Piczle ne fait pas la bonne taille :( Assurez de vous de fournir un Piczle de ".$crop->WIDTH."px de long par ".$crop->HEIGHT."px de hauteur";
						else {

							$insert = SPDO::getInstance()->prepare("INSERT INTO PHOTOS_CROP(ID_CROP) VALUES(:idCrop)");
							$insert->execute(array(
								'idCrop' => $crop->ID
								));
							$id = SPDO::getInstance()->lastInsertId();
							
							try {

								$image->save(WEBSITE_PATH.DS.'data'.DS.'piczle'.DS.$id.'.jpg');

		                        $message = "Votre Piczle a bien été envoyé ! Félicitations !";
		                        setFlash($message);
		                        header('Location: '.WEBSITE_LINK);
		                        exit;

							} catch (Exception $e) {
								$erreur = "Impossible d'enregistrer votre Piczle :( Veuillez réessayer plus tard.";
							}

						}
					}
					else
						$erreurFatale = 'Aïe :( Cet identifiant n\'est associé à aucun crop. <a href="'.WEBSITE_LINK.'projects">Retournez à la page des projets ?</a>';
				}
			}
		}
		else
			$erreurFatale = 'Aïe :( Cet identifiant n\'est associé à aucun projet. <a href="'.WEBSITE_LINK.'projects">Retournez à la page des projets ?</a>';

		$titre = "Uploader mon Piczle";
		require_once("upload.view.php");
	}
}
?>