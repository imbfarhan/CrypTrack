<?php
  
    // Connect to database 
    $con=mysqli_connect("localhost","root","","cryptrack");
  
    //CHECK IF GET IS SET
    if (isset($_GET['id'])){
  
        //EXTRACT THE ID
        $id=$_GET['id'];
        //UPDATE THE TRADE STATUS
        $sql="DELETE FROM `cryptrade` WHERE tid='$id'";
        
        // Execute the query
        mysqli_query($con,$sql);
    }
  
    // Go back to course-page.php
    header('location:cryptrade.php');
?>