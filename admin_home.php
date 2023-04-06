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


<?php

    $con = mysqli_connect('localhost','root','');
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    
    mysqli_select_db($con,"cryptrack");
    $sql1 = "SELECT COUNT(*) as cnt FROM users";
    $result=mysqli_query($con,$sql1);
    while($row = mysqli_fetch_array($result))
    {
     $usercount=$row["cnt"];  
    }
    $sql2 = "SELECT COUNT(*) as cnt  FROM `cryptrade`";
    $result=mysqli_query($con,$sql2);
    while($row = mysqli_fetch_array($result))
    {
     $TotalTrades=$row["cnt"];   
    }
    $sql3 = "SELECT COUNT(*) as cnt  FROM `cryptrade` WHERE status=1";
    $result=mysqli_query($con,$sql3);
    while($row = mysqli_fetch_array($result))
    {
     $ActiveTrades=$row["cnt"];   
    }
    $sql4 = "SELECT COUNT(*) as cnt  FROM `cryptrade` WHERE status=0";
    $result=mysqli_query($con,$sql4);
    while($row = mysqli_fetch_array($result))
    {
     $ClosedTrades=$row["cnt"]; 
    }
    $sql5 = "SELECT COUNT(*) as cnt  FROM `news`";
    $result=mysqli_query($con,$sql5);
    while($row = mysqli_fetch_array($result))
    {
     $NewsCount=$row["cnt"];
    }
    $sql6 = "SELECT COUNT(distinct nid) as cnt  FROM `news_likes`";
    $result=mysqli_query($con,$sql6);
    while($row = mysqli_fetch_array($result))
    {
        $LikedNews=$row["cnt"];
    }
    $sql7 = "SELECT min(ndate) as cnt  FROM `news`";
    $result=mysqli_query($con,$sql7);
    while($row = mysqli_fetch_array($result))
    {
        $LatestNews=$row["cnt"];
    }
    $sql8 = "SELECT count(cID) as cnt  FROM `crypto`";
    $result=mysqli_query($con,$sql8);
    while($row = mysqli_fetch_array($result))
    {
        $CryptoCount=$row["cnt"];
    }
    $sql9 = "select symbol from crypto join (select cid from likes group by cid having cid=(select max(cnt) from (select cid,count(uid) as cnt from likes group by cid) as t1)) as t2 on crypto.cID=t2.cid;";
    $result=mysqli_query($con,$sql9);
    while($row = mysqli_fetch_array($result))
    {
        $MostLiked=$row["symbol"];
    }
    $sql10 = "select symbol from crypto join (select tbl.cID,
    24h_high-24h_low AS difference from crypto tbl having difference=(select max(diff) from ( select tbl.cID,
    24h_high-24h_low AS diff from crypto tbl ) as t2)) as t3 on crypto.cID=t3.cID;";
    $result=mysqli_query($con,$sql10);
    while($row = mysqli_fetch_array($result))
    {
        $MostFluctuating=$row["symbol"];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css"> 
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styling-likedcryptos.css">
    <link rel="stylesheet" href="css/styling-profile.css">
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
                <li><a href="#" style="opacity:1;">Dashboard</a> </li>
                <li><a href="#">Users</a> </li>
                <li><a href="admin_cryptos.php">Cryptos</a> </li>
                <li><a href="admin_news.php">News</a> </li>
                <li><a href="admin_converter.php">Converter</a> </li>
                <li><a href="logout.php">Logout</a> </li>
            </ul>
        </div>
        <div class="main-flex-right">
        <h2>Dashboard</h2>
        <div class="profile-flex">
            <h4>Users</h4>
            <div class="dashboard-grid">
            <p>Total Users: <?php echo $usercount; ?></p>
            </div>

            <h4>Cryptos</h4>
            <div class="dashboard-grid">
            <p>Total Cryptos: <?php echo $CryptoCount; ?></p>
            <p>Most Liked: <?php echo $MostLiked; ?></p>
            <p>Most Fluctuating(24h): <?php echo $MostFluctuating; ?></p>
            </div>


            <h4>Trades</h4>
            <div class="dashboard-grid">
            <p>Total Trades: <?php echo $TotalTrades; ?></p>
            <p>Active Trades: <?php echo $ActiveTrades; ?></p>
            <p>Closed Trades: <?php echo $ClosedTrades; ?></p>
            </div>

            <h4>News</h4>
            <div class="dashboard-grid">
            <p>Total News:  <?php echo $NewsCount; ?></p>
            <p>Liked News:  <?php echo $LikedNews; ?></p>
            <p>Last Updated:  <?php echo $LatestNews; ?></p>
            </div>


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
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>