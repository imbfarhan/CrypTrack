<?php

session_start();
if($_SESSION['username']=="admin")
{
    header("location: admin_home.php");
    exit;
}

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

    $RESULT=0;
    $RESULT1=0;
    mysqli_select_db($con,"cryptrack");
    $sql1 = "SELECT price from crypto where cid=1";
    $result1=mysqli_query($con,$sql1);
    $sql2 = "SELECT price from crypto where cid=2";
    $result2=mysqli_query($con,$sql2);
    $sql3 = "SELECT price from crypto where cid=3";
    $result3=mysqli_query($con,$sql3);
    $sql4 = "SELECT price from crypto where cid=4";
    $result4=mysqli_query($con,$sql4);
    $sql5 = "SELECT price from crypto where cid=5";
    $result5=mysqli_query($con,$sql5);

    while($row = mysqli_fetch_array($result1))      $price1=$row['price'];
    while($row = mysqli_fetch_array($result2))      $price2=$row['price'];
    while($row = mysqli_fetch_array($result3))      $price3=$row['price'];
    while($row = mysqli_fetch_array($result4))      $price4=$row['price'];
    while($row = mysqli_fetch_array($result5))      $price5=$row['price'];
    
    $sql11 = "SELECT cur_price from convertor where cur_id=1";
    $result11=mysqli_query($con,$sql11);
    $sql12 = "SELECT cur_price from convertor where cur_id=2";
    $result12=mysqli_query($con,$sql12);
    $sql13 = "SELECT cur_price from convertor where cur_id=3";
    $result13=mysqli_query($con,$sql13);
    $sql14 = "SELECT cur_price from convertor where cur_id=4";
    $result14=mysqli_query($con,$sql14);
    $sql15 = "SELECT cur_price from convertor where cur_id=5";
    $result15=mysqli_query($con,$sql15);

    while($row = mysqli_fetch_array($result11))      $price11=$row['cur_price'];
    while($row = mysqli_fetch_array($result12))      $price12=$row['cur_price'];
    while($row = mysqli_fetch_array($result13))      $price13=$row['cur_price'];
    while($row = mysqli_fetch_array($result14))      $price14=$row['cur_price'];
    while($row = mysqli_fetch_array($result15))      $price15=$row['cur_price'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Convertor</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<link rel="stylesheet" href="css/utils.css">
<link rel="stylesheet" href="css/fonts/fontstyle.css">
<link rel="stylesheet" href="css/fonts/stylesheet.css">
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/styling-Converter.css">
<link rel="stylesheet" href="css/styling-bitcoininfo.css">
<link rel="stylesheet" href="css/responsive-about-us.css">

</head>



<body>
<header>
        <div class="img-flex">
        <img src="img/logo.png" alt="" class="logo">
         </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Track</a></li>
                <li><a href="cryptrade.php">CrypTrade</a></li>
                <li><a href="converter.php"  style="opacity:1;">Convert</a></li>
                <li><a href="news.php">News</a></li>
                
            </ul>
        </nav>
        <div class="user-flex">
            <div class="dropdown show">
                <a class="user-button bg-transparent dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION["username"] ?>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="profile.php">Profile</a>
                    <a class="dropdown-item" href="liked_news.php">Saved News</a>
                    <a class="dropdown-item" href="liked_cryptos.php">Liked Cryptos</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </div>
        </div>
        
</header>
<main>
    <div><img class="im1g" src="img/convertor/converter.png" alt=""></div>
    
    <h2 style="text-align: center; ">Convert Crypto</h2>
    <p style="text-align:center;">Convert crypto from one form to another.</p>
    <div style="text-align:center;">
    <div class="main-flex-box">
        <div class="top-flex-left" style="width:15vw;background-color:#272324;border: 5px solid #4E4B4D;border-radius:23px;float:left; margin-left:25%; height:50vh;">
            <p class="form-p" style="font-weight:bold"> Crypto to Crypto</p>  
            <p class="form-p">From</p>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return convertvalidate1(this)"> 
                <select style="width: 80% ;background:#AEAEC0;" name="A" id="from">
                    <option value="1" >Bitcoin</option>
                    <option value="2">Etherium</option>
                    <option value="3">BNB</option>
                    <option value="4">Dogecoin</option>
                    <option value="5">Tether</option> 
                </select>

                <p class="form-p">To</p>
                <select style="width: 80% ;background:#AEAEC0;"name="B" id="To">
                    <option value="1" >Bitcoin</option>
                    <option value="2">Etherium</option>
                    <option value="3">BNB</option>
                    <option value="4">Dogecoin</option>
                    <option value="5">Tether</option> 
                </select>
                <p style="font-size:2.5vh; margin-top:2vh;">Enter Amount</p>
                <input type="number" style="width: 80% ;background:#AEAEC0;" name="amount1"/>
                <input type="submit" value="Convert" name="1" class="submitb">
                <!-- <button name="1" class="submitb" value="Submit">Convert</button> -->
                <div class="trade-value">Converted Value:               </div>
            </form>    
            <?php
                if(isset($_POST['1'])){
                    $RESULT=0;
                    if(isset($_POST['A'])){
                        $value1=$_POST['A'];
                        if($value1==1)   $RESULT=$price1;
                        else if($value1==2)   $RESULT=$price2;
                        else if($value1==3)   $RESULT=$price3;
                        else if($value1==4)   $RESULT=$price4;
                        else if($value1==5)   $RESULT=$price5;
                        //echo $RESULT;
                        //echo "HI";
                        $value2=$_POST['B'];
                        if($value2==1)   $RESULT=$RESULT/$price1;
                        else if($value2==2)   $RESULT=$RESULT/$price2;
                        else if($value2==3)   $RESULT=$RESULT/$price3;
                        else if($value2==4)   $RESULT=$RESULT/$price4;
                        else if($value2==5)   $RESULT=$RESULT/$price5;
                        //echo $value2;
                        //echo "HELLO";
                        //echo $RESULT;
                        //echo "HI";
                        $value3=$_POST['amount1'];
                        $RESULT=$RESULT*$value3;
                        echo $RESULT; 
                    }
                    $RESULT=0;
                }
            ?>            
            </div>

        <div style="width:15vw;background-color:#272324;border: 5px solid #4E4B4D;border-radius:23px;float:left; margin-left:20%; height:50vh;">
            <p style="font-weight:bold">  Crypto to Currency</p>   
            <p>From</p>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return convertvalidate2(this)">
                <select style="width: 80% ;background:#AEAEC0;" name="C" id="from">
                    <option value="1" >Bitcoin</option>
                    <option value="2">Etherium</option>
                    <option value="3">BNB</option>
                    <option value="4">Dogecoin</option>
                    <option value="5">Tether</option> <!--By default-->
                </select>

                <p>To </p>
                <select style="width: 80% ;background:#AEAEC0;" name="D" id="To">
                    <option value="1"
                        <?php if(isset($_POST['D']) && $_POST['D']=='AED') echo "selected='selected'";
                        ?>
                    >AED </option>
                    <option value="2"
                    <?php if (isset($_POST['D']) && $_POST['D']=='INR') echo "selected='selected'";
                        ?>
                    >INR</option>
                    <option value="3"
                    <?php if (isset($_POST['D']) && $_POST['D']=='USD') echo "selected='selected'";
                        ?>>USD</option>
                    <option value="4"
                    <?php if (isset($_POST['D']) && $_POST['D']=='EUR') echo "selected='selected'";
                        ?>>EUR</option>
                    <option value="5"<?php if (isset($_POST['D']) && $_POST['D']=='JPY') echo "selected='selected'";
                        ?>>JPY</option> 
                </select>
                <p style="font-size:2.5vh; margin-top:2vh;">Enter Amount</p>
                <input type="number" style="width: 80% ;background:#AEAEC0;" name="amount2" />
                <input type="submit" value="Convert" name="2" class="submitb">
                <!-- <button name="2" class="submitb" value="Submit">Convert</button> -->
                <div class="trade-value">Converted Value:</div>
            </form>    
            <?php
                if(isset($_POST['2'])){
                    $RESULT1=0;
                    if(isset($_POST['C'])){
                        $value5=$_POST['C'];
                        if($value5==1)   $RESULT1=$price1;
                        else if($value5==2)   $RESULT1=$price2;
                        else if($value5==3)   $RESULT1=$price3;
                        else if($value5==4)   $RESULT1=$price4;
                        else if($value5==5)   $RESULT1=$price5;
                        //echo $RESULT1;
                       // echo "HI";

                        $value4=$_POST['D'];
                        if($value4==1)   $RESULT1=$RESULT1*$price11;
                        else if($value4==2)   $RESULT1=$RESULT1*$price12;
                        else if($value4==3)   $RESULT1=$RESULT1*$price13;
                        else if($value4==4)   $RESULT1=$RESULT1*$price14;
                        else if($value4==5)   $RESULT1=$RESULT1*$price15;

                        //echo $value4;
                        //echo "HELLO";
                        ////echo $RESULT1;
                        //echo "HI";
                        $value6=$_POST['amount2'];
                        $RESULT1=$RESULT1*($value6/$price13);
                        echo $RESULT1;
                    }
                }
            ?>            
        </div>    
            </div>
    </div>
    </div>
</main>

<footer>
    <div class="footer-left">
        <div class="logo-info">
            <img class="footer-logo" src="img/logo.png" alt="">
            <div class="fs-12">
                &copy;CrypTrack 2022
            </div>
            <div class="fs-12 ">
                Crypto API powered by CoinGecko.
            </div>
        </div>
        
        <ul class="footer-learn">
            <li class="fs-16b">Learn</li>
            <li class="fs-12">What is crypto?</li>
            <li class="fs-12">Blockchain</li>
            <li class="fs-12">Basics of Trading</li>
        </ul>
    </div>
    <div class="footer-right">
        <ul class="footer-follow">
            <li class="fs-16b">Follow Us</li>
            <li>
                <a href="https://www.facebook.com">
                    <img src="img/footer/fb.webp" alt="facebook" class="followus-img">
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com">
                    <img src="img/footer/insta.webp" alt="" class="followus-img">
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com">
                    <img src="img/footer/linkedin.png" alt="linkedin" class="followus-img">
                </a>
            </li>
        </ul>
        <ul class="footer-contact">
            <li class="fs-16b">Contact Us</li>
            <li class="fs-12">Email</li>
        </ul>
    </div>
</footer>

<script>
function convertvalidate1(thisform)
{
    var amt1=thisform.amount1.value;
    if(amt1==null || amt1=="")
    {
        alert("Enter valid Crypto to Crypto amount")
        return false;
    }
    return true;
}
function convertvalidate2(thisform)
{
    var amt2=thisform.amount2.value;
    if(amt2==null || amt2=="")
    {
        alert("Enter valid Crypto to Currency amount")
        return false;
    }
    return true;
}


</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>