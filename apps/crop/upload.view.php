<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<?php if (isset($erreurFatale)): ?>
	<div class="alert alert-danger">
		<?php echo $erreurFatale ?>
	</div>
<?php else: ?>

	<?php if (isset($message)): ?>
		<div class="alert alert-info">
			<?php echo $message ?>
		</div>
	<?php endif ?>

	<?php if (isset($erreur)): ?>
		<div class="alert alert-danger">
			<?php echo $erreur ?>
		</div>
	<?php endif ?>

	<h1>Uploader mon Piczle</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<label for="piczle">Image</label><input type="file" id="piczle" name="piczle">
		<input type="submit" value="Envoyer ma photo">
	</form>
	
<?php endif ?>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php"); ?>
