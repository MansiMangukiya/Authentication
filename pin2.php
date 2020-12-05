<?php
session_start();
    
//connection to MySQL
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('display_errors',1);
    include ("account.php");
    include ("myfunctions.php");
    $db=mysqli_connect($hostname,$username,$password,$project);
    if(mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: ";
        mysqli_connect_error();
        exit();
    }
    print "Successfully connected to MySQL.<br>";
    mysqli_select_db($db,$project);

//end

$user_pin = safe("pin");
echo "Pin entered is: $user_pin";
$original_pin = $_SESSION["pin"];

if ($user_pin == $original_pin)
{
    $_SESSION["pinpass"] = true;
    echo "<br> CORRECT PIN <br>";
    header("refresh:2, url=service1.php");
}

else
{
    echo "<br> INCORRECT PIN <br>";
    header("refresh:2, url=pin1.php");
}

?>