<?php

function authenticate( $ucid, $pass)
{
    global $db;
    $s= "select * from users where ucid = '$ucid' and pass = '$pass'";
    ($t=(mysqli_query($db,$s)))  or die(mysqli_error($db));
    $num= mysqli_num_rows($t);

    if  ($num ==0)  
    {
        return false ; 
    }
    else            
    { 
        $_SESSION["logged"] = true;
        $_SESSION["ucid"] = $ucid;
        return true  ;
    }   
}

function safe ($name)
{
    global $db;
    $v  =   $_GET[$name];
    $v  =   trim ($v);

    if ($v != "") 
    {
      $v  =   mysqli_real_escape_string($db, $v);
    }
    return $v;
}

function retrieve($ucid,$number)
{
    global $db;
    $x= "select * from accounts where ucid = '$ucid' ";
    ($y=(mysqli_query($db,$x)))  or die(mysqli_error($db));
    setlocale(LC_MONETARY, 'en_US.UTF-8');

    while ( $r = mysqli_fetch_array($y, MYSQLI_ASSOC) )
    {  
        $balance = $r[ "balance"  ];
        $account=$r["account"];
        echo "<br>--------------------------------------------------------------------------------------";
        echo "<br><strong>$ucid &nbsp&nbsp&nbsp&nbsp&nbsp $account &nbsp&nbsp&nbsp&nbsp&nbsp balance: &nbsp";
        echo "$$balance &nbsp&nbsp&nbsp&nbsp&nbsp most recent</strong><br><br>";

        $s = "SELECT * FROM transactions WHERE ucid = '$ucid' and account = '$account' ORDER BY timestamp DESC LIMIT $number";

        ($t=(mysqli_query($db,$s)))  or die(mysqli_error($db));

        while ( $r = mysqli_fetch_array($t, MYSQLI_ASSOC) )
        {  
            $amount = $r[ "amount" ];
            $timestamp = $r[ "timestamp" ];
            $mail= $r["mail"];
            echo "$$amount &nbsp&nbsp&nbsp&nbsp $timestamp &nbsp&nbsp&nbsp&nbsp&nbsp mail copy: '$mail'</i><br><br>";
        }
    }
}

function transact($ucid,$account,$amount)
{   
    global $db;
	$s = "select * from accounts where ucid='$ucid' and account='$account' and balance+'$amount'>=0.00";
	($t = mysqli_query( $db , $s)) or die (mysqli_error($db));
	$num = mysqli_num_rows($t);
	if($num == 0){
		 print "<br>Either invalid account or overdraft blocked.<br>";
		return;
	}   
  
	$inserts = "insert into transactions values ('$ucid','$account','$amount', NOW(), 'N')";
  
	($t = mysqli_query( $db , $inserts)) or die (mysqli_error($db));
  
	$updates = "update accounts set balance=balance+$amount, recent=NOW() where ucid = '$ucid' and account = '$account'";
  
	($t = mysqli_query( $db , $updates)) or die (mysqli_error($db));
}

function clear($ucid,$account)
{
    global $db;
	$s = "update accounts set balance=0.00 and recent= '0000-01-01 00:00:00' where ucid='$ucid' and account='$account'";
    ($t = mysqli_query( $db , $s)) or die (mysqli_error($db));

    $q="delete from transactions where  ucid='$ucid' and account='$account'";
	print "<hr>Query to reset transaction: $q";
    ($t = mysqli_query( $db , $q)) or die (mysqli_error($db));
    
    print "All the transactions have been cleared and the balance is set to 0";
}

?>