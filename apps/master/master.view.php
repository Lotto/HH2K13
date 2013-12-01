<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>


<?php if (isset($titre) AND !empty($titre)): ?>
    <h1><?php echo $titre ?></h1>
<?php endif ?>


<?php if (isset($message)): ?>
	<div class="alert alert-danger">
		<?php echo $message ?>
	</div>
<?php endif ?>

    <div id="dropfile">
        <h2>Déplace ton image dans le cadre ou sélectionne-la en cliquant</h2>
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
            color: #F0AD4E;
            border-color: #F0AD4E;
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
            var master = evt.target.result.split(',')[1];
            $("form").append($("<input>").attr("name", "master").val(master)).submit();
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



<style>
    div.img-list a img {
        margin-top: 30px;
        width: 100%;
    }
</style>
<div class="img-list">
<?php

if(isset($projects) && !empty($projects)){

    foreach($projects as $project) {
        echo '<a href="'. WEBSITE_LINK . 'projects/create/' . $project->ID . '">';
        echo '<img src="'. WEBSITE_LINK . 'data/master/'. $project->ID . '.jpg"/>';
        echo '</a>';
    }
}

?>
</div>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php"); ?>