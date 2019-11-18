<?php
  require_once 'header.php';

  if (!$loggedin) die("</div></body></html>");

  if (isset($_GET['view']))
  {
    $view = sanitizeString($_GET['view']);
    
    if ($view == $user) $name = "Ваш";
    else                $name = "$view's";
    
    echo "<h3 class='mar'>$name Профиль</h3>";
    showProfile($view);
    echo "<a href='messages.php?view=$view' class='mar'>Посмотреть $name  сообщения</a>";
    die("</div></body></html>");
  }

  if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
    if (!$result->num_rows)
      queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
  }
  elseif (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
  }

  $result = queryMysql("SELECT user FROM members ORDER BY user");
  $num    = $result->num_rows;

  echo "<h3 class='bers mar'>Другие пользователи:</h3><ul>";

  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['user'] == $user) continue;
    
    echo "<li class='mar'><a href='members.php?view=" . $row['user'] . "'>" . $row['user'] . "</a>";
    $follow = "Добавить";

    $result1 = queryMysql("SELECT * FROM friends WHERE user='" . $row['user'] . "' AND friend='$user'");
    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM friends WHERE user='$user' AND friend='" . $row['user'] . "'");
    $t2      = $result1->num_rows;

    if (($t1 + $t2) > 1) echo " &harr; вы взаимно подписаны";
    elseif ($t1)         echo " &larr; вы подписаны";
    elseif ($t2)       { echo " &rarr; ваш подпсичик";
                         $follow = "Подписаться"; }
    
    if (!$t1) echo " [<a href='members.php?add=" . $row['user'] . "'>$follow</a>]";
    else      echo " [<a href='members.php?remove=" . $row['user'] . "'>Удалить</a>]";
  }
?>
    </ul></div>
  </body>
</html>
