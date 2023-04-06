<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

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

    $con = mysqli_connect('localhost','root','');
    
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
    mysqli_select_db($con,"cryptrack");
    $cid=3;
    $uid=$_SESSION['uid'];
    $sql = "SELECT * from likes where uid=$uid and cid=$cid";
    $result= $con -> query($sql);
    $num_rows = mysqli_num_rows($result);
    $img_link_liked="img/icons/heart-fill.png";
    $img_link_unliked="img/icons/heart-line.png";
        if($num_rows==0)
        {
            echo'<a href="like.php?cid='.$cid.'"><img src="'.$img_link_unliked.'" alt=""></a>';
        }
        else
        {
            echo'<a href="unlike.php?cid='.$cid.'"><img src="'.$img_link_liked.'" alt=""></a>';
        } 
?>
</body>
</html>