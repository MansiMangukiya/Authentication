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
//MySQL connection end

$ucid = safe("ucid");
$pass = safe("pass");
    
    if(!authenticate($ucid,$pass)){
        echo "<br>Not Authenticated";
        header ("refresh: 2; url=auth.html");
        exit();
    }
    else {
        echo "<br> Authenticated";
        header ("refresh: 2; url=pin1.php");
        exit();
    }

?>