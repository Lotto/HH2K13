<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<?php if (isset($message)): ?>
	<div class="alert alert-danger">
		<?php echo $message ?>
	</div>
<?php endif ?>

<h1>Uploader ma photo</h1>


    <div id="dropfile">
        <p>Déposer une image de votre ordinateur</p>
        <p>ou</p>
        <p>Cliquer pour ouvrir le navigateur de fichier</p>
    </div>
    <style>
        #dropfile {
            width: 100%;
            border: 3px dashed #BBBBBB;
            font-size: 20px;
            line-height:40px;
            text-align: center;
            cursor: pointer;
        }
        #dropfile:hover {
            color: red;
            border-color: red;
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
            pic.master = evt.target.result.split(',')[1];

            var str = jQuery.param(pic);

            $.ajax({
                type: 'POST',
                url: "<?php echo WEBSITE_LINK; ?>/master",
                data: str,
                success: function(data) {
                    document.location = data;
                }
            });
        }
            $("#dropfile").click(function() {
                $("input[type=file]").click();
            });
            $("input[type=file]").change(function() {
                $("form").submit();
            })
        })
    </script>


<form action="" method="post" enctype="multipart/form-data">
	<input style="display:none" type="file" id="master" name="master">
</form>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php"); ?>