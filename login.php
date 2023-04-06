<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    if($_SESSION['username']=="admin")
    {
        header("location: admin_home.php");
        exit;
    }
    else
    header("location: dashboard.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";
$error_detected=0;
// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter valid username/password!";
        $error_detected=1;
    }
    else{
        $error_detected=0;
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    if($_POST['username']=="admin" && $_POST['password']=="admin")
    {
        $_SESSION["uid"] = 1;
        $_SESSION["username"] = "admin";
        $_SESSION["loggedin"] = true;
        header("location: admin_home.php");
    }
    $sql = "SELECT uid,name, username,password,email,mobileno,balance FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $error_detected=0;
                    mysqli_stmt_bind_result($stmt, $uid,$name ,$username, $hashed_password,$email,$mobileno,$balance);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is correct. Allow user to login
                            session_start();
                            $_SESSION["uid"] = $uid;
                            $_SESSION["username"] = $username;
                            $_SESSION["name"] = $name;
                            $_SESSION["email"] = $email;
                            $_SESSION["mobileno"] = $mobileno;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["balance"] = $balance;

                            //Redirect user to welcome page
                            header("location: dashboard.php");
                            
                        }
                        else
                        {
                            $err = "Incorrect password!";
                            $error_detected=1;
                        }
                    }

                }
        else{
            $err = "Username does not exist";
            $error_detected=1;
        }

    }
}    


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CrypTrack Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styling-login.css">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/boldstylesheet.css">
    <link rel="stylesheet" href="css/responsive-login.css">

</head>

<body>
    <main>
        <!-- FOR BOOTSTRAP -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous"></script>
        <div class="login-main-flex">
            <div class="login-left">
                <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 slideimg1" src="img/login/2.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 slideimg1" src="img/login/1.png" alt="Second slide">
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="login-right">
                <img src="img/logo.png" alt="" class="logo" onclick="window.location.href='index.php';">
                <div class="login-box">
                    <h2 style="font-size:3.5vh;">Welcome to CrypTrack</h2>
                    <form action="" method="post"class="login-box">
                        <p style="font-size:2.5vh;">Enter Username</p>
                        <input type="text" name="username"id="emailid" placeholder="Username">
                        <p style="font-size:2.5vh;">Enter Password</p>
                        <input type="password" name="password" id="pass" placeholder="Password">
                        <input type="submit" id="submit" value="Login">
                        <?php
                            if($error_detected==1)
                            {
                                echo '<div id="error-message">'.$err.'</div>';
                            }
                            else
                            {
                                echo "";
                            }
                        ?>
                        <div class="divider"></div>
                        <p class="dont-have-acc" style="font-size:2.5vh;"> Dont have an account?</p>
                        <input type="button" value="Sign Up" id="signup" onclick="window.location.href='signup.php';">
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script>
        function errormessage()
        {
            ;
        }
        </script>
        
    
    </main>
</body>

</html>

