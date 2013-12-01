<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");

echo "<h1>Projets</h1>";

if(isset($projects) && !empty($projects)){

	foreach($projects as $project){

		echo '<h2>'.$project->PROJECT_SUBJECT.' - '.$project->PROJECT_LOGIN.'</h2>';

		echo '<div style="
					position : relative;
					background-image : url('.WEBSITE_LINK.'data'.DS.'master'.DS.$project->MASTER_ID.'.jpg);
					width : '.$project->MASTER_WIDTH.'px;
					height : '.$project->MASTER_HEIGHT.'px;">';

		

		foreach($arrayCrops[$project->PROJECT_ID] as $crop){
			echo '<div style="display: block; position: absolute; left:'.$crop->CROP_LEFT.'px; top: '.$crop->CROP_TOP.'px;width: '.$crop->CROP_WIDTH.'px; height: '.$crop->CROP_HEIGHT.'px;background-color: black;opacity:0.5;border: 1px solid red;"></div>';
		}

		echo '</div>
		<div class="container">
			  <div class="row">
			    <div class="col-lg-6"><a class="btn btn-success pull-right" href="'.WEBSITE_LINK.'crop'.DS.'upload'.DS.$project->PROJECT_ID.'" role="button">Contribuer</a></div>
			    <div class="col-lg-6"><a class="btn btn-success pull-left" href="'.WEBSITE_LINK.'projects'.DS.'view'.DS.$project->PROJECT_ID.'" role="button">Finaliser</a></div>
			  </div>
			</div>';
	}

}
else{
	echo '<div class="alert alert-danger">Aucun projet pour le moment</div>';
}

require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");

?>
