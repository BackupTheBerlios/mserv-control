<?php

  require_once "mserv.class.php";
  require_once "config.inc.php";


  $ms = new MServ($g_host, $g_port, $g_user, $g_pass);

  echo "<a href=\"" . $HTTP_REFERER . "\">[Back]</a><br><br>\r\n";
  echo "<PRE>";
  echo "INFO : " . $ms->getInfo($p_album_nr, $p_track_nr, "<br>") . "<BR>";


?>