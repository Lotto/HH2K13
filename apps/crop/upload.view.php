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
	
	<a class="btn btn-success" download href="<?php echo WEBSITE_LINK; ?>data/crop/<?php echo $idCrop; ?>.jpg">Télécharger le modèle</a>

	<div style="
		position: relative;
		background-image:url(<?php echo WEBSITE_LINK.'data'.DS.'master'.DS.$master->ID.'.jpg'; ?>);
		width: <?php echo $master->WIDTH; ?>px; 
		height: <?php echo $master->HEIGHT; ?>px;
		">
		<?php foreach ($crops as $key => $crop): ?>
			
			<div class="dropfile" idCrop="<?php echo $crop->ID; ?>" style="
				display: block;
				position: absolute;
				left:<?php echo $crop->LEFT; ?>px;
				top: <?php echo $crop->TOP; ?>px;
				width: <?php echo $crop->WIDTH; ?>px;
				height: <?php echo $crop->HEIGHT; ?>px;
				background-color: black;
				opacity:0.5;
				border: 1px solid red;
				">
			</div>
		<?php endforeach ?>
	</div>
	<style>
		.dropfile {
			cursor: pointer;
		}
	</style>
	<script type="text/javascript">
		$(function() {
			$(document).on('dragenter', '.dropfile', function() {
				$(this).css('border', '3px dashed red');
				return false;
			});

			$(document).on('dragover', '.dropfile', function(e){
				e.preventDefault();
				e.stopPropagation();
				$(this).css('border', '3px dashed red');
				return false;
			});

			$(document).on('dragleave', '.dropfile', function(e) {
				e.preventDefault();
				e.stopPropagation();
				$(this).css('border', '3px dashed #BBBBBB');
				return false;
			});
			$(document).on('drop', '.dropfile', function(e) {
				if(e.originalEvent.dataTransfer){
					if(e.originalEvent.dataTransfer.files.length) {
						// Stop the propagation of the event
						e.preventDefault();
						e.stopPropagation();
						$('#crop').val($(this).attr('idCrop'));
						// Main function to upload
						upload(e.originalEvent.dataTransfer.files);
					}
				}
				return false;
			});
			function upload(files) {
				var f = files[0] ;

				var reader = new FileReader();

				// When the image is loaded,
				// run handleReaderLoad function
				reader.onload = handleReaderLoad;

				// Read in the image file as a data URL.
				reader.readAsDataURL(f);
			}
			function handleReaderLoad(evt) {
				var piczle = evt.target.result.split(',')[1];
				$("form").append($("<input>").attr("name", "piczle").val(piczle)).submit();
			}
			$(".dropfile").click(function() {
				$('#crop').val($(this).attr('idCrop'));
				$("input[type=file]").click();
			});
			$("input[type=file]").change(function() {
				$("form").submit();
			})
		})
	</script>


	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" id="crop" name="crop">
		<input style="display:none" type="file" id="piczle" name="piczle">
	</form>
	
<?php endif ?>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php"); ?>
