<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<div class="jumbotron">
    <a href="<?php echo WEBSITE_LINK ?>">
        <img src="<?php echo WEBSITE_LINK ?>public/img/Piczle_Me_v02.png" alt="Piczle Me"/>
    </a>
    <p class="lead"></p>
    <p>
        <a class="btn btn-success" href="<?php echo WEBSITE_LINK ?>master" role="button">Créer un projet</a>
        <a class="btn btn-success" href="#" role="button">Participer à un projet</a>
    </p>
</div>

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
