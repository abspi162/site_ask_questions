<?php
require "../includes/db.php";

if (!(isset($_SESSION['admin']))  )
{
    header('Location: /');
}

$data=$_POST;
if (isset($data['delluser'])){
    $id = key($_POST['delluser']);
    $usr = R::load('users', $id);
    R::trash($usr);
    header('Location: /admin/index.php?id=1');
}

if (isset($data['dellq'])){
    $id = key($_POST['dellq']);
    $que = R::load('questions', $id);
    R::trash($que);
    header('Location: /admin/index.php?id=2');
}
if (isset($data['confirm'])){
    $id = key($_POST['confirm']);
    $cn = R::load('questions', $id);
    $cn->capcha = 1;
    R::store($cn);
    header('Location: /admin/index.php?id=2');
}

if (isset($data['confa'])){
    $id = key($_POST['confa']);
    $cn = R::load('asks', $id);
    $cn->capcha = 1;
    R::store($cn);
    header('Location: /admin/index.php?id=3');
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
            <li><a href="index.php?id=1" id="users"> Користувачі </a></li>
            <li><a href="index.php?id=2" id="questions"> Питання</a> </li>
            <li><a href="index.php?id=3" id="answers"> Питання-відповіді </a> </li>
        </ul>
    </div>
    <div id="block-content">


        <div id="user" >
            <?php
            $users=R::findAll('users');
            foreach ($users as $user)
                echo"
                    <div id='user2'>
                        <label><strong></strong>Логін: ".$user->login."</label> <br> 
                        <label><strong></strong> Емайл: ".$user->email."</label>
                        <form enctype=\"multipart/form-data\" method=\"post\">
                         <input type='submit' name='delluser[".$user->id."]' value='Bидалити' > </form>
                     </div>
                 "


         ;?>
        </div>

            <div id="question" hidden = "true">
                <label id="lbl">Питання</label>
                <?php
                $questions=R::findAll('questions' );
                foreach ($questions as $question){
                    echo "
                <div id='q1'>
                    <div id='q2'>
                        <label><strong></strong> ".$question->text."</label>   
                     </div>
                 </div>
                 <form id='qqq' enctype='multipart/form-data' method='post'>
                <input type='submit' id='dlq' name='dellq[".$question->id."]' value='Bидалити' > ";
                    if ($question->capcha == 0)
                        echo "<input type='submit' id='conf' name='confirm[".$question->id."]' value='Підтвердити' > ";
                  echo "</form>";
                    ;}?>
            </div>


            <div id="answer" hidden = true>
                <label id="lbl">Відповіді</label>
                <?php
                    $questions=R::findAll('questions' );
                    foreach ($questions as $question){
                        echo "
                            
                                     <div id='block'>
                                     <a  id='ab".$question->id."' onclick=hider('ab".$question->id."',".$question->id.");> <h2><strong></strong> ".$question->text."</h2></a>
                                            
                                     ";
                                            $ask = R::findAll('asks');
                                            echo"<div id = '$question->id' hidden = false >";
                        $n = 0;
                                            foreach ($ask as $as){

                                                if($question->id == $as->idquestion){
                                                    $n++;
                                                    echo "<div id='txt'></div><div>$n. $as->text</labe></div><br>";
                                                    if ($as->capcha == 0) {echo "
                                                    <form enctype='multipart/form-data' method='post'>
                                                    <input type='submit' id='conf' name='confa[".$as->id."]' value='Підтвердити' ><br>
                                                    </form>" ;};

                                                };


                                            };

                                if ($n == 0){
                                    echo "<div id='txt'></div><div>Відповідей ще немає</labe></div><br>";
                                };
                        echo"</div></div>";
                             ;}

                ?>
            </div>
    </div>
    <script src="js/script.js"></script>


</body>

</html>