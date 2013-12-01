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


	<?php if (isset($titre) AND !empty($titre)): ?>
		<h1><?php echo $titre ?></h1>
	<?php endif ?>


<?php require_once(WEBSITE_PATH."tpl/default_fo/share.php"); ?>
	
	<div 
		style="
		position: relative;
		background-image:url(<?php echo WEBSITE_LINK.'data'.DS.'master'.DS.$master->ID.'.jpg'; ?>);
		width: <?php echo $master->WIDTH; ?>px; 
		height: <?php echo $master->HEIGHT; ?>px;
		">
		<?php foreach ($crops as $key => $crop): ?>
			
			<div 
			data-count="<?php echo $crop->NB_POC; ?>"
			data-width="<?php echo $crop->WIDTH; ?>"
			data-height="<?php echo $crop->HEIGHT; ?>"
			class="dropfile" idCrop="<?php echo $crop->ID; ?>" style="
				display: block;
				position: absolute;
				left:<?php echo $crop->LEFT; ?>px;
				top: <?php echo $crop->TOP; ?>px;
				width: <?php echo $crop->WIDTH; ?>px;
				height: <?php echo $crop->HEIGHT; ?>px;
				background-color: black;
				opacity:0.5;
				border: 1px solid #F0AD4E;
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
        var go = true;
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
                if (!go) {
                    return;
                }
				$('#crop').val($(this).attr('idCrop'));
				$("input[type=file]").click();
			});
			$("input[type=file]").change(function() {
				$("form").submit();
			})
		})
	</script>

    <script type="text/javascript">
        $(function() {
            $("[idCrop]").each(function(k,v) {
                var width = Math.floor($(this).attr("data-width"));
                var height = Math.floor($(this).attr("data-height"));
                var taille = $("<span>").text(width+"x"+height+"px")
                    .css("position", "absolute")
                    .css("top", "3px")
                    .css("left", "3px")
                    .css("color", "white");
                $(this).append(taille);


                var count = $("<span>").text($(this).attr('data-count'))
                    .css("position", "absolute")
                    .css("bottom", "3px")
                    .css("left", "3px")
                    .css("color", "white");
                $(this).append(count);

                var id = $(this).attr("idCrop");
                var button = $("<a>")
                    .css("position", "absolute")
                    .css("bottom", "3px")
                    .css("right", "3px")
                    .css("margin-bottom", "0")
                    .css("color", "white")
                    .addClass("btn")
                    .append($("<li>")
                        .addClass("glyphicon")
                        .addClass("glyphicon-export"))
                    .attr("download", "")
                    .attr("href", "<?php echo WEBSITE_LINK; ?>data/crop/"+id+".jpg")
                    .click(function() {
                        go = false;
                        setTimeout("go=true;", 1*1000);
                    });
                $(this).append(button);
            });
        })
    </script>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" id="crop" name="crop">
		<input style="display:none" type="file" id="piczle" name="piczle">
	</form>
	
<?php endif ?>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php"); ?>
