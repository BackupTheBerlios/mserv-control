<?php
  require_once "mserv.class.php";
  require_once "config.inc.php";
  require_once "misc.inc.php";

  getHTMLHeader();

  $ms = new MServ($g_host, $g_port, $g_user, $g_pass);

  if (!$ms->isServeronline()) {
    echo "Server not found !";
    die;
  }  
  echo "<PRE>\r\n";

  $albumlist = explode ("<br>", $ms->getAlbumList("<br>"));
  foreach ($albumlist as $temp) {
    if (eregi("^([0-9]+)\t([^\t]+)\t(.*)", $temp, $regexp_res)) {
      echo " <a href=\"queue.php?p_album_nr=" . $regexp_res[1] . "&p_track_nr=\">[Q]</a>";
      echo " <a href=\"queue.php?p_album_nr=" . $regexp_res[1] . "&p_track_nr=&p_random=1\">[Q R]</a>";
      
      echo " RATE :";
      echo " <a href=\"rate.php?p_album_nr=" . $regexp_res[1] . "&p_track_nr=&p_value=SUPERB\">[S]</a>";
      echo " <a href=\"rate.php?p_album_nr=" . $regexp_res[1] . "&p_track_nr=&p_value=GOOD\">[G]</a>";
      echo " <a href=\"rate.php?p_album_nr=" . $regexp_res[1] . "&p_track_nr=&p_value=NEUTRAL\">[N]</a>";
      echo " <a href=\"rate.php?p_album_nr=" . $regexp_res[1] . "&p_track_nr=&p_value=BAD\">[B]</a>";
      echo " <a href=\"rate.php?p_album_nr=" . $regexp_res[1] . "&p_track_nr=&p_value=AWFUL\">[A]</a>";

      echo "  $regexp_res[2] <a href=\"viewtracks.php?p_album_nr=" . $regexp_res[1] . "\">$regexp_res[3]</a>";

      echo "<br>\r\n";
    }  
  }
    
  
  getHTMLFooter();

?>  