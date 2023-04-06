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
    <title>Admin News</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css"> 
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styling-adminnews.css">
    <link rel="stylesheet" href="css/scrollbar.css">

    
</head>

<script>
    function showTable(str) {
      if (str == "") {
        document.getElementById("crypto-tbl").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("crypto-tbl").innerHTML = this.responseText;
                var rowCount = document.getElementById('crypto-tbl').rows.length-1;
                document.getElementById('TotalNews').innerHTML="Total News:"+rowCount;
          }
        };
        xmlhttp.open("GET","admin_news_select.php?q="+str,true);
        xmlhttp.send();
      }
      
    }
    function getValue()
    {
        var e = document.getElementById("select-option");
        var value = e.value;
        showTable(value);


    }
    

    
    </script>


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
    <?php
    $flag_only_liked=0;
         $con = mysqli_connect('localhost','root','');
         if (!$con) {
           die('Could not connect: ' . mysqli_error($con));
         }
     
         
         mysqli_select_db($con,"cryptrack");
         $sql1 = "SELECT count(nid) as ncnt from news";
         $result=mysqli_query($con,$sql1);
         while($row = mysqli_fetch_array($result))
         {
            $totalnews=$row["ncnt"];
         }

    ?>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if(isset($_POST["searchbox"]))
            {
            $nid = $_POST["searchnid"];
            $sql1 = "select nid,ntitle,ndate,cnt from news left join (select nid as n,count(uid) as cnt from news_likes group by nid) as t1 on news.nid=t1.n where nid=".$nid;
            if($nid==null || $nid=="")
            {
                $sql1 = "select nid,ntitle,ndate,cnt from news left join (select nid as n,count(uid) as cnt from news_likes group by nid) as t1 on news.nid=t1.n";
            }

            }

        }
        
        else{
            $sql1 = "select nid,ntitle,ndate,cnt from news left join (select nid as n,count(uid) as cnt from news_likes group by nid) as t1 on news.nid=t1.n";
        }
        
        

    ?>
    <div class="main-flex">
        <div class="settings-flex">
            <ul>
                <li><a href="admin_home.php">Dashboard</a> </li>
                <li><a href="#">Users</a> </li>
                <li><a href="admin_cryptos.php">Cryptos</a> </li>
                <li><a href="admin_news.php" style="opacity:1;">News</a> </li>
                <li><a href="admin_converter.php">Converter</a> </li>
                <li><a href="logout.php">Logout</a> </li>
            </ul>
        </div>
        <div class="main-flex-right">
            <div class="header-flex">
                <div class="header-flex-left">
        <h2>News</h2>
        <h5 id="TotalNews">Total News:<?php echo $totalnews;?>
        </h5>
        
        
</div>
<form name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
        <input type="text" placeholder="Search by NID"  name="searchnid" id="input-search">
        <input type="submit" value="Search" name="searchbox" onclick="rowCount()">
        </form> 

        </div>
        <select name="" id="select-option" onchange="getValue()">
            <option value="1">Show All</option>
            <option value="2">Show Liked</option>
            <option value="3">Sort By Likes</option>
            <option value="4">Sort By Date</option>
        </select>

 
        
        
        <?php
         $con = mysqli_connect('localhost','root','');
         if (!$con) {
           die('Could not connect: ' . mysqli_error($con));
         }
     
         
         mysqli_select_db($con,"cryptrack");
         
         $result=mysqli_query($con,$sql1);
         echo'<div class="crypto-table-flex">
                    <table class="crypto-table" id="crypto-tbl">
                        <thead>
                            <tr class="crypto-table-header">
                                <td class="crypto-table-no">NID</td>
                                <td>Title</td>
                                <td class="crypto-table-price">Date</td>
                                <td class="crypto-table-trade">Likes</td>
                                <td class="crypto-table-trade">Delete</td>
                            </tr>
                        </thead>
                        <tbody>';
         
         while($row = mysqli_fetch_array($result))
         {
            $nid=$row["nid"];
            $ntitle=$row["ntitle"];
            $ndate=$row["ndate"];
            $likes=$row["cnt"];
            if($likes==NULL)
            {
                $likes=0;
            }
            echo '<tr class="crypto-table-row">';
            echo '<td class="crypto-table-data-no">'. $nid. '</td>';
            echo '<td class="crypto-table-data-name">';
            echo '<p>'.$ntitle.'</p>';
            echo '</td>';
            echo '<td class="crypto-table-data-price">'.$ndate. '</td>';
            echo '<td class="crypto-table-data-trade">'.$likes. '</td>';
            echo '<td class="crypto-table-data-trade"><a href="delete_admin_news.php?nid='.$nid.'"> <img src="img/icons/deleteicon.png" alt=""></a></td>';

            echo "</tr>";
         }
         echo '</tbody></table>
         </div>';
        ?>

        
        </div>
        
    </div>

    </div>
<script>

        function rowCount()
            {
            var rowCount = document.getElementById('crypto-tbl').rows.length-1;
            document.getElementById('TotalNews').innerHTML='Total News:'+rowCount;
            console.log(rowCount)
            }

</script>



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