<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");

foreach($photosMaster as $master){
	echo $master->ID;
	echo $master->WIDTH;
	echo $master->HEIGHT;
	echo '<img src="'.WEBSITE_LINK.'data'.DS.'master'.DS.$master->ID.'.jpg" alt="Photo">';
	echo "<br />";
}

require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>
