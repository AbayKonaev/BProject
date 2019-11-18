<?php // Example 26-7: login.php
  require_once 'header.php';
  $error = $user = $pass = "";

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    
    if ($user == "" || $pass == "")
      $error = 'Не все поля заполнены';
    else
    {
      $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "Неверная попытка входа.";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        die("<div class='center'>
          <script>
                  window.location.href= 'members.php';
              </script>
          </div></div></body></html>");
      }
    }
  }
if (!isset($_SESSION['user'])){
echo <<<_END
      <form method='post' action='login.php'>
        <div'>
          <label></label>
          <span class='error'>$error</span>
        </div>
        <div>
          <label></label>
          Please enter your details to log in
        </div>
        <div>
          <label>Username</label>
          <input type='text' maxlength='16' name='user' value='$user'>
        </div>
        <div>
          <label>Password</label>
          <input type='password' maxlength='16' name='pass' value='$pass'>
        </div>
        <div>
          <label></label>
          <input type='submit' value='Login'>
        </div>
      </form>
    </div>
  </body>
</html>
_END;
}
else echo <<<_END
      
    </div>
  </body>
</html>
_END;
?>
