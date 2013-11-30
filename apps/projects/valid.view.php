<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");

echo '<h1>'.$crops[0]->PROJECT_SUBJECT.' - '.$crops[0]->PROJECT_LOGIN.'</h1>';

echo '<div style="background-image:url('.WEBSITE_LINK.'data'.DS.'master'.DS.$crops[0]->MASTER_ID.'.jpg);width: '.$crops[0]->MASTER_WIDTH.'px; height: '.$crops[0]->MASTER_HEIGHT.'px;">';

foreach($crops as $crop){

	echo '<a href="'.WEBSITE_LINK.'crop'.DS.'upload'.DS.$crop->CROP_ID.'"><div style="position: relative; left:'.$crop->CROP_LEFT.'px; top: '.$crop->CROP_TOP.'px;width: '.$crop->CROP_WIDTH.'px; height: '.$crop->CROP_HEIGHT.'px;background-color: black;opacity:0.5;border: 1px solid red;"></div></a>';
}

echo '</div>';

require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>
