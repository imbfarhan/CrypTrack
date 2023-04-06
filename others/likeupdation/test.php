<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
  $con = mysqli_connect("localhost","root","","test");
  
  // Get all the courses from courses table
  // execute the query 
  // Store the result
  $sql = "SELECT * FROM `crypt`";
  $Sql_query = mysqli_query($con,$sql);
  $All_courses = mysqli_fetch_all($Sql_query,MYSQLI_ASSOC);

  // Use foreach to access all the courses data
  foreach ($All_courses as $course) { ?>
  <tr>
      <td><?php echo $course['name']; ?></td>
      <td><?php 
              // Usage of if-else statement to translate the 
              // tinyint status value into some common terms
              // 0-Inactive
              // 1-Active
              if($course['price']=="1") 
                  echo "Active";
              else 
                  echo "Inactive";
          ?>                          
      </td>
      <td>
          <?php 
          if($course['price']=="1") 

              // if a course is active i.e. status is 1 
              // the toggle button must be able to deactivate 
              // we echo the hyperlink to the page "deactivate.php"
              // in order to make it look like a button
              // we use the appropriate css
              // red-deactivate
              // green- activate
              echo 
"<a href=deactive.php?id=".$course['id']." class='btn red'>Deactivate</a>";
          else 
              echo 
"<a href=active.php?id=".$course['id']." class='btn green'>Activate</a>";
          ?>
  </tr>
 <?php
      }
      // End the foreach loop 
 ?>
</body>
</html>