<?php

    include "db_inc.php";

    $fh = fopen("http://cert.uni-stuttgart.de/ticker/news.php?count=800", "r");
    if ($fh){
        while (!feof ($fh)) {
            $buffer = fgets($fh, 4096);
            // echo $buffer;
            if (eregi("article.php\?mid\=([0-9]+)\"\>\[([^\/\Uu5D]+)\/(.+)\](.+)</a> \((.*)\)", $buffer, $regexp)) {
              
                echo $regexp[2] . "<br> \r\n";
                echo $regexp[5] . " " . $regexp[4] . "<br> \r\n";

                $mymain = explode(",", $regexp[2]);
               
                foreach ($mymain as $current_main) {
                  
                    if ($current_main == "MS") {
                      $current_main = "Microsoft";
                    }  

                    $query = "REPLACE INTO cert_main_data (mid, main_text, main_desc, article_date) VALUES (" . $regexp[1] . " , '" . 
                              trim($current_main) . "' , '" . trim($regexp[4]) . "' , '" . $regexp[5] . "')";
                    echo $query;          
                    $result = mysql_query($query);
                }    
               
                $myprods = explode(",", $regexp[3]);
               
                foreach ($myprods as $current_prod) {
                    $query = "REPLACE INTO cert_prod_data (id_mid, prod_text) VALUES (" . $regexp[1] . " , '" . 
                              trim($current_prod) . "')";
                    $result = mysql_query($query);
                }
               
            }
        }
    }       


?>