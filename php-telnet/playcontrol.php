<?php
  require_once "mserv.class.php";
  require_once "config.inc.php";

  $ms = new MServ($g_host, $g_port, $g_user, $g_pass);

  $ms->PlayControl($p_action);
  header ("Location: " . $HTTP_SERVER_VARS["HTTP_REFERER"]);


?>