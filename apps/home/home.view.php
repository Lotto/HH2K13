<?php require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php"); ?>

<div class="row">
<?php
foreach($finalPhotos as $finalPhoto) {
    echo '<div class="col-lg-6" data-img-src="'.WEBSITE_LINK.'data'.DS.'master'.DS.$finalPhoto->MASTER_ID.'.jpg" data-img-dest="'.WEBSITE_LINK.'data'.DS.'valid'.DS.$finalPhoto->VALID_ID.'.jpg" data-project-title="'.$finalPhoto->SUBJECT.'">';
    echo '<img src="'.WEBSITE_LINK.'data'.DS.'master'.DS.$finalPhoto->MASTER_ID.'.jpg" alt="Photo">';
    echo '</div>';
    echo '<div class="col-lg-6" data-img-src="'.WEBSITE_LINK.'data'.DS.'valid'.DS.$finalPhoto->VALID_ID.'.jpg" data-img-dest="'.WEBSITE_LINK.'master'.DS.'valid'.DS.$finalPhoto->MASTER_ID.'.jpg" data-project-title="'.$finalPhoto->SUBJECT.'">';
    echo '<img src="'.WEBSITE_LINK.'data'.DS.'valid'.DS.$finalPhoto->VALID_ID.'.jpg" alt="Photo">';
    echo '</div>';
}
?>
</div>

<script type="text/javascript">
    $(function(){
        $("[data-img-src][data-img-dest]")
            .css("cursor", "pointer")
            .click(function() {
                var from = $(this);
                var title = $(this).attr("data-project-title");
                $(this).find("img").clone()
                    .css("margin", "auto")
                    .css("position", "relative")
                    .css("display", "block")
                    .css("cursor", "pointer")
                    .click(function() {
                        var src = from.attr("data-img-src");
                        var dest = from.attr("data-img-dest");
                        alert(src);
                        alert(dest);
                        if ($(this).attr("src") == src) {
                            $(this).attr("src", dest);
                        } else {
                            $(this).attr("src", src);
                        }
                    })
                    .dialog({
                        modal: true,
                        width: "90%",
                        title: title
                    });
        })
    })
</script>

<?php require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");?>
