<?php

//Creates and returns a database connection object
function DB_New_Connection() {
    $db_user = "dbi390141";
    $db_password = "Z8b!L2dU";
    $db_name = "dbi390141";
    $db_host = "studmysql01.fhict.local";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    return $conn;
}

?>