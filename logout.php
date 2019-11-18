<?php
  require_once 'header.php';

  if (isset($_SESSION['user']))
  {
    destroySession();
    echo "<br><div class='center'>Вы можете выйти. Пожалуйста
         <a href='index.php'>нажмите здесь</a>
         что-бы покинуть страницу.</div>";
  }
  else echo "<div class='center'>Вы ине можете выйти пока не зарегестрируетесью.</div>";
?>
    </div>
  </body>
</html>
