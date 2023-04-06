<?php

session_start();

if($_SESSION['username']!='admin')
{
    header("location: dashboard.php");  
}


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
    <title>Admin Converter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css"> 
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styling-admincryptos.css">
    <link rel="stylesheet" href="css/styling-adminconverter.css">

    
</head>
<body>
<header>
        <div class="img-flex">
        <img src="img/logo.png" alt="" class="logo">
         </div>
        <nav>

        </nav>
        <div class="user-flex">
            <div class="dropdown show">
                <a class="user-button bg-transparent dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo "Admin"; ?>
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </div>
        </div>
        
</header>

<main>
    <div class="main-flex">
        <div class="settings-flex">
            <ul>
                <li><a href="admin_home.php">Dashboard</a> </li>
                <li><a href="#">Users</a> </li>
                <li><a href="admin_cryptos.php">Cryptos</a> </li>
                <li><a href="admin_news.php">News</a> </li>
                <li><a href="admin_converter.php" style="opacity:1;">Converter</a> </li>
                <li><a href="logout.php">Logout</a> </li>
            </ul>
        </div>
        <div class="main-flex-right">
        <h2>Converter</h2>
        <div class="converter-heading">
        <h5>Prices</h5>
        <h5>Base = EUR</h5>
        </div>
        <?php
         $con = mysqli_connect('localhost','root','');
         if (!$con) {
           die('Could not connect: ' . mysqli_error($con));
         }
     
         
         mysqli_select_db($con,"cryptrack");
         $sql1 = "SELECT cur_id,cur_price FROM convertor";
         $result=mysqli_query($con,$sql1);
         echo'<div class="crypto-table-flex">
                    <table class="crypto-table" style="width:60%;">
                        <thead>
                            <tr class="crypto-table-header">
                                <td class="crypto-table-no">CurID</td>
                                <td>Currency Name</td>
                                <td class="crypto-table-price">Currency Price</td>
                            </tr>
                        </thead>
                        <tbody>';
         
         while($row = mysqli_fetch_array($result))
         {
            $cur_id=$row["cur_id"];
            $cur_price=$row["cur_price"];
            switch($cur_id){
            case 1:
                $cur_name="Emirati Dirham";
                $cur_code="AED";
                $cur_symbol="DH";
            break;
            case 2:
                $cur_name="Indian Rupee";
                $cur_code="INR";
                $cur_symbol="₹";
                break;
            case 3:
                $cur_name="US Dollar";
                $cur_code="USD";
                $cur_symbol="$";
                break;  
            case 4:
                $cur_name="Euro";
                $cur_code="EUR";
                $cur_symbol="€";
                break;
            case 5:
                $cur_name="Japanese Yen";
                $cur_code="JPY";
                $cur_symbol="¥";
            break;                        
            

            }
            echo '<tr class="crypto-table-row">';
            echo '<td class="crypto-table-data-no">'. $cur_id. '</td>';
            echo '<td class="crypto-table-data-name">';
            echo '<p>'.$cur_name.'</p>';
            echo '<p class="crypto-table-data-tradename">'.' •'.$cur_code.'</p>';
            echo '</td>';
            echo '<td class="crypto-table-data-price">';
            echo '<p>'.$cur_symbol.' '.$cur_price.'</p>';
            echo '</td>';

            echo "</tr>";
         }
         echo '</tbody></table>
         </div>';
        ?>

        
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
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>