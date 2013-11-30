<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");

echo '<h2>'.$crops[0]->PROJECT_SUBJECT.' - '.$crops[0]->PROJECT_LOGIN.'</h2>';

echo '<div style="position:relative;background-image:url('.WEBSITE_LINK.'data'.DS.'master'.DS.$crops[0]->MASTER_ID.'.jpg);width: '.$crops[0]->MASTER_WIDTH.'px; height: '.$crops[0]->MASTER_HEIGHT.'px;">';

foreach($crops as $crop){

	echo '<a href="'.WEBSITE_LINK.'crop'.DS.'upload'.DS.$crop->CROP_ID.'" alt="Voir les piczles" style="position: absolute; left:'.$crop->CROP_LEFT.'px; top: '.$crop->CROP_TOP.'px;width: '.$crop->CROP_WIDTH.'px; height: '.$crop->CROP_HEIGHT.'px;background-color: black;opacity:0.5;border: 1px solid red;"></a>';
}

echo '</div>';


foreach($photosCrop as $photoCrop){
	echo '<a href="#"><img src="'.WEBSITE_LINK.'data'.DS.'piczle'.DS.$photoCrop->ID.'.jpg" alt="photo"/></a>';
}

require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>
