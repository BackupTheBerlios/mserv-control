<html>
  <head>
    <title> Cert - O - Matic    -==-    Info </title>
  </head>
  <link rel="stylesheet" href="style.css" type="text/css">
  <body>
  


<center>

<?php
  echo "<h1> Articles for : \"" . $main_name . " / " . $prod_name . "\"";
?>
<br><br>  

<table border="0" cellpadding="3" width="350">
<tr>
    <th>
      Cert-RUS Article (in german)
    </th>
                    
</tr>

<?php

    include "db_inc.php";

    $query = "SELECT md.mid, main_desc
              FROM cert_main_data md, cert_prod_data pd
              where pd.id_mid = md.mid
              and md.main_text = '$main_name'
              and pd.prod_text = '$prod_name'
              order by md.mid desc
              LIMIT 0, 20";
   $result = mysql_query($query);
   while ($row = mysql_fetch_object($result)) {
     $cert_article_link = "http://cert.uni-stuttgart.de/ticker/article.php?mid=" . $row->mid;
     echo "<tr>\r\n";
     echo "  <td width=200 valign=\"top\" bgcolor=\"#CCCCCC\">\r\n";
     echo "    <a class=\"nobold\" href=\"" . $cert_article_link . "\" target=\"_blank\">$row->main_desc</a><br>\r\n";
     echo "    <a class=\"nobold\" href=\"http://translate.google.com/translate?hl=en&u=" . $cert_article_link . "\" target=\"_blank\">[ English / Google ] </a>\r\n";
     echo "  </td>\r\n";
     echo "</tr>\r\n";
    
   }
   
   $back_link = $HTTP_REFERER;

?>
    </table>
    <br>
<?php
  echo "<a href=\"$back_link\">[ Back ]</a>";
?>  
    <a href="javascript:self.close();">[ Close this window ]</a>
  </body>
</html>  
