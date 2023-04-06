<?php
  
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
  {
      header("location: login.php");
  }
  
    // Connect to database 
    $con=mysqli_connect("localhost","root","","cryptrack");
  
    //CHECK IF GET IS SET
    if (isset($_GET['id'])){
  
        //EXTRACT THE ID
        $id=$_GET['id'];
        //UPDATE THE TRADE STATUS
        $sql="UPDATE `cryptrade` SET 
            `status`=0 WHERE tid='$id'";
        $uid=$_SESSION['uid'];
        $amount="SELECT current_value from cryptrade WHERE tid=$id";
        $result = mysqli_query($con,$amount);
        while($row = mysqli_fetch_array($result))
        {
            $amt=$row['current_value'];
        }
        $update_bal = "UPDATE users SET balance=balance+$amt where uid=$uid";
        mysqli_query($con,$update_bal);

        // Execute the query
        mysqli_query($con,$sql);
        $sql="UPDATE `cryptrade` SET 
            `status`=0 WHERE tid='$id'";
        
        // Execute the query
        mysqli_query($con,$sql);
    }
  
    // Go back to course-page.php
    header('location:cryptrade.php');
?>