<?php
class masterController{
	public $params = array();

	function master(){
		$tailleMiniature = 255;
		$tailleImage = 1000;

		$r = SPDO::getInstance()->prepare("
			SELECT P.ID AS ID
			FROM PHOTOS_MASTER P
			ORDER BY P.ID DESC");

		$r->setFetchMode(PDO::FETCH_OBJ);
		$r->execute();
		$projects = $r->fetchAll();





        if (!empty($_POST['master'])) { // AJAX DRAG & DROP
            $file = $_POST['master'];
            $path = "/tmp/".md5(rand().time()).'.jpg';

            // Encode it correctly
            $encodedData = str_replace(' ','+',$file);
            $decodedData = base64_decode($encodedData);

            // Finally, save the image
            file_put_contents($path, $decodedData) ;

            $_FILES['master']["tmp_name"] = $path;
        }

		if(!empty($_FILES['master']))
		{
			require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');
			require_once(WEBSITE_PATH.DS.'inc'.DS.'class'.DS.'SPDO.class.php');
			
			$image = $_FILES['master'];

			if (empty($image['tmp_name'])) {
				$message = 'Impossible de récupérer votre image';
			}
			else
			{
				$imagine = new Imagine\Gd\Imagine();
				$sizeMiniature = new Imagine\Image\Box($tailleMiniature, $tailleMiniature);
				$size = new Imagine\Image\Box($tailleImage, $tailleImage);
				
				$image = $imagine->open($image['tmp_name'])->thumbnail($size, 'inset');
				$width = $image->getSize()->getWidth();
				$height = $image->getSize()->getHeight();
				
				$insert = SPDO::getInstance()->prepare("INSERT INTO PHOTOS_MASTER(WIDTH, HEIGHT) VALUES(:width, :height)");
				$insert->execute(array(
					'width' => $width,
					'height' => $height
					));
				$id = SPDO::getInstance()->lastInsertId();
				
				$image->save(WEBSITE_PATH.DS.'data'.DS.'master'.DS.$id.'.jpg');
				$image->thumbnail($sizeMiniature, 'inset')->save(WEBSITE_PATH.DS.'data'.DS.'master'.DS.$id.'_'.$tailleMiniature.'x'.$tailleMiniature.'.jpg', array('quality' => 100));

				$message = "Votre image a bien été envoyé ! Félicitations !";
				setFlash($message);

                $link = WEBSITE_LINK.'projects/create/'.$id;
                header('Location: '.$link);
                exit;
			}
		}

		$titre = 'Choisis ta photo';
		require_once("master.view.php");
	}
}
?>