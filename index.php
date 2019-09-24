<?php
require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=askquestions',
    'root', '' );
session_start();
$data=$_POST;
if (isset($data['nomer']))

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
<body class="colors">
	<header>
		<div id="logo" >
			<a href="index.php" title="На головну">
				<img src="img/qr.jpg" title="" alt="Питання - відповідь">
				<span>Питання - відповідь</span>
			</a>
		</div>
        <?php
        if (isset($_SESSION['logged_user'])) : ?>
        <div id="user">Привіт, <?php echo $_SESSION['logged_user']->login; ?>
        <a href="/includes/logout.php">Вийти</a></div>
            <div id="reg_auth">
                <a href="add/ind.php" titel="Добавити питання">
                    <div class="btn">
                        Добавити
                    </div>
                </a>
            </div>
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
<div class="grid">
<div>
    <img src="img/Вопрос.gif">
    <img src="img/v.gif">
</div>
    <div >
    <?php
            $capcha=0;
            $questions=R::find('questions','capcha=?',[$capcha]);
            foreach ($questions as $question)
            echo ' 
        <a href="coment/index.php?id='.$question->id.'" name="nomer">
                '.$question->text.'<br>
        </a>
   ';?>
    </div>
    <div>
        <img src="img/smile2.jpg">
        <img src="img/smile1.jpg">
    </div>
</div>

<footer>
    <span class="left">
        Всі права захищені &copy; 2019
    </span>
    <span class="right">
        Соц. кнопки
    </span>
</footer>
</body>
</html>