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



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tether</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styling-bitcoininfo.css">

    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styling-bitcoininfo.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/scrollbar.css">
</head>


<?php

$con = mysqli_connect('localhost','root','');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"cryptrack");
$sql = "SELECT * from crypto where cid=5";
$result=mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
    $price=rtrim($row['price'], '0');
    $img=$row['img'];
    $link=$row['info_link'];
    $price_24h_low = $row['24h_low'];
    $price_24h_high = $row['24h_high'];
    $price_24h_change = $row['24h_change'];
    $price_7d_change = $row['7d_change'];
    $price_30d_change = $row['30d_change'];
    $price_1y_change=$row['1y_change'];
    $total_supply = $row['total_supply'];
    $circulating_supply = $row['circulating_supply'];
    $graph = $row['graph'];
    $likes = $row['likes'];
  }
?>

<body onload="numchecker()">
<header>
        <div class="img-flex">
        <img src="img/logo.png" alt="" class="logo">
         </div>
        <nav>
            <ul>
                <li><a href="dashboard.php" style="opacity:1;">Track</a></li>
                <li><a href="cryptrade.php">CrypTrade</a></li>
                <li><a href="converter.php">Convert</a></li>
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
        <div class="top-flex">
            <div class="top-flex-left">
                <div class="coin-name">
                    <?php echo '<img src=" '.$img.'">'; ?>
                    <h2>Tether</h2>
                    <h4>
                        <ul>
                            <li> <span>USDT</span> </li>
                        </ul>
                    </h4>
                    <?php
                                //FOR LIKE SYSTEM
                        $cid=5;
                        $uid=$_SESSION['uid'];
                        $sql = "SELECT * from likes where uid=$uid and cid=$cid";
                        $result= $con -> query($sql);
                        $num_rows = mysqli_num_rows($result);
                        $img_link_liked="img/icons/heart-fill.png";
                        $img_link_unliked="img/icons/heart-line.png";
                            if($num_rows==0)
                            {
                                echo'<a href="like.php?cid='.$cid.'" class="like-img"><img src="'.$img_link_unliked.'" alt=""></a>';
                            }
                            else
                            {
                                echo'<a href="unlike.php?cid='.$cid.'" class="like-img"><img src="'.$img_link_liked.'" alt=""></a>';
                            } 
                        ?>
                        
                    <div class="trade"> <a href="https://www.binance.com/en" target="_blank"> Trade</a></div>
                </div>

                <div class="coin-price">
                    <p>$<?php echo $price?></p>
                    <p class="profit-loss"><?php echo $price_24h_change?>%</p>
                </div>
            </div>
            <div class="top-flex-right">
                <p>Circulating Supply</p>
                <table class="coin-supply">
                    <tr>
                        <td>Max Supply</td>
                        <td><?php echo $total_supply ?></td>
                    </tr>
                    <tr>
                        <td>Total Supply</td>
                        <td style='text-align:right;'><?php echo $circulating_supply ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="stats-and-graph-flex">
            <div class="coin-stats">
                <table class="coin-stats-info">
                    <tr class="coin-stats-info-row">
                        <td class="coin-stats-info-row-left">24H High</td>
                        <td class="coin-stats-info-row-right-white">$<?php echo $price_24h_high ?></td>
                    </tr>
                    <tr>
                        <td class="coin-stats-info-row-left">24H Low</td>
                        <td class="coin-stats-info-row-right-white">$<?php echo $price_24h_low ?></td>
                    </tr>
                    <tr>
                        <td class="coin-stats-info-row-left">24H Change</td>
                        <td class="coin-stats-info-row-right"><?php echo $price_24h_change.'%' ?></td>
                    </tr>
                    <tr>
                        <td class="coin-stats-info-row-left">7D Change</td>
                        <td class="coin-stats-info-row-right"><?php echo $price_7d_change.'%' ?></td>
                    </tr>
                    <tr>
                        <td class="coin-stats-info-row-left">30D Change</td>
                        <td class="coin-stats-info-row-right"><?php echo $price_30d_change.'%' ?></td>
                    </tr>
                    <tr>
                        <td class="coin-stats-info-row-left">1Y Change</td>
                        <td class="coin-stats-info-row-right"><?php echo $price_1y_change.'%' ?></td>
                    </tr>
                </table>
            </div>
            <div class="graph">
                <h2>Price Chart (24h)</h2>
                <?php echo '<img src=" '.$graph.'">'; ?>
            </div>
        </div>
        <div class="coin-about">
            <h4>What is Tether?</h4>
            <p>Tether is an asset-backed cryptocurrency stablecoin. It was launched by the company Tether Limited Inc. in 2014. Tether Limited is owned by the Hong Kong-based company iFinex Inc, which also owns the Bitfinex cryptocurrency exchange. As of July 2022, Tether Limited has minted the USDT stablecoin on ten protocols and blockchains. Tether is described as a stablecoin because it was originally designed to be valued at USD $1.00, with Tether Limited maintaining USD $1.00 of asset reserves for each USDT issued</p>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
<script>
        function numchecker()
        {
        let items=document.getElementsByClassName('coin-stats-info-row-right')
        for(i=0;i<items.length;i++)
        {
            current_item=items[i].innerHTML
            current_item=current_item.replace('$','')
            current_item_val=parseFloat(current_item)
            console.log(current_item_val)
            if(current_item_val>=0)
            items[i].style.color='green';
            else
            items[i].style.color='red';

        }
        
        }

        let items=document.getElementsByClassName('profit-loss')
        for(i=0;i<items.length;i++)
        {
            current_item=items[i].innerHTML
            current_item=current_item.replace('$','')
            current_item_val=parseFloat(current_item)
            console.log(current_item_val)
            if(current_item_val>=0)
            items[i].style.color='green';
            else
            items[i].style.color='red';

        }


</script>
</html>