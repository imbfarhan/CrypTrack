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
   mysqli_select_db($con,"cryptrack");
   $uid=$_SESSION['uid'];
   $sql = "INSERT into news_likes (uid,nid) values (".$uid.",".$nid.")";
   $con -> query($sql);
   header("location: news.php");

?>