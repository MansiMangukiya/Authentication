<?php
session_start();
//connection to MySQL
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('display_errors',1);
    include ("account.php") ;
    $db=mysqli_connect($hostname,$username,$password,$project);
    if(mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: ";
        mysqli_connect_error();
        exit();
    }
    print "Successfully connected to MySQL.<br>";
    mysqli_select_db($db,$project);
//MySQL connection end

$pin= mt_rand (1000,9999);
$_SESSION["pin"]=$pin;
echo "<br>pin is: $pin<br>";

$to="hbs25@g.njit.edu";
$subj="pin";
$msg=$pin;
mail($to,$subj,$msg);
?>

<form action="pin2.php" autocomplete="off">
<input type = text name = "pin"> Enter mailed pin<br>
<input type = submit >
</form>