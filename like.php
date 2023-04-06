<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

?>

<?php
   $con = mysqli_connect('localhost','root','');
    
   if (!$con) {
     die('Could not connect: ' . mysqli_error($con));
   }
   $cid=$_GET['cid'];
   mysqli_select_db($con,"cryptrack");
   $uid=$_SESSION['uid'];
   $sql = "INSERT into likes (uid,cid) values (".$uid.",".$cid.")";
   $con -> query($sql);
   if($cid==1)
   {
    $like_query="UPDATE crypto SET likes=likes+1 where cID=1";
    $con -> query($like_query);
   header("location: info_bitcoin.php");
   }
   else if($cid==2)
   {
    $like_query="UPDATE crypto SET likes=likes+1 where cID=2";
    $con -> query($like_query);
    header("location: info_ethereum.php");
   }
   else if($cid==3)
   {
    $like_query="UPDATE crypto SET likes=likes+1 where cID=3";
    $con -> query($like_query);
    header("location: info_bnb.php");
   }
   else if($cid==4)
   {
    $like_query="UPDATE crypto SET likes=likes+1 where cID=4";
    $con -> query($like_query);
    header("location: info_doge.php");
   }
   else if($cid==5)
   {
    $like_query="UPDATE crypto SET likes=likes+1 where cID=5";
    $con -> query($like_query);
    header("location: info_tether.php");
   }
?>