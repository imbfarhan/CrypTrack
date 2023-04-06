<?php
session_start();

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

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$tnc_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT uid FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                    $email = trim($_POST['email']);
                    $mobileno = trim($_POST['mobileno']);
                    $name = trim($_POST['name']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);

if(!isset($_POST['tnc']))
{
  $tnc_err="Please accept the terms and conditions."; 
}

// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters.";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($tnc_err))
{
    $sql = "INSERT INTO users (username,name, password,email,mobileno) VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sssss", $param_username,$param_name ,$param_password,$param_email,$param_mobileno);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_email = $email;
        $param_mobileno = $mobileno;
        $param_name = $name;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrypTrack Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styling-aboutme.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css">
    <link rel="stylesheet" href="css/common-assets.css">
    <link rel="stylesheet" href="css/styling-signup.css">
</head>

<body>



    <main>
        <div class="main-div-flex">

            <div class="heading-flex">
                <h1>Register on</h1>
                <a href="index.php" ><img src="img/logo.png" alt="" id="home-logo"></a> 
            </div>
            <div class="register-flex">

                <div class="register-left">
                    <div class="register-left-sub-heading">
                        <h4 style="display:flex;" >New to Crypto?</h4>
                        <h4 style="display:flex;" >Learning Crypto?</h4>
                        <h4 style="display:flex;" >Analysing Crypto?</h4>
                    </div>
                    <h2 class="register-left-main-heading"r>Dont worry! CrypTrack has got you covered!</h2>
                    <p class="register-left-paragraph">
                        Whether you are new to the crypto world, or an ace trader who only focuses only on key aspects, we satisfy the needs of the traders on both ends of the spectrum.
                    </p>
                    

                    <p class="register-left-ul-heading">Sign up today at CrypTrack to get access to:</p>
                    <div class="register-left-bottom-flex">
                    <ul>
                        <li>Real-time crypto info</li>
                        <li>CrypTrade&#8482; (Mock Trade)</li>
                        <li>Crypto Converter</li>
                        <li>News</li>
                        <li>Beginner Friendly Charts</li>
                    </ul>
                    <img src="img/signup/hand.png" alt="">
                    </div>
                </div>

                <div class="register-right">
                    <div class="register-form-flex">
                        <h4>Enter your details</h4>
                        
                        <form action="" method="post" onsubmit="return validatesignup(this)">
                            <div class="general-input">
                                Name
                                <input type="text" name="name" id="field" placeholder="Name">
                            </div>
                            <div class="general-input">
                                User Name*
                                <input type="text" name="username" id="field" placeholder="UserName">
                            </div>
                            <div class="general-input">
                                Email ID
                                <input type="text" name="email" id="field" placeholder="Email ID">
                            </div>
                            <div class="password-flex">
                                <div class="password-inner-flex">
                                    Password* (atleast 5 characters)
                                    <input type="password" name="password" id="field-2" placeholder="Password">
                                </div>
                                <div class="password-inner-flex">
                                    Re-type Password*
                                    <input type="password" name="confirm_password" id="field-2"
                                        placeholder="Re-type Password">
                                </div>
                            </div>
                            <div class="general-input">
                                Mobile No
                                <input type="text" name="mobileno" id="field" placeholder="Mobile No">
                            </div>
                            <div class="error-message-hidden">
                            <div class="error-message" id="err-msg">
                                <?php
                                    // if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
                                    echo $username_err.'<br/>';
                                    echo $password_err.'<br/>';
                                    echo $confirm_password_err.'<br/>';
                                    
                       
                                ?>
                            </div>
                            </div>
                            <div class="sign-up">
                                <div class="sign-up-checkbox">
                                <div>  
                                <input type="checkbox" name="tnc"  id="chk-bx">I agree to the <a href="tnc.php" target="_blank" id="tnc-agreement">terms and conditions*</a>
                                </div>
                                <div class="error-message-text tnc-error">
                                <?php echo $tnc_err.'<br/>';?>
                                </div>
                            </div>
                                <input type="submit" name="submit " id="submit" value="Sign Up">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>


    </main>
    <script>
        function validatesignup(thisform)
        {
            var emailid_regex="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$";
            var err_box=document.getElementById("err-msg");
            username=thisform.username.value;
            password=thisform.password.value;
            confirm_password=thisform.confirm_password.value;
            mobileno=thisform.mobileno.value;
            emailid=thisform.email.value;
            if(username=="" || username==null)
            {
                alert("Enter a username.")
               return false;
                
            }
            if(isNaN(mobileno))
            {
                alert("Enter a valid mobile number.")
                thisform.mobileno.focus();
                return false;
            }
            if(mobileno.length!=10)
            {
                alert("Mobile number must be 10 digits long.")
                thisform.mobileno.focus();
                return false;
            }
            if(!emailid.match(emailid_regex))
            {
                alert("Enter a valid email id.")
                thisform.email.focus();
                return false;
            }
            if(password.length<5)
            {
                alert("Password should be atleast 5 characters long.")
                thisform.password.focus();
                return false;
            }
            if(confirm_password.length<5)
            {
                alert("Confirm password should be atleast 5 characters long.")
                thisform.password.focus();
                return false;
            }
            if(password.length>=5 && confirm_password.length>=5)
            {
                if(confirm_password!=password)
                {
                alert("Passwords do not match.")
                thisform.password.focus();
                return false;
                }
            }
            let checkbox = document.getElementById("chk-bx");
            if(!checkbox.checked)
            {
                alert("Please accept the terms and conditions.")
                return false;
            }
            
            return true;
           
        }
    </script>





</body>

</html>