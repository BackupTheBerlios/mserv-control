<script LANGUAGE="javascript">

<!--
function popup(path,x,y)
{
	pop=window.open(path,'control','directories=0,location=0,menubar=0,resizable=0,scrollbars=0,status=0,toolbar=0,locationbar=0,width='+x+',height='+y+',innerwidth='+x+',innerheight='+y);
	pop.focus();
}
//-->
</script>


<?php
  if (!isset($p_extra)) {
    $p_extra = "empty";
  }
  if ($p_extra == "is_mini") {
    echo "<html><HEAD>\r\n";
    echo "<title>Mini Control</title>\r\n";
    echo "</HEAD>\r\n";
  }  

  
  require_once "mserv.class.php";
  require_once "config.inc.php";
  require_once "misc.inc.php";
  getHTMLHeader();

 
  $ms = new MServ($g_host, $g_port, $g_user, $g_pass);
  if (!$ms->isServeronline()) {
    echo "Server not found !";
    die;
  }  

  $res_test = $ms->getLevels();
  echo "<PRE>";
  echo "Volume  : " . $res_test['vol'] . " <a href=\"level.php?p_action=vol&p_value=" . urlencode("+3") . "\">[+3]</a> <a href=\"level.php?p_action=vol&p_value=-3\">[-3]</a> ";
  echo "<a href=\"level.php?p_action=vol&p_value=0\">[00]</a>";  
  echo "<a href=\"level.php?p_action=vol&p_value=60\">[60]</a><br>";  
  echo "Bass    : " . $res_test['bas'] . " <a href=\"level.php?p_action=bas&p_value=" . urlencode("+5") . "\">[+5]</a> <a href=\"level.php?p_action=bas&p_value=-5\">[-5]</a>  <br>";  
  echo "Treble  : " . $res_test['tre'] . " <a href=\"level.php?p_action=tre&p_value=" . urlencode("+5") . "\">[+5]</a> <a href=\"level.php?p_action=tre&p_value=-5\">[-5]</a>  <br>";  
  echo "<a href=\"playcontrol.php?p_action=PLAY\">[PLAY]</a> ";
  echo "<a href=\"playcontrol.php?p_action=PAUSE\">[PAUSE] </a>";
  echo "<a href=\"playcontrol.php?p_action=STOP\">[STOP] </a>";
  echo "<a href=\"playcontrol.php?p_action=NEXT\">[NEXT]</a>";
  echo "<br>";
      echo "Rate :";
      echo " <a href=\"rate.php?p_album_nr=&p_track_nr=&p_value=SUPERB\">[S]</a>";
      echo " <a href=\"rate.php?p_album_nr=&p_track_nr=&p_value=GOOD\">[G]</a>";
      echo " <a href=\"rate.php?p_album_nr=&p_track_nr=&p_value=NEUTRAL\">[N]</a>";
      echo " <a href=\"rate.php?p_album_nr=&p_track_nr=&p_value=BAD\">[B]</a>";
      echo " <a href=\"rate.php?p_album_nr=&p_track_nr=&p_value=AWFUL\">[A]</a>";
  echo "<br>";
  if ($p_extra != "is_mini") {
    echo "<a href=\"javascript:popup('playbar.php?p_extra=is_mini', 260, 130)\">Mini Control</a>";
  }  

 
 
  echo "</PRE>";

  getHTMLFooter();
  
?>
 