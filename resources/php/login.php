<?php

//Resources
include_once "./db_manager.php";
include_once "./cookie_manager.php";

//Checking user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);


    //Connecting to database
    $conn = DB_New_Connection();
    $sql = "SELECT uname, pwd FROM users";
    $result = $conn->query($sql);


    //Kills connection if it fails.
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    //Check each result from query
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $check1 = $row['uname'];
            $check2 = $row['pwd'];

            //If match => generate site and cookie, else => return to login.
            if(strcmp($check1,$username) == 0 && strcmp($check2,$password) == 0){
                Cookie_New();
                echo '<html lang ="en"><header><meta name="viewport" content="width=device-width, initial-scale=1.0">  <style>html, body { height: 100%; margin: 0;}.calendar { width: 100%; height: 950px;}</style></header><body><div><iframe src="https://calendar.google.com/calendar/embed?mode=WEEK&amp;height=950&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=alex%40loif.no&amp;color=%23711616&amp;ctz=Europe%2FAmsterdam" style="border-width:0" width="100%" height="950" frameborder="0" scrolling="no"></iframe></div></body></html>';
            }
            else
            {
                echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Wrong username/password')
					window.location.href='/login.html';
					</SCRIPT>");
            }
        }
    } else
    {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Login error, please try again later')
					window.location.href='/login.html';
					</SCRIPT>");
    }
    $conn->close();
}


//Process and return safe input to avoid malicious code execution.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>