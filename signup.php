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

  $userstr = 'Welcome Guest';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = "Logged in as: $user";
  }
  else $loggedin = FALSE;

echo <<<_MAIN
    <title>ThreeBla: $userstr</title>
  </head>
  <body>
  <header>
        <div id='logo' class='center'>Three<a href="index.php"><img id="ima" src='картинки/23.png'></a>Bla</div>
      </header>
    <div class="main">
      <div data-role='content'>

_MAIN;

echo <<<_END
  <script>
    function checkUser(user)
    {
      if (user.value == '')
      {
        $('#used').html('&nbsp;')
        return
      }
      var req = new XMLHttpRequest();
      req.open("POST", 'checkuser.php', true);
      req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      req.send("user="+user.value);
      req.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById('used').innerHTML = this.responseText;
      }
      }
    }
  </script>  
_END;

  $error = $user = $pass = "";
  if (isset($_SESSION['user'])) destroySession();

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
      $error = 'Не все поля заполнены<br><br>';
    else
    {
      $result = queryMysql("SELECT * FROM members WHERE user='$user'");

      if ($result->num_rows)
        $error = 'Это имя уже используется!<br><br>';
      else
      {
        queryMysql("INSERT INTO members VALUES('$user', '$pass')");
        $_SESSION['user']=$user;
        $_SESSION['pass']=$pass;
        echo "<script>
                  window.location.href= 'members.php';
              </script>";
      }
    }
  }

echo <<<_END
      <div><h1 class="req2">Информация профиля</h1>
      <h2 class="req3">Пожалуйста укажите данные для регистрации.</h2></div>
      <form method='post' action='signup.php'><span class="mar">$error</span>
      <div>
        <label f or="us"><span class="req2">Логин</span></label>
        <input type='text' id="us" maxlength='16' name='user' value='$user'onBlur='checkUser(this)' class="inp2" autofocus><br>
      <span id='used' style="color:#7eadbe;">.</span>
        <div><label for="pas"><span class="req2">Пароль</span></label>
        <input type='text' maxlength='16' name='pass' value='$pass' id="pas" class="inp3"></div>
      <div>
         <input type='submit' value='Зарегистрироваться' id="regis" class="bit bit3">
      </div>
      </div>
      <p class="rty">................................................................................................................</p>
      <footer>
    <nav>
      <h4>ThreeBla 2019-2019</h4>
      <a href="#">English</a>
      <a href="#">Українська</a>
      <a href="#">all languages »</a><br>
     <p><a href="#">    Версия для компьютера</a></p> 
     </nav>
    </footer>
    </div>
  </body>
</html>
_END;
?>
