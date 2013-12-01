<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

	<title>Piczle.me </title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="<?php echo WEBSITE_LINK ?>public/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo WEBSITE_LINK ?>public/css/main.css">

	<!-- Custom styles for this template -->
	<link href="<?php echo WEBSITE_LINK ?>public/css/jumbotron-narrow.css" rel="stylesheet">



	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css" />

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo WEBSITE_LINK; ?>public/js/dragOn/dragOn.src.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
	<script type="text/javascript" src="<?php echo WEBSITE_LINK; ?>public/js/crop.js"></script>
	<script type="text/javascript">
		$(function() {
			$("a.login-link").click(function() {
				$("<div>").load("<?php echo WEBSITE_LINK ?>users/login").dialog({
					title:"Connexion",
					modal: true
				});
				return false;
			});
		})
	</script>
</head>

<body>
	<div class="container">

		<div class="jumbotron">
			<div class="login">
				<?php if (isset($_SESSION["login"])): ?>
					<a href="<?php echo WEBSITE_LINK ?>users/logout">
						<li class="glyphicon glyphicon-off"></li>
					</a>
				<?php else: ?>
					<a class="login-link" href="#">
						<li class="glyphicon glyphicon-user"></li>
					</a>
				<?php endif; ?>
			</div>
			<a id="logo" href="<?php echo WEBSITE_LINK ?>">
				<img src="<?php echo WEBSITE_LINK ?>public/img/Piczle_Me_v02.png" alt="Piczle Me"/>
			</a>
			<p class="lead"></p>
			<?php if (HOME): ?>
				<p>
					<a class="btn btn-warning" href="<?php echo WEBSITE_LINK ?>master" role="button">Créer un projet</a>
					<a class="btn btn-warning" href="<?php echo WEBSITE_LINK ?>projects" role="button">Participer à un projet</a>
				</p>
			<?php else: ?>
				<div id="bubble">
					<span id="text">
						<?php if (isset($titre) AND !empty($titre)): ?>
							<?php echo $titre; ?>
						<?php elseif (flashExist()): ?>				
							<?php getFlash(); ?>
						<?php elseif (isset($message) AND !empty($message)): ?>
							<?php echo $message; ?>
						<?php elseif (isset($_SESSION["login"])): ?>
							Bonjour <?php echo $_SESSION["login"]; ?> !
						<?php else: ?>
							Bonjour visiteur !
						<?php endif ?>
						<?php echo (isset($titre) AND !empty($titre)) ? $titre : getFlash(); ?>
					</span>
					<span id="arrow_border"></span>
					<span id="arrow_inner"></span>
				</div>	
			<?php endif ?>
			<div class="clear"></div>
		</div>
			<?php getFlash(); ?>

		<center>