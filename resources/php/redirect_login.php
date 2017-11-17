<?php

//Resources
include_once "./cookie_manager.php";

//Checks if there is any active, verifiable cookies.
$result = Cookie_Verified();

//if Cookie is verifiable => show calendar, else => redirect to login.
if ($result) {
    echo '<html lang ="en"><header><meta name="viewport" content="width=device-width, initial-scale=1.0">  <style>html, body { height: 100%; margin: 0;}.calendar { width: 100%; height: 950px;}</style></header><body><div><iframe src="https://calendar.google.com/calendar/embed?mode=WEEK&amp;height=950&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=alex%40loif.no&amp;color=%23711616&amp;ctz=Europe%2FAmsterdam" style="border-width:0" width="100%" height="950" frameborder="0" scrolling="no"></iframe></div></body></html>';
}
else {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.location.href='/login.html';
					</SCRIPT>");
}

?>