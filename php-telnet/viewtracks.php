<?php

  require_once "mserv.class.php";
  require_once "config.inc.php";


  $ms = new MServ($g_host, $g_port, $g_user, $g_pass);

  getHTMLHeader();


  echo "<a href=\"" . $HTTP_REFERER . "\">[Back]</a><br><br>\r\n";

  echo "<PRE>";
  $albumlist = explode ("<br>", $ms->getTrackList($p_album_nr, "<br>"));
  foreach ($albumlist as $test) {
    //  echo $test . "<br>";
    if (eregi($p_album_nr . "\t([0-9]+)\t([^\t]+)\t([^\t]+)\t([^\t]+)\t([0-9]+\:[0-9]+)", $test, $regexp_res)) {
      $track_number = $regexp_res[1];
      $padded_track_number = $track_number;
      while (strlen($padded_track_number) < 3) {
        $padded_track_number = " " . $padded_track_number;
      }
      $track_author = $regexp_res[2];
      $track_title  = $regexp_res[3];
      $track_rating = substr($regexp_res[4], 0, 1);
      $track_time   = $regexp_res[5];
      echo "$padded_track_number [$track_rating] $track_author <a href=\"trackinfo.php?p_album_nr=$p_album_nr&p_track_nr=" . $track_number . "\">$track_title</a> - $track_time";
      echo " RATE : <a href=\"rate.php?p_album_nr=$p_album_nr&p_track_nr=" . $track_number . "&p_value=SUPERB\">SUPERB</a>";
      echo " <a href=\"rate.php?p_album_nr=$p_album_nr&p_track_nr=" . $track_number . "&p_value=GOOD\">GOOD</a>";
      echo " <a href=\"rate.php?p_album_nr=$p_album_nr&p_track_nr=" . $track_number . "&p_value=NEUTRAL\">NEUTRAL</a>";
      echo " <a href=\"rate.php?p_album_nr=$p_album_nr&p_track_nr=" . $track_number . "&p_value=BAD\">BAD</a>";
      echo " <a href=\"rate.php?p_album_nr=$p_album_nr&p_track_nr=" . $track_number . "&p_value=AWFUL\">AWFUL</a>";
      echo "<br>\r\n";
    }  
  }
  

  getHTMLFooter();

?>