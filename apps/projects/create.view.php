<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");
?>

<button id="ajouter">Ajoutez un crop de Piczle</button>
	<section id="mainPhoto" style="background-image: url('<?php echo WEBSITE_LINK; ?>data/master/<?php echo $photoMaster->ID; ?>.jpg'); width:<?php echo $photoMaster->WIDTH; ?>px; height:<?php echo $photoMaster->HEIGHT; ?>px"></section>

	<form action="" method="post" id="form">
		<label for="subject">Titre de votre projet</label><input type="text" id="subject" name="subject" />
		<input type="submit" onclick="genererFormulaire();" value="Créer mon projet !" />
	</form>


<?php
require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>