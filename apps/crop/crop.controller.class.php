<?php
class cropController{

	public $params = array();
	
	function upload(){

		$idCrop = $this->params[0];

		$r = SPDO::getInstance()->prepare("SELECT * FROM PROJECTS_CROP WHERE ID = ?");
		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute(array($idCrop));
		$crops = $r->fetchAll();

		if (!empty($crops)) {
			$crop = $crops[0];

			$message = "Propose nous ton Piczle de ".$crop->WIDTH."px de long par ".$crop->HEIGHT."px de hauteur !";

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

			if(!empty($_FILES['piczle']))
			{
				require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');
				require_once(WEBSITE_PATH.DS.'inc'.DS.'class'.DS.'SPDO.class.php');
				
				$image = $_FILES['piczle'];

				if (empty($image['tmp_name']))
					$erreur = 'Oh... :( Impossible de récupérer votre Piczle';
				else
				{
					$imagine = new Imagine\Gd\Imagine();
					
					$image = $imagine->open($image['tmp_name']);
					$width = $image->getSize()->getWidth();
					$height = $image->getSize()->getHeight();
					
					if ($width != $crop->WIDTH OR $height != $crop->HEIGHT)
						$erreur = "Votre Piczle ne fait pas la bonne taille :( Assurez de vous de fournir un Piczle de ".$crop->WIDTH."px de long par ".$crop->HEIGHT."px de hauteur";
					else {

						$insert = SPDO::getInstance()->prepare("INSERT INTO PHOTOS_CROP(ID_CROP) VALUES(:idCrop)");
						$insert->execute(array(
							'idCrop' => $idCrop
							));
						$id = SPDO::getInstance()->lastInsertId();
						
						try {

							$image->save(WEBSITE_PATH.DS.'data'.DS.'piczle'.DS.$id.'.jpg');
						} catch (Exception $e) {
							$erreur = "Impossible d'enregistrer votre Piczle :( Veuillez réessayer plus tard.";
						}

                        header('Location: '.WEBSITE_LINK);
					}

				}
			}
		}
		else
			$erreurFatale = 'Aïe :( Cet identifiant n\'est associé à aucun crop. <a href="'.WEBSITE_LINK.'projects">Retournez à la page des projets ?</a>';

		require_once("upload.view.php");
	}
}
?>