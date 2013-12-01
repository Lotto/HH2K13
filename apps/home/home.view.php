<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<div class="row">
<?php
foreach($finalPhotos as $finalPhoto) {
    echo '<div class="col-lg-6" data-img-src="'.WEBSITE_LINK.'data'.DS.'master'.DS.$finalPhoto->MASTER_ID.'.jpg" data-img-dest="'.WEBSITE_LINK.'data'.DS.'valid'.DS.$finalPhoto->VALID_ID.'.jpg">';
    echo '<img src="'.WEBSITE_LINK.'data'.DS.'master'.DS.$finalPhoto->MASTER_ID.'.jpg" alt="Photo">';
    echo '</div>';
    echo '<div class="col-lg-6" data-img-src="'.WEBSITE_LINK.'data'.DS.'master'.DS.$finalPhoto->VALID_ID.'.jpg" data-img-dest="'.WEBSITE_LINK.'data'.DS.'valid'.DS.$finalPhoto->MASTER_ID.'.jpg">';
    echo '<img src="'.WEBSITE_LINK.'data'.DS.'valid'.DS.$finalPhoto->VALID_ID.'.jpg" alt="Photo">';
    echo '</div>';
}
?>
</div>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");?>
