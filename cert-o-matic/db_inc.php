<?php

    $link = mysql_connect("localhost", "root", "dbpw")
    or die("DB error, please try later");
    mysql_select_db("prog_db")
    or die("DB error, please try later");

?>