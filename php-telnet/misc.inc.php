<?php

  function getHTMLHeader() {
    for ($i = 0; $i < 400; $i++) {
      echo " ";
    } 
    echo "\r\n"; 
    echo "<span id=\"processing\">Updating ...</span>";
    flush();

  }

  function getHTMLFooter() {
      echo "<style type=\"text/css\"> \r\n";
      echo "#processing  { text-shadow:white; font-size:1pt; color:white; } \r\n";
      echo "</style> \r\n";
      echo "<script>processing.style.display='none'; \r\n";
      echo "if(DHTML) {  \r\n";
      echo "   setCont(\"id\",\"processing\",null,\"\"); \r\n";
      echo " } \r\n";
      echo "      </script> \r\n";
      


  }


?>
  