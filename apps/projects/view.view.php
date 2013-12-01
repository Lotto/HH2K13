<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<script type="text/javascript">
 
$(document).ready(function(){
    $(".showPhotosCropDiv").show();
    $(".photosCropDiv").hide();


    $('[data-crop-img]').click(function(){
    	$(".photosCropDiv").hide();
    	$("[data-crop-click][data-crop-id="+$(this).attr("data-crop-id")+"]").parent(".photosCropDiv").show();
    }); 

    $('[data-crop-click]').click(function(){
    	if ($(this).attr("data-crop-reset") == "true") {
		   	$("[data-crop-img][data-crop-id="+$(this).attr("data-crop-id")+"]").html('');
		    $("[data-crop-img][data-crop-id="+$(this).attr("data-crop-id")+"]").removeClass('imageSelected');
		    $("[data-crop-img][data-crop-id="+$(this).attr("data-crop-id")+"]").addClass('imageNotSelected');
    	} else {
		    $("[data-crop-img][data-crop-id="+$(this).attr("data-crop-id")+"]").html($(this).clone());
		    $("[data-crop-img][data-crop-id="+$(this).attr("data-crop-id")+"]").removeClass('imageNotSelected');
		    $("[data-crop-img][data-crop-id="+$(this).attr("data-crop-id")+"]").addClass('imageSelected');
    	}
    }); 
});

</script>


<style type="text/css">
.photosCropDiv {
    height:300px;
    padding:20px;
    margin-top:10px;
    background-color: #eeeeee;
    border-radius: 5px;
    height: auto;
}

.photosCropDiv div {
	float: left;
	cursor: pointer;
    max-width: 22%;
    margin-right: 7px;
}
 
.photosCropDiv div img {
    width: 100%;
}

.showPhotosCropDiv {
    display:none;
}

.imageSelected {
background-color : transparent;
opacity: 1;
border : none;
}

.imageNotSelected {
	background-color: black;
	opacity:0.5;
	border: 1px solid #F0AD4E;
}

.btn {
    margin-top: 7px;
}
</style>


<?php

echo '<h2>'.$crops[0]->PROJECT_SUBJECT.' - '.$crops[0]->PROJECT_LOGIN.'</h2>';

require_once(WEBSITE_PATH."tpl/default_fo/share.php");

echo '<div style="position:relative;background-image:url('.WEBSITE_LINK.'data'.DS.'master'.DS.$crops[0]->MASTER_ID.'.jpg);width: '.$crops[0]->MASTER_WIDTH.'px; height: '.$crops[0]->MASTER_HEIGHT.'px;">';

foreach($crops as $crop){

	echo '<a class="showPhotosCropDiv imageNotSelected" data-crop-id="'.$crop->CROP_ID.'" data-crop-img href="#save" alt="Voir les piczles" style="position: absolute; left:'.$crop->CROP_LEFT.'px; top: '.$crop->CROP_TOP.'px;width: '.$crop->CROP_WIDTH.'px; height: '.$crop->CROP_HEIGHT.'px;"></a>';
}

echo '</div>';

$currentCropId = 0;

foreach($photosCrop as $photoCrop){

	if($currentCropId != $photoCrop->ID_CROP){

		if($currentCropId != 0){
			echo '</div>';
		}
		$currentCropId = $photoCrop->ID_CROP;
				
		echo '<div data-crop-id="'.$currentCropId.'" class="photosCropDiv container">
				<div data-crop-click data-crop-reset="true" data-crop-id="'.$currentCropId.'" class="imageNotSelected" style="width: '.$crops[0]->CROP_WIDTH.'px; height: '.$crops[0]->CROP_HEIGHT.'px;"></div>';
	}


	echo '<div data-crop-click data-crop-id="'.$currentCropId.'"><img data-img-id="'.$photoCrop->ID.'" src="'.WEBSITE_LINK.'data'.DS.'piczle'.DS.$photoCrop->ID.'.jpg" alt="photo"/></div>';
}
echo '</div>';

?>
<button id="save" class="btn btn-warning">Sauvegarder</button>
<script type="text/javascript">
    $(function() {
        $("button").click(function() {
            var form = $("<form>").attr("method", "POST").attr("action", "<?php echo WEBSITE_LINK ?>projects/validate/<?php echo $this->params[0]; ?>");
            $.each($("[data-crop-img].imageSelected"), function(k, v) {
                form.append($("<input>").attr("name", $(v).attr("data-crop-id")).val($(v).find("img").attr("data-img-id")));
            });
            $("body").append(form);
            form.submit();
        })
    })
</script>

<?php
require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>
