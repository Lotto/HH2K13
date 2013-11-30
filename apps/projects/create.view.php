<script src="http://localhost/HH2K13/tpl/js/jquery.js"></script>
<script src="http://localhost/HH2K13/tpl/js/dragOn/dragOn.src.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
<script src="http://localhost/HH2K13/tpl/js/crop.js"></script>

<style>
	#mainPhoto {
		background-image: url('test.jpeg');
	}
	.sousPhoto{
		float: left;
		width: 100px;
		height: 100px;
		background-color: rgba(234, 136, 37, 0.5);
		position: absolute;
	}
</style>
<button id="ajouter">Ajoutez une sous photo</button>
	<section id="mainPhoto" style="background-image: url('http://localhost/HH2K13/data/master/<?php echo $photoMaster->ID; ?>.jpg'); width:<?php echo $photoMaster->WIDTH; ?>px; height:<?php echo $photoMaster->HEIGHT; ?>px"></section>

	<form action="" method="post" id="form">
		<label for="subject">Titre de votre projet</label><input type="text" id="subject" name="subject" />
		<input type="submit" onclick="genererFormulaire();" value="Créer mon projet !" />
	</form>