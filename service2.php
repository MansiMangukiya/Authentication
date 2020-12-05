<?php
session_start();
global $db;
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
//MySQL connection end

$ucid = $_SESSION["ucid"];

$choice = safe("c");
$account = safe("account");
$amount = safe("amount");
$number = safe("number");


if ($choice == "list") { retrieve($ucid,$number) ; }
if ($choice == "perform") { transact($ucid,$account,$amount) ; }
if ($choice == "clear") { clear($ucid,$account) ; }

echo '<br> <a href="https://web.njit.edu/~hbs25/download/IT_202/Assignment01/logout.php">Go to logout.php</a><br><br>';

echo '<a href="https://web.njit.edu/~hbs25/download/IT_202/Assignment01/service1.php">Go to service1.php</a><br><br>';
?>