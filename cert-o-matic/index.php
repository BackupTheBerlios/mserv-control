<html>
  <head>
    <title> Cert - O - Matic    -==-    Automated RUS-CERT bug checker </title>
  </head>
<link rel="stylesheet" href="style.css" type="text/css">
<script LANGUAGE="JavaScript" src="js-lib.js"></SCRIPT>

<body>

<center>
<h1> Cert - O - Matic </h1>

<h3> An automated RUS-CERT bug checker </h3>
<br>


<table border="0" cellpadding="3"  width=400>
<tr>
    <th>
      Company / Organization
    </th>
                    
    <th width=100>
      Nr. of Bugs
    </th>
                    
</tr>


<?php

    include "db_inc.php";
    $total_width = 150;

    $query = "SELECT count(*), DATE_FORMAT(max(article_date), '%d %M %Y') as date_formated
              FROM cert_main_data";
              
    $result = mysql_query($query);
    $MaxNrofBugs  = mysql_fetch_array($result);
    $LastUpdate   = $MaxNrofBugs[1];
    $LastUpdateParam = "&p_lastupdate=" . $LastUpdate;
    $MaxNrofBugs  = $MaxNrofBugs[0];
    $query = "SELECT main_text, DATE_FORMAT(max(article_date), '%d %M %Y') as date_formated, count(*) as NrofBugs 
              FROM cert_main_data
              GROUP BY main_text
              ORDER BY NrofBugs desc, article_date desc
              LIMIT 0,12";
    $result = mysql_query($query);

    while ($row = mysql_fetch_object($result)) {
      echo "<tr>";
      echo "  <td width=200 valign=\"top\" bgcolor=\"#CCCCCC\">";
      echo "<a class=nobold href=\"javascript:top.open_win('prod_stats.php?main_name=" . $row->main_text . $LastUpdateParam . "', 400, 350, 100, 100);\">" . $row->main_text . "</a>";
//      if ($row->date_formated == $LastUpdate) {
//        echo "<img src=new.gif>";
//      }

      echo " \r\n <br> \r\n";
      $myWidth = round ((($row->NrofBugs / $MaxNrofBugs) * $total_width) , 0);
      echo "<img src=tiny_red.png width=\"$myWidth\" height=4>";
      $myWidth = $total_width - $myWidth;
      echo "<img src=tiny_green.png width=\"$myWidth\" height=4> <span class=tiny> (" . round (($row->NrofBugs / $MaxNrofBugs)*100, 0) .  "%)</span>";
      echo "</td>";
      echo "  <td align=\"right\" valign=\"top\" bgcolor=\"#CCCCCC\">" . $row->NrofBugs . "</td>\r\n";
      echo "</tr>";
   }
    echo "</table>";
    echo "<span class=tiny>Last Change : $LastUpdate </span>";
?>  
    <br><br>
    <a href="http://www.ohardt.com">More Java / PHP source code and tools</a><br><br>
    Data courtesy of <a href="http://cert.uni-stuttgart.de">RUS-CERT</a>
    </center>
  </body>
</html>  
