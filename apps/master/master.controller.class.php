<?php
use Imagine\Image\ImageInterface;
class masterController{
	public $params = array();

	function master(){

		$tailleMiniature = 255;

		if(!empty($_FILES['master']))
		{

			$r = SPDO::getInstance()->prepare("SELECT COUNT(*) as nb FROM  PHOTOS_MASTER");
			$r->setFetchMode(PDO::FETCH_OBJ);
			$r->execute();
			$nbMaster = $r->fetchAll();

			require_once('phar://'.WEBSITE_PATH.DS."lib".DS."imagine".DS.'imagine.phar');

			$image = $_FILES['master'];

			$nouveauNom = $nbMaster[0]->nb + 1;

			$imagine = new Imagine\Gd\Imagine();

			$size = new Imagine\Image\Box($tailleMiniature, $tailleMiniature);

			if (empty($image['tmp_name'])) {
				$message = 'Impossible de récupérer votre image';
			}
			else
			{
				$image = $imagine->open($image['tmp_name']);
				$width = $image->getSize()->getWidth();
				$height = $image->getSize()->getHeight();
				$image->save(WEBSITE_PATH.DS.'data'.DS.'master'.DS.$nouveauNom.'.jpg');
				$image->thumbnail($size, 'inset')->save(WEBSITE_PATH.DS.'data'.DS.'master'.DS.$nouveauNom.'_'.$tailleMiniature.'x'.$tailleMiniature.'.jpg', array('quality' => 100));
				
				$insert = SPDO::getInstance()->prepare("INSERT INTO PHOTOS_MASTER(WIDTH, HEIGHT) VALUES(:width, :height)");
				$insert->execute(array(
					'width' => $width,
					'height' => $height
					));
			}
		}

		require_once("master.view.php");
	}
}
?>