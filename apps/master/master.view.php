<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<?php if (isset($message)): ?>
	<div class="alert alert-danger">
		<?php echo $message ?>
	</div>
<?php endif ?>

<h1>Uploader ma photo</h1>


    <div id="dropfile">Drop an image from your computer</div>
    <style>
        #dropfile{
            width: 300px;
            height: 50px;
            border: 3px dashed #BBBBBB;
            line-height:50px;
            text-align: center;
        }
    </style>
    <script type="text/javascript">
        $(function() {
        $(document).on('dragenter', '#dropfile', function() {
            $(this).css('border', '3px dashed red');
            return false;
        });

        $(document).on('dragover', '#dropfile', function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).css('border', '3px dashed red');
            return false;
        });

        $(document).on('dragleave', '#dropfile', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).css('border', '3px dashed #BBBBBB');
            return false;
        });
        $(document).on('drop', '#dropfile', function(e) {
            if(e.originalEvent.dataTransfer){
                if(e.originalEvent.dataTransfer.files.length) {
                    // Stop the propagation of the event
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).css('border', '3px dashed green');
                    // Main function to upload
                    upload(e.originalEvent.dataTransfer.files);
                }
                else {
                    $(this).css('border', '3px dashed #BBBBBB');
                }
            }
            else {
                $(this).css('border', '3px dashed #BBBBBB');
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
            var pic = {};
            pic.file = evt.target.result.split(',')[1];

            var str = jQuery.param(pic);

            $.ajax({
                type: 'POST',
                url: "<?php echo WEBSITE_LINK; ?>/master",
                data: str,
                    success: function(data) {
                    //do_something(data) ;
                }
            });
        }
        })
    </script>


<form action="" method="post" enctype="multipart/form-data">
	<label for="master">Image</label><input type="file" id="master" name="master">
	<input type="submit" value="Envoyer ma photo">
</form>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php"); ?>