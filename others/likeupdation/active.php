<?php
   $con=mysqli_connect("localhost","root","","test");
    // Connect to database 
  
    // Check if id is set or not, if true,
    // toggle else simply go back to the page
    if (isset($_GET['id'])){
  
        $sql="UPDATE `crypt` SET 
             `price`=`price`+1 where id=1";
            
             mysqli_query($con,$sql);
    }
  
    // Go back to course-page.php
    header('location: test.php');
?>