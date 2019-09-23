<?php
require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=askquestions',
    'root', '' );
session_start();
?>
<!DOCTYPE html>
<html land="en">
<head>
	<meta charset="utf-8">
	<title>
		Питання - відповідь
	</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" charset="utf-8">
	<meta name="description" content="Інформаційно - розважальний портал">
	<meta name="keywords" content="Питання - відповідь">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="img/" rel="shortcut icon" type="image/x-icon">
</head>
<body>
	<header>
		<div id="logo" >
			<a href="index.php" title="На головну">
				<img src="img/qr.jpg" title="" alt="Питання - відповідь">
				<span>Питання - відповідь</span>
			</a>
		</div>
        <?php
        if (isset($_SESSION['logged_user'])) : ?>
        Привіт, <?php echo $_SESSION['logged_user']->login; ?>
        <a href="/includes/logout.php">Вийти</a>
        <?php
        else:
        ?>
		<div id="reg_auth">
			<a href="authorization/index.php" titel="Війти в кабінет користувача">
				<div class="btn">
					Вхід
				</div>
			</a>
			<a href="registration/index.php" title="Зареєструватися на сайті">
				<div class="btn">
					Реєстрація
				</div>
			</a>
		</div>
        <?php
        endif;
        ?>
	</header>
		<div class="wrapper">
			<a href="">dxcfvgbhjk</a><br>
			sdfcgvhbjnkm
		</div>
		<div class="wrapper">
			<a href="">gvbhijnkm</a> <br>
			fcvgbhjnkm
		</div>
		<div class="wrapper">
			<a href="">cvgbhnjmk</a><br>
			rfygvubhnjlkm
		</div>
		<div class="wrapper">
			<a href="">dxcfvgbhjk</a><br>
			sdfcgvhbjnkm
		</div>
		<div class="wrapper">
			<a href="">dxcfvgbhjk</a><br>
			sdfcgvhbjnkm
		</div>
		<div class="wrapper">
			<a href="">dxcfvgbhjk</a><br>
			sdfcgvhbjnkm
		</div>
</body>
</html>