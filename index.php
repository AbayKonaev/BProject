<?php
  require_once 'header.php';
  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    
    if ($user == "" || $pass == "")
      $error = 'Not all fields were entered';
    else
    {
      $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "Invalid login attempt";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        die("<div class='center'>
          <script>
                  window.location.href= 'members.php';
              </script>
          </div></body></html>");
      }
    }
  }
	echo "<div class='center'>";
  if ($loggedin) echo " <script>document.getElementById('hat').innerHTML = '$userstr в ThreeBla,$user, you are logge in.';</script>";
  else echo " <script>document.getElementById('hat').innerHTML = '$userstr в ThreeBla,войдите в свою учетную запись или зарегестрируйтесь.';</script>";
  echo <<<_END
      </div><br>
    </div>
    <p class="rty doptot">.......................................................................................................<span class="dopdot">.........</span></p>
    <footer>
    <nav>
      <h4>ThreeBla 2019-2019</h4>
      <a href="#">English</a>
      <a href="#">Українська</a>
      <a href="#">all languages »</a><br>
     <p><a href="#">Версия для компьютера</a></p>	
     </nav>
    </footer>
  </body>
</html>
_END;
?>
