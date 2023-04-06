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
    <title>Saved News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css"> 
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styling-likednews.css">
    <link rel="stylesheet" href="css/scrollbar.css">
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
    <div class="main-flex">
        <div class="settings-flex">
            <ul>
                <li><a href="profile.php">Profile</a> </li>
                <li><a href="liked_news.php" style="opacity:1;">Saved News</a> </li>
                <li><a href="liked_cryptos.php">Liked Cryptos</a> </li>
                <li><a href="logout.php">Logout</a> </li>
            </ul>
        </div>
        <div class="main-flex-right">
        <h2>My Saved News</h2>
        
        <?php 
            $uid=$_SESSION['uid'];
            $con = mysqli_connect('localhost','root','');
            if (!$con) {
              die('Could not connect: ' . mysqli_error($con));
            }
            
            mysqli_select_db($con,"cryptrack");
              $sql="SELECT * from news_likes natural join news where uid=$uid";
              $result = mysqli_query($con,$sql);
              echo '<div class="news-flex">';
              while($row = mysqli_fetch_array($result)) {
                $id=$row['nid'];
                $title=$row['ntitle'];
                $desc=$row['ndesc'];
                $date=$row['ndate'];
                $link=$row['nlink'];
                $link_img=$row['nimg'];  
                    echo'<div class="news-flex-container">'; //OPEN CONTAINER
                    echo'<img alt="crypto" src="'.$link_img.'">';
                    echo'<div class="news-flex-container-title-and-like">';
                        echo'<h4>'.$title.'</h4>';
                    $nid=$id;
                    $uid=$_SESSION['uid'];
                    $like_sql = "SELECT * from news_likes where uid=$uid and nid=$nid";
                    $res= $con -> query($like_sql);
                    $num_rows = mysqli_num_rows($res);
                    $img_link_liked="img/icons/heart-fill.png";
                    $img_link_unliked="img/icons/heart-line.png";
                        if($num_rows==0)
                        {
                            echo'<a href="like_news.php?nid='.$nid.'&pid=1" class="like-img"><img src="'.$img_link_unliked.'" alt=""></a>';
                        }
                        else
                        {
                            echo'<a href="unlike_news.php?nid='.$nid.'&pid=1" class="like-img"><img src="'.$img_link_liked.'" alt=""></a>';
                        } 
                        // echo'<img src="img/icons/heart-fill.png" alt="">';
                    echo'</div>';
                    echo '<div class="news-flex-container-content">';
                        echo '<p class="news-flex-container-content-date">'.$date.'</p>';
                        echo '<p>'.$desc.'</p>';
                    echo '</div>';
                    echo ' <a href="'.$link.'" target="_blank" id="read-more"><input type="button" value="Read More" id="read-more"></a>';
                    echo'</div>'; //CLOSE CONTAINER
                    }
                    echo '</div>';
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
<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>