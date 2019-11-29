<?php
  session_start();

echo <<<_INIT
<!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link rel='stylesheet' href='style.css' type='text/css'>

_INIT;

  require_once 'functions.php';

  $userstr = 'Добро пожаловать';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = "Вход выполнен: $user";
  }
  else $loggedin = FALSE;

echo <<<_MAIN
    <title>ThreeBla | $userstr</title>
  </head>
  <body>
  <header>
        <div id='logo' class='center'>Three<a href="index.php"><img id='ima' src='img/23.png'></a>Bla</div>
      </header>
    <div class="main">
      
      <div>

_MAIN;

  if ($loggedin)
  {
echo <<<_LOGGEDIN
        <div class='center ho'>
          <a href='members.php?view=$user'><button class="lin home"><img src="images/icons-png/home-white.png" class="imar">&nbsp&nbsp&nbsp&nbspДомой&nbsp&nbsp&nbsp&nbsp&nbsp</button></a>
          <a href='members.php'><button class="lin"><img src="images/icons-png/user-white.png" class="imar">Пользователи</button></a>
          <a href='friends.php'><button class="lin"><img src="images/icons-png/heart-white.png" class="imar">&nbsp&nbsp&nbsp&nbspДрузья&nbsp&nbsp&nbsp&nbsp</button></a>
          <a href='messages.php'><button class="lin"><img src="images/icons-png/mail-white.png" class="imar">&nbspСообщения</button></a>
          <a href='profile.php'><button class="lin"><img src="images/icons-png/edit-white.png" class="imar">&nbsp&nbsp&nbspПрофиль&nbsp&nbsp&nbsp&nbsp&nbsp</button></a>
          <a href='logout.php'><button class="lin"><img src="images/icons-png/action-white.png" class="imar">&nbsp&nbsp&nbsp&nbspВыход&nbsp&nbsp&nbsp&nbsp&nbsp</button></a>
        </div>
        
_LOGGEDIN;
  }
  else{

echo <<<_GUEST
        <div class='center'>
        <p id="hat"></p>
          <form action="index.php" method="post">
          <input type='text' name="user" placeholder="Логин" class="inp">
          <input type='password' name="pass" placeholder="Пароль" class="inp"><br>
          <input type='submit' value="Войти" id="log" class="bit">
          <a href="#">Забыли пароль?<a><br><br>
          </form>
          <div>Впервые в ThreeBla?<br><br>
          <a href='signup.php'><button id="regis" class="bit">Зарегестрировться</button></a></div>
        </div>
_GUEST;
  }
?>
