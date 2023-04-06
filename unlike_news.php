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
   $nid=$_GET['nid'];
   $pid=$_GET['pid'];
   mysqli_select_db($con,"cryptrack");
   $uid=$_SESSION['uid'];
   $sql = "DELETE from news_likes where uid=$uid and nid=$nid";
   $con -> query($sql);
   if($pid==1)
   header("location: liked_news.php");
   else
   header("location: news.php");
?>