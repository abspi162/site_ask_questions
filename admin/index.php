<?php
require "../includes/db.php";
if (!(isset($_SESSION['admin'])))
{
    header('Location: /');
}
?>
<html land="en">
<head>
	<meta charset="utf-8">
	<title>
	</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" charset="utf-8">
	<meta name="description" content="Інформаційно - розважальний портал">
	<meta name="keywords" content="Питання - відповідь">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="img/" rel="shortcut icon" type="image/x-icon">
</head>
<body>
<div id="block-body">
    <div id="block-header">
        <div id="block-header1">
          <h3>Питання-відповідь. <br>Панель управління</h3>
            <p id="link-nav"></p>
        </div>
        <div id="block-header2">
          <p align="right"><a href="">Администратор</a> | <a href="../includes/logout.php">Вихід</a></p>
          <p align="right">Ви - Admin<span></span></p>
        </div>
    </div>
    <div id="left-nav" >
        <ul>
            <li><a href=""> Користувачі </a></li>
            <li><a href=""> Питання</a> </li>
            <li><a href=""> Питання-відповіді </a> </li>
        </ul>
    </div>
    <div id="block-content">

    </div>
</div>
</body>
</html>