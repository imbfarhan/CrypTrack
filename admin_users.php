<?php
    $con=mysqli_connect("localhost","root","","cryptrack");

    if(!$con){
        display("Connection Error");
    }

    $query="Select * from users";
    $result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css"> 
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styling-likedcryptos.css">
    <link rel="stylesheet" href="css/styling-profile.css">
    <link rel="stylesheet" href="css/styling-adminconverter.css">
    <style>
      
    .update{        
    width:100%;
    }
    .submitb{
    color: #F4EFFB;
    margin-top:2vh;
    background-color: #9507EF;
    align-items: center;
    align-self: center;
    width:30%;
    border-radius: 12px;
    font-weight:bold;
    text-shadow: 0px 2.70071px 2.70071px rgba(0, 0, 0, 0.25);
    }

    .submitb:hover{
        transition:0.2s;
        background-color: #44096A;
    }
    </style>
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
                <li><a href="admin_users.php" style="opacity:1;">Users</a> </li>
                <li><a href="">Cryptos</a> </li>
                <li><a href="logout.php">Logout</a> </li>
            </ul>
        </div>
        <div class="main-flex-right">
        <div>
            <div">
                <div>
                    <div>
                        <h2>Users</h2>
                    </div>
                    <div class="mainTable">
                        <table id="table" border="1" class="crypto-table" style="border:none;">
                            <tr class="crypto-table-header">
                                <td> UID </td>
                                <td width="30%"> Name </td>
                                <td width="10%"> Username </td>
                                <td> Phone Number </td>
                                <td> Email </td>
                                <td> Balance </td>   
                            </tr>
                            <tr >
                                <?php
                                    while($row=mysqli_fetch_assoc($result)){
                                ?>
                                    <td><?php echo $row['uid']?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['username']?></td>
                                    <td><?php echo $row['mobileno']?></td>
                                    <td><?php echo $row['email']?></td>
                                    <td><?php echo $row['balance']?></td>
                               </tr>
                                <?php
                                    }
                                ?>
                        </table>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <div class="update">
                        <h2>Update Balance</h2>
                    <div >UID: <input type="number" name="uid1"></div>
                    Balance:<input type="number" name="balance1"></div>
                    <button onclick="window.location.href=window.location.href" name="update" class="submitb">Update</button></br>
                     </div>
                </form>
                <?php
                    if(isset($_POST['update'])){
                        $uid_u=$_POST['uid1'];
                        $balance_u=$_POST['balance1'];
                        //echo $balance_u;            //just to check if values are correct
                        //echo $uid_u;
                        $query1="UPDATE users SET balance=$balance_u WHERE uid=$uid_u";
                        $result1=mysqli_query($con,$query1);
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
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>