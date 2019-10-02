<?php
require "../includes/db.php";
$data=$_POST;
if (isset($data['submit_add']))
{
    $errors=array();
    if (trim($data['txt1'])=='')
    {
        $errors[]='Введіть питання!';
    }
    if (empty($errors))
    {
        $ask=R::dispense('asks');
        $ask->text=$data['txt1'];
        $ask->iduser=$_SESSION['logged_user'];
        $ask->capcha='0';
        $ask->idquestion=$_GET['id'];
        R::store($ask);
        header('Location: index.php?id='.$_GET['id'].'');
    }else
    {
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}

?>
<!DOCTYPE html>
<html land="en">
<head>
    <meta charset="utf-8">
    <title>
        Питання - відповідь
    </title>
    <link rel="stylesheet" type="text/css" href="css/style.css" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css" charset="utf-8">
    <meta name="description" content="Інформаційно - розважальний портал">
    <meta name="keywords" content="Питання - відповідь">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="img/" rel="shortcut icon" type="image/x-icon">
</head>
<body class="colors">
<header>
    <div id="logo" >
        <a href="../index.php" title="На головну">
            <img src="../img/qr.jpg" title="" alt="Питання - відповідь">
            <span>Питання - відповідь</span>
        </a>
    </div>
    <?php
        if (isset($_SESSION['logged_user'])) : ?>
       <div id="user"> Привіт, <?php echo $_SESSION['logged_user']->login; ?>
        <a href="../includes/logout.php">Вийти</a></div>
        <div id="reg_auth">
            <a href="../index.php" titel="На головну">
                <div class="btn">
                    Назад
                </div>
            </a>
        </div>
        </div>
    <?php
    else:
        ?>
        <div id="reg_auth">
            <a href="../authorization/index.php" titel="Війти в кабінет користувача">
                <div class="btn">
                    Вхід
                </div>
            </a>
            <a href="../registration/index.php" title="Зареєструватися на сайті">
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
    <div class="a">
        <img src="../img/Вопрос.gif">
        <img src="../img/v.gif">
    </div>
    <div >
        <form enctype="multipart/form-data" method="post">

            <ul id="edit_tov">
                <li>
                <p>
                    <?php
                    $questions=R::findOne('questions','id=?',[$_GET['id']]);
                    echo $questions->text.'<br>';
                    ?>
                </p>
                    <?php
                    if (isset($_SESSION['logged_user'])) : ?>
                    <textarea id="editor" name="txt1" cols="100" rows="20" required="required" ></textarea>
                </li>
            </ul>

            <p align="right"><input type="submit" id="submit_form" name="submit_add" value="Добавити відповідь">
            </p>
            <?php
            else:
            ?>
                <ul id="edit_tov">
                    <li>
                    <p>
                        Зареєструйтесь щоб дати відповідь!!!!
                    </p>

                    </li>
                </ul>

            <?php
            endif;
            ?>
        </form>

        <?php
        $capcha=1;
        $asks=R::find('asks','idquestion=? AND capcha=?',[$_GET['id'],$capcha]);
        foreach ($asks as $ask1){
            $users=R::find('users','id=?',[$ask1->iduser_id]);
        foreach ($users as $user)
            echo ' 
        <p class="p" align="left"> '.$user->login.'<br>
        </p>
        <label class="p" > '.$ask1->text.'<br></label>
         ';}?>
    </div>
    <div class="a">
        <img src="../img/smile2.jpg">
        <img src="../img/smile1.jpg">
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