<?php

//Resources
include_once "./db_manager.php";

//Generates new cookie
function Cookie_New() {
    //Generate cookie data
    $cookie_name = "p-login";
    $token = bin2hex(openssl_random_pseudo_bytes(25, $cstrong));
    $hash = password_hash($token, PASSWORD_DEFAULT);
    $expireDB = date("Y-m-d H:i:s", time()+(10*60));
    $expireCookie = time()+(10*60);

    //Set cookie
    setcookie($cookie_name, $hash, $expireCookie,"/");

    //Connect to DB
    $conn = DB_New_Connection();
    $sql = "INSERT INTO `session-data`(`token`, `expire`) VALUES ( "."'".$token."', "."'".$expireDB."' )";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Saves cookie data to database so it can later be verified
    if (!mysqli_query($conn, $sql)) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.location.href='/login.html';
				</SCRIPT>");
        $conn->close();
    }

    $conn->close();

}

//Searches for active cookie, processes it, returns true/false if it's valid.
function Cookie_Verified() {
    $ReturnValue = null;

    if(isset($_COOKIE["p-login"])) {
        //Connect to DB
        $conn = DB_New_Connection();
        $sql = "SELECT token, expire FROM `session-data`";
        $result = $conn->query($sql);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Iterate over rows
        while ($row = $result->fetch_assoc()) {
            $time_created = $row['expire'];
            $time_current = date("Y-m-d H:i:s");

            //Checks if has matches token and that time limit is not reached.
            if(password_verify($row['token'], $_COOKIE["p-login"]) && $time_current <= $time_created) {
                //Display calendar
                $ReturnValue = true;
            }

        }
        $conn->close();
    }

    else {
        $ReturnValue = false;
    }
    return $ReturnValue;
}

?>