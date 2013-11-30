<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<?php if (isset($message)) { ?>
    <div class="alert alert-danger">
        <?php echo $message ?>
    </div>
<?php } ?>

<h1>Uploader ma photo</h1>
<form action="" method="post" enctype="multipart/form-data">
	<label for="master">Image</label><input type="file" id="master" name="master">
	<input type="submit" value="Envoyer ma photo">
</form>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php"); ?>