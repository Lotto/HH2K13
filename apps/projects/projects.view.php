<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");

if(isset($_SESSION['login'])){
	if($myprojects == true){
		echo '<a href="'.WEBSITE_LINK.'projects">Tous les projets</a>';
	}
	else{
		echo '<a href="'.WEBSITE_LINK.'projects'.DS.'myprojects">Mes projets</a>';
	}
}

$idCurrentProject = 0;

foreach($projects as $project){

	if($idCurrentProject != $project->PROJECT_ID){

		if($idCurrentProject != 0){
			echo '</div>';
		}
		$idCurrentProject = $project->PROJECT_ID;
		echo '<h1>'.$project->PROJECT_SUBJECT.'</h1>';
		echo '<div style="background-image:url('.WEBSITE_LINK.'data'.DS.'master'.DS.$project->MASTER_ID.'.jpg);width: '.$project->MASTER_WIDTH.'px; height: '.$project->MASTER_HEIGHT.'px;">';
	}
	
	echo '<a href="'.WEBSITE_LINK.'crop'.DS.'upload'.DS.$project->CROP_ID.'"><div style="position: relative; left:'.$project->CROP_LEFT.'px; top: '.$project->CROP_TOP.'px;width: '.$project->CROP_WIDTH.'px; height: '.$project->CROP_HEIGHT.'px;background-color: black;opacity:0.5;border: 1px solid red;"></div></a>';
}

require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>
