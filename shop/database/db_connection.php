<?php

try{
    $database_con = new mysqli("localhost", "root", "", "shop");
    } catch(mysqli_sql_exception $e) {
        echo "<h4>Verbindung fehlgeschlagen</h4>";
        exit();
    }

?>