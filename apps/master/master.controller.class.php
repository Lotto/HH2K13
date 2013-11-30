<?php
class masterController{
	public $params = array();

	function master(){

		$tailleMiniature = 255;

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
				$size = new Imagine\Image\Box($tailleMiniature, $tailleMiniature);
				
				$image = $imagine->open($image['tmp_name']);
				$width = $image->getSize()->getWidth();
				$height = $image->getSize()->getHeight();
				
				$insert = SPDO::getInstance()->prepare("INSERT INTO PHOTOS_MASTER(WIDTH, HEIGHT) VALUES(:width, :height)");
				$insert->execute(array(
					'width' => $width,
					'height' => $height
					));
				$id = SPDO::getInstance()->lastInsertId();
				
				$image->save(WEBSITE_PATH.DS.'data'.DS.'master'.DS.$id.'.jpg');
				$image->thumbnail($size, 'inset')->save(WEBSITE_PATH.DS.'data'.DS.'master'.DS.$id.'_'.$tailleMiniature.'x'.$tailleMiniature.'.jpg', array('quality' => 100));
				

				header('Location: '.WEBSITE_LINK.'projects/create/'.$id);
			}
		}

		require_once("master.view.php");
	}
}
?>