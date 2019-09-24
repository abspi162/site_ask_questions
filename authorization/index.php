<?php
require "../includes/db.php";
$data=$_POST;
if ((isset($_SESSION['logged_user']))||(isset($data['submit'])))
{
    header('Location: /registration/index.php');
}
if (isset($data['do_login']))
{
    $errors=array();
    $user=R::findOne('users','login =?',array($data['username']));
    if (($data['username']=='admin')&&($data['password']=='admin')) {
        $_SESSION['admin']='admin';
        header('Location: ../admin/index.php');
    }
    else
    if ($user)
    {
        if (password_verify($data['password'],$user->password))
        {
            $_SESSION['logged_user']=$user;
            header('Location: /');
        }
        else
        {
            $errors[]='Не вірний пароль!';
        }
    }else
    {
        $errors[]='Користувач з таким логіном не знайдений!';
    }
    if (!empty($errors))
    {
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Вхід</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
	<link rel="icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="http://vladmaxi.net/favicon.ico" type="image/x-icon">
</head>
<body>

<div id="wrapper">
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
	
<form name="login-form" class="login-form" action="/authorization/index.php" method="post">

    <div class="header">
		<h1>Авторизація</h1>
		<span>Введіть ваші реєстраційні дані </span>
    </div>

    <div class="content">
		<input name="username" type="text" class="input username" placeholder="Логін" value="<?php echo @$data['username']?>"  />
		<input name="password" type="password" class="input password" placeholder="Пароль" value="<?php echo @$data['password']?>"  />
    </div>

    <div class="footer">
		<input type="submit" name="do_login" value="Ввійти" class="button" />
		<input type="submit" name="submit" value="Реєстрація" class="register" />
    </div>

</form>
</div>
<div class="gradient"></div>

<script type="text/javascript" src="js/js.js"></script>
</body>
</html>