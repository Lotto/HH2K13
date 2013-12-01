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
	
<?php endif ?>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php"); ?>
