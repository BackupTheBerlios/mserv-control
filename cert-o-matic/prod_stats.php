<html>
  <head>
    <title> Cert - O - Matic    -==-    Info </title>
  </head>
  <link rel="stylesheet" href="style.css" type="text/css">
  <body>

<center>

<?php
  echo "<h1> Info for : \"" . $main_name . "\"";
?>
<br><br>  

<table border="0" cellpadding="3" width="350">
<tr>
    <th>
      Product / Category
    </th>
                    
    <th>
      Nr. of Bugs
    </th>
                    
</tr>

<?php

    include "db_inc.php";

    $query = "SELECT prod_text, count(*) as NrodProdBugs, DATE_FORMAT(max(article_date), '%d %M %Y') as date_formated
              FROM cert_main_data md, cert_prod_data pd
              where pd.id_mid = md.mid
              and md.main_text = '$main_name'
              group by pd.prod_text
              order by NrodProdBugs desc
              LIMIT 0, 20";
   $result = mysql_query($query);
   while ($row = mysql_fetch_object($result)) {
    
     echo "<tr>";
     echo "  <td width=200 valign=\"top\" bgcolor=\"#CCCCCC\">";
     echo "    <a href=\"cert_article.php?main_name=" . $main_name . "&prod_name=" . $row->prod_text . "\">" . $row->prod_text . "</a>";
     if ($row->date_formated == $p_lastupdate) {
        echo "<img src=new.gif>";
     }
     echo "  </td>";
     echo "  <td align=\"right\" valign=\"top\" bgcolor=\"#CCCCCC\">" . $row->NrodProdBugs . "</td>";
     echo "</tr>";
    
   }
   

?>
    </table>
    <br>
    <a href="javascript:self.close();">[ Close this window ]</a>
  </body>
</html>  
