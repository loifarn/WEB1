<?php

//Resources
include_once "./db_manager.php";

//Process and return safe input to avoid malicious code execution.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//If request method is post, retrieve data and store it in database.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $findus = test_input($_POST["findUs"]); 
    $msg =  test_input($_POST["message"]);

    //Connecting to database
    $conn = DB_New_Connection();
    $sql = "INSERT INTO `contact-form`(`name`, `email`, `findUs`, `msg`) VALUES('".$name."','".$email."','".$findus."','".$msg."')";
    $success = $conn->query($sql);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);

}

//Thank user for input
echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Thank you!')
				window.location.href='/index.html';
				</SCRIPT>");

}

?>