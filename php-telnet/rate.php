<?php

  require_once "mserv.class.php";
  require_once "config.inc.php";


  $ms = new MServ($g_host, $g_port, $g_user, $g_pass);

  $ms->Rate($p_album_nr, $p_track_nr, $p_value) . "<BR>";
  header ("Location: " . $HTTP_SERVER_VARS["HTTP_REFERER"]);


?>