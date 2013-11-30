<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<div class="row">
<?php
foreach($photosMaster as $master) {
    echo '<div class="col-lg-6">';
    echo '<img src="'.WEBSITE_LINK.'data'.DS.'master'.DS.$master->ID.'.jpg" alt="Photo">';
    echo '</div>';
    echo '<div class="col-lg-6">';
    echo '<img src="'.WEBSITE_LINK.'data'.DS.'master'.DS.$master->ID.'.jpg" alt="Photo">';
    echo '</div>';
}
?>
</div>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");?>
