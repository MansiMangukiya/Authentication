<?php

session_start();
$session_value = session_id();
echo "<br>Your session id: " . $session_value . "<br>";

$_SESSION = array();
session_destroy();
setcookie("PHPSESSID","",time()-3600);
echo "Your session has been terminated";

?>