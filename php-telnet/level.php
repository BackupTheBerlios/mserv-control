<?php

  require_once "mserv.class.php";
  require_once "config.inc.php";


  $ms = new MServ($g_host, $g_port, $g_user, $g_pass);
  if ($p_action == "vol") {
    $ms->setVolume($p_value);
  }
  if ($p_action == "bas") {
    $ms->setBass($p_value);
  }
  if ($p_action == "tre") {
    $ms->setTreble($p_value);
  }
  
  header ("Location: " . $HTTP_SERVER_VARS["HTTP_REFERER"]);
?>