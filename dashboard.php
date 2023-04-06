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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styling-maintable.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
</head>

<script>
    function showUser(str) {
      if (str == "") {
        document.getElementById("crypto-tbl").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("crypto-tbl").innerHTML = this.responseText;
            let items=document.getElementsByClassName('crypto-table-data-24hchange')
            for(i=0;i<items.length;i++)
            {
            current_item=items[i].innerHTML
            current_item_val=parseFloat(current_item)
            if(current_item_val>=0)
            items[i].style.color='green';
            else
            items[i].style.color='red';

            }
          }
        };
        xmlhttp.open("GET","tablesort.php?q="+str,true);
        xmlhttp.send();
      }
      
    }
    function getValue()
    {
        var e = document.getElementById("s-opt");
        var value = e.value;
        showUser(value);
    }
    setInterval(getValue,2000);
    
    </script>

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
            <h2>Hi, <?php echo $_SESSION["username"] ?></h2>
            <h4>Click on a crypto to know more.</h4>
            <form>
                <div class="sort-option-flex">
                Sort
                <div class="option-sort-selector">
                <select name="sort-option" onchange="showUser(this.value);" class="option-sort" id="s-opt">
                  <option value="1">Default</option>
                  <option value="2">Price</option>
                  <option value="3">Likes</option>
                </select>
                </div>
                </div>
            </form>
        </div>
        
        <div class="crypto-table-flex" id="crypto-tbl"  onload='numchecker()'>
            <?php
                
$con = mysqli_connect('localhost','root','');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}


function nice_number($n) {
    // first strip any formatting;
    $n = (0+str_replace(",", "", $n));

    // is this a number?
    if (!is_numeric($n)) return false;

    // now filter it;
    if ($n > 1000000000000) return round(($n/1000000000000), 2).'T';
    elseif ($n > 1000000000) return round(($n/1000000000), 2).'B';
    elseif ($n > 1000000) return round(($n/1000000), 2).'M';
    elseif ($n > 1000) return round(($n/1000), 2).'Th';

    return number_format($n);
}

mysqli_select_db($con,"cryptrack");
  $sql="SELECT * FROM crypto";
  $result = mysqli_query($con,$sql);
  
  echo "<table class='crypto-table'>
<thead>
<tr class='crypto-table-header'>
    <td class='crypto-table-no'>#</td>
    <td>Name</td>
    <td class='crypto-table-price'>Price</td>
    <td class='crypto-table-24hchange'>24h Change</td>
    <td class='crypto-table-trade'>Market Cap</td>
</tr>
</thead>
<tbody>";
$count=1;
$xyz="https://www.facebook.com";
while($row = mysqli_fetch_array($result)) {
  $img=$row['img'];
  $link=$row['info_link'];
  $price=rtrim($row['price'], '0');
  $market_cap=$row['market_cap'];
  $market_cap=nice_number($market_cap);

  echo '<tr class="crypto-table-row">';
  echo '<td class="crypto-table-data-no">'. $count. '</td>';
  echo '<td class="crypto-table-data-name">';
  echo '<img src=" '.$img.'">';
  echo '<p>'.'<a href="'.$link.'">'.$row['cname'].'</a>'.'</p>';
  echo '<p class="crypto-table-data-tradename">'.' •'.$row['symbol'].'</p>';
  echo '</td>';
  echo '<td class="crypto-table-data-price">'.'$' .$price . '</td>';
  echo'<td class="crypto-table-data-24hchange" id="c24hchange">'.$row['24h_change'].'%'.'</td>';
  echo '<td class="crypto-table-data-trade">'.$market_cap.'</td>';
  echo "</tr>";
  $count=$count+1;
}
echo "</tbody></table>";
mysqli_close($con);

            ?>
        </div>



    </main>




    <footer>
        <div class="footer-left">
            <div class="logo-info">
                <img class="footer-logo" src="img/logo.png" alt="">
                <div class="fs-12">
                    &copy;CrypTrack 2022
                </div>
                <div class="fs-12">
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
        let items=document.getElementsByClassName('crypto-table-data-24hchange')
        for(i=0;i<items.length;i++)
        {
            current_item=items[i].innerHTML
            current_item_val=parseFloat(current_item)
            if(current_item_val>=0)
            items[i].style.color='green';
            else
            items[i].style.color='red';

        }
        
        }
</script>

</html>