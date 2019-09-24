<?php
require "../includes/db.php";
$data=$_POST;
if ((isset($_SESSION['logged_user']))||(isset($data['submit'])))
{
    header('Location: /');
}
if (isset($data['do_signup']))
{
    $errors=array();
    if (trim($data['username'])=='')
    {
        $errors[]='Введіть імя!';
    }
    if (trim($data['password'])=='')
    {
        $errors[]='Введіть пароль!';
    }
    if (trim($data['email'])=='')
    {
        $errors[]='Введіть email!';
    }
    if (R::count('users',"login= ? OR email= ?",array($data['username'],$data['email']))>0)
    {
        $errors[]='Користувач з таким логіном або email вже існує';
    }
    if (empty($errors))
    {
        $user=R::dispense('users');
        $user->login=$data['username'];
        $user->password=password_hash($data['password'],PASSWORD_DEFAULT);
        $user->email=$data['email'];
        R::store($user);
        header('Location: /authorization/index.php');
    }else
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
	
<form name="login-form" class="login-form" action="/registration/index.php" method="post">

    <div class="header">
		<h1>Реєстрація</h1>
		<span>Введіть ваші реєстраційні дані </span>
    </div>

    <div class="content">
		<input name="username" type="text" class="input username" placeholder="Логін" value="<?php echo @$data['username']?>"  />
		<input name="password" type="password" class="input password" placeholder="Пароль" value="<?php echo @$data['password']?>" />
		<input name="email" type="email" class="input email" placeholder="Email" value="<?php echo @$data['email']?>" />
    </div>

    <div class="footer">
		<input type="submit" name="do_signup" value="Підтвердити" class="button" />
		<input type="submit" name="submit" value="Назад" class="register" />
    </div>

</form>
</div>
<div class="gradient"></div>

<script type="text/javascript" src="js/js.js"></script>
</body>
</html>