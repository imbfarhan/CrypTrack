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




// $con = mysqli_connect('localhost','root','');
// if (!$con) {
//   die('Could not connect: ' . mysqli_error($con));
// }

// mysqli_select_db($con,"cryptrack");


// if($_SERVER['REQUEST_METHOD'] == "POST")
// {
// $coin_type=$_POST['coin'];

// $sql="SELECT price,symbol from crypto where cID = ".$coin_type; //TO FETCH THE COIN PRICE OF SELECTED CRYPTO
// $result= $con -> query($sql);
// while($row = $result -> fetch_assoc())
// {
//     $price=$row['price'];
//     $crypt=$row['symbol'];
// }
// $price=floatval($price); //CONVERT STRING TO FLOAT

// $amt=$_POST['amount'];
// $amount_usd=floatval($amt); //CONVERT STRING TO FLOAT
// $amount_crypto= $amt/$price;
// $current_value= $amount_crypto * $price ; //AMOUNT OF CRYPTO OWNED * CURRENT PRICEE OF CRYPTO                                                                                   
// $profit_loss= $current_value - $amount_usd ;
// $status=0;
// $insert_statement = "INSERT INTO cryptrade (uid,cid,crypto,amount_usd,amount_crypto,current_value,profit_loss,status) VALUES (".$_SESSION['uid'].",".$coin_type.",'".$crypt."',".$amount_usd.",".$amount_crypto.",".$current_value.",".$profit_loss.",".$status.")";
//     if($con->query($insert_statement))
//     {
//         echo"success";
//     }
//     else
//     {
//         echo "wrong.";
//     }
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrypTrade</title>
    <link rel="stylesheet" href="css/styling-cryptrade.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css">
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
                <li><a href="cryptrade.php" style="opacity:1;">CrypTrade</a></li>
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

        <?php
        //GET CURRENT PRICES

        ?>


        <?php  //LOGIC FOR PRICE UPDATE EACH TIME THE USER COMES ON THIS PAGE
            $con = mysqli_connect('localhost','root','');
            if (!$con) {
              die('Could not connect: ' . mysqli_error($con));
            }
            $total=0;
            mysqli_select_db($con,"cryptrack");
            $current_value=0;
            $total_investment=0;
            $total_valuation=0;
            $sql = "SELECT tid,cid,amount_crypto,amount_usd,status,profit_loss from cryptrade where uid=".$_SESSION['uid']; //FETCH ALL TRADES OF THE CURRENT USER
            
            $result= $con -> query($sql);
            
            while($row = $result -> fetch_assoc()) //FETCH EACH
            {
            $tid=$row['tid']; //GET TID
            $amount_crypto_owned=$row['amount_crypto']; //GET THE AMOUNT OF CRYPTO HE OWNS
            $amount_crypto_owned = floatval($amount_crypto_owned);
            $amount_usd_initial=$row['amount_usd']; //GET THE INITIAL VALUE OF INVESTMENT
            $cid=$row['cid'];
            $status=$row['status']; //GET THE STATUS OF TRADE WHETHER ACTIVE OR INACITVE
            $status=intval($status);
            $profit_loss=$row['profit_loss'];
            $total=$total+$profit_loss;  //TO CALCULATE TOTAL PROFIT/LOSS
            $total_investment=$total_investment+$amount_usd_initial; //TO CALCULATE TOTAL INVESTMENT
            $amount_usd_initial=floatval($amount_usd_initial);
                $get_price = "SELECT price FROM crypto where cID=".$cid; //FETCH THE CURRENT PRICE OF THE CRYPTO
                    $res=$con ->query($get_price);
                    while($r = $res -> fetch_assoc())
                    {
                        $price=$r['price'];  //FETCH THE CURRENT PRICE OF THE CRYPTO
                    }
                $price=floatval($price); //GET THE CURRENT PRICE OF THE CRYPTO
            $current_value=$amount_crypto_owned * $price; //CURRENT VALUE OF HIS HOLDING
            
            $profit_loss = $current_value - $amount_usd_initial; //CALCULATE PROFIT/LOSS
            if($status==1) //IF ACTIVE, THEN ONLY PERFORM THE UPDATION
            {
            $insert_stmt = "UPDATE cryptrade SET current_value=".$current_value.",profit_loss=".$profit_loss." where tid=".$tid; //UPDATE THE PRICE
            try{
            $con->query($insert_stmt);
            }
            catch (mysqli_sql_exception $e) { 
                var_dump($e);
                exit; 
             } 
            $total_valuation=round($total_valuation+$current_value,4); //CALCULATE TOTAL VALUATION OF HOLDINGS
            }
        }
        $count_active = "SELECT count(status) as cnt from cryptrade where status=1 and uid=".$_SESSION['uid'];  //FIND ACTIVE TRADES OF USER
        $res_cnt_active = $con ->query($count_active);
        while ($r = $res_cnt_active ->fetch_assoc())
        {
            $active_cnt=$r['cnt'];
        }
        $count_total = "SELECT count(status) as cnt from cryptrade where uid=".$_SESSION['uid']; //FIND TOTAL TRADES OF USER
        $res_cnt_total = $con ->query($count_total);
        while ($r = $res_cnt_total ->fetch_assoc())
        {
            $total_cnt=$r['cnt'];
        }
        ?>

        <?php //GET THE PRICES
                $price_btc;
                $price_eth;
                $price_bnb;
                $price_doge;
                $price_usdt;
                $con = mysqli_connect('localhost','root','');
                if (!$con) {
                  die('Could not connect: ' . mysqli_error($con));
                }
                
                mysqli_select_db($con,"cryptrack");
                  $sql="SELECT cID,price FROM crypto";
                  $result = mysqli_query($con,$sql);
                  $bal_query="SELECT balance FROM users where uid=".$_SESSION['uid'];
                  $balance=mysqli_query($con,$bal_query);
                  while($r = mysqli_fetch_array($balance)){
                    $bal=$r['balance'];
                  }
                  while($row = mysqli_fetch_array($result)){
                    $cid=$row['cID'];
                    $price=$row['price'];
                    if($cid==1)
                    {
                        $price_btc=$price;
                    }
                    else if($cid==2)
                    {
                        $price_eth=$price;
                    }
                    else if($cid==3)
                    {
                        $price_bnb=$price;
                    }
                    else if($cid==4)
                    {
                        $price_doge=$price;
                    }
                    else if($cid==5)
                    {
                        $price_usdt=$price;
                    }

                  }

            ?>
        <div class="main-flex">
            <div class="upper-flex">

            <div class="right-upper-flex">

<div class="crypto-prices">
    <table>
        <caption>My Stats</caption>
        <tr>
            <td>Balance</td>
            <td class="crypto-price-right" id="crypto-balance">$
                <?php echo $bal?>
            </td>
        </tr>
        <tr>
            <td>Total Profit/Loss</td>
            <td class="crypto-price-right">$
                <?php echo $total?>
            </td>
        </tr>
        <tr>
            <td>Total Investment</td>
            <td class="crypto-price-right">$
                <?php echo $total_investment?>
            </td>
        </tr>
        <tr>
            <td>Active Valuation</td>
            <td class="crypto-price-right">$
                <?php echo $total_valuation?>
            </td>
        </tr>
        <tr>
            <td>Total Trades</td>
            <td class="crypto-price-right">
                <?php echo $total_cnt?>
            </td>
        </tr>
        <tr>
            <td>Active Trades</td>
            <td class="crypto-price-right">
                <?php echo $active_cnt?>
            </td>
        </tr>
       
    </table>
</div>
</div>

                <div class="middle-upper-flex">
                    <h1>CrypTrade&#8482;</h1>
                    <div class="trade-form">
                        <form action="cryptrade_entry.php" method="post" onsubmit="return valuecheck(this)">
                            <div class="trade-form-upper">
                                <div class="trade-form-option-left">
                                    <p> Select Coin: </p>
                                    <select name="coin" id="coin" class="coin-selector" onchange="coinchecker()">
                                        <option value="1">Bitcoin</option>
                                        <option value="2">Ethereum</option>
                                        <option value="3">BNB</option>
                                        <option value="4">Dogecoin</option>
                                        <option value="5">Tether</option>
                                    </select>
                                </div>
                                <div class="trade-form-option-middle">
                                    <p>Enter Amount(in USD):</p>
                                    <input type="text" name="amount" id="amount-entered" placeholder="Amount">
                                </div>
                                <div class="trade-form-option-right">
                                    <div class="trade-value">Trade Value:</div>
                                    <p id="trade-total"></p>
                                </div>
                            </div>
                            <input type="submit" name="submit" id="submit" value="Trade">
                        </form>
                    </div>
                </div>


                <div class="right-upper-flex" style="">

                    <div class="crypto-prices">
                        <table>
                            <caption>Current Prices</caption>
                            <tr>
                                <td>Bitcoin</td>
                                <td class="crypto-price-right">
                               <div id="btc-price"> $<?php echo $price_btc?> </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Ethereum</td>
                                <td class="crypto-price-right">
                                   <div id="eth-price">$<?php echo $price_eth?> </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>BNB</td>
                                <td class="crypto-price-right">
                                    <div id="bnb-price">$<?php echo $price_bnb?> </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Dogecoin</td>
                                <td class="crypto-price-right">
                                    <div id="doge-price">$<?php echo $price_doge?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>Tether</td>
                                <td class="crypto-price-right">
                                    <div id="usdt-price">$<?php echo $price_usdt?></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>




            <div class="main-table">
                <h2>My Portfolio</h2>
                <?php
                    $count=1;            
                    $con = mysqli_connect('localhost','root','');
                    if (!$con) {
                    die('Could not connect: ' . mysqli_error($con));
                    }
                    $total=0;
                    mysqli_select_db($con,"cryptrack");
                    $sql="SELECT * FROM cryptrade natural join crypto WHERE uid=".$_SESSION['uid'];
                    $result = mysqli_query($con,$sql);
                    
                    echo'<div class="crypto-table-flex">
                    <table class="crypto-table">
                        <thead>
                            <tr class="crypto-table-header">
                                <td class="crypto-table-no">#</td>
                                <td>Crypto</td>
                                <td class="crypto-table-price">Invested Amount(USD)</td>
                                <td class="crypto-table-price">Invested Amount(Crypto)</td>
                                <td class="crypto-table-price">Active Value(USD)</td>
                                <td class="crypto-table-price">Profit/Loss(USD)</td>
                                <td class="crypto-table-price">Date Created</td>
                                <td class="crypto-table-price">Status</td>
                                <td class="crypto-table-no">Action</td>


                            </tr>
                        </thead>
                        <tbody>';
                        while($row = mysqli_fetch_array($result)){
                            $num=$count;
                            $symbol=$row['symbol'];
                            $amount_usd=$row['amount_usd'];
                            $amount_usd = number_format($amount_usd, 2, '.', '');
                            $amount_crypto=$row['amount_crypto'];
                            $current_value=$row['current_value'];
                            $profit_loss=$row['profit_loss'];
                            $total=$total+$profit_loss;
                            $date=$row['date'];
                            $status=$row['status'];
                            $tid=$row['tid'];
                            if($status==0)
                            {
                            $status_msg='Sold';
                            }
                            else{
                            $status_msg='Active';
                            }
                            echo '<tr class="crypto-table-row">';
                            echo '<td class="crypto-table-data-no">'.$num.'</td>';
                            echo '<td class="crypto-table-data-name"><p>'.$symbol.'</p></td>';
                            echo '<td class="crypto-table-data-price">'.'$'.$amount_usd.'</td>';
                            echo '<td class="crypto-table-data-price">'.$amount_crypto.' '.$symbol.'</td>';
                            echo '<td class="crypto-table-data-price">'.'$'.$current_value.'</td>';
                            echo '<td class="crypto-table-data-price-profit-loss">'.$profit_loss.'</td>';
                            echo '<td class="crypto-table-data-price">'.$date.'</td>';
                            echo '<td class="crypto-table-data-price">'.$status_msg.'</td>';
                            if($status==1)
                            {
                            echo '<td class="crypto-table-data-trade"> <a href="deactivate.php?id='.$tid.'
                            ">Sell</a></td>';
                            }
                            else
                            {
                                echo '<td class="crypto-table-data-trade"> <a href="delete.php?id='.$tid.'
                                ">Delete</a></td>';
                            }
                            echo '</tr>';
                            $count++;
                        }
                        echo "</tbody>
                        </table>";   
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
    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
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
    <script>

    </script>




<script>
     var yourSelect = document.getElementById( "coin" );  //FOR INITIAL BITCOIN LOAD
        coin_selected=( yourSelect.options[ yourSelect.selectedIndex ].value )
        console.log(coin_selected)
        coin_selected=parseInt(coin_selected)
            if(coin_selected==1)
            {
                price=document.getElementById('btc-price').textContent;
                price=price.replace('$',' ')
                price=parseFloat(price)
                symbol="BTC"
            }
    function coinchecker()
        {
       
        var yourSelect = document.getElementById( "coin" );
        coin_selected=( yourSelect.options[ yourSelect.selectedIndex ].value )
        console.log(coin_selected)
        coin_selected=parseInt(coin_selected)
            if(coin_selected==1)
            {
                price=document.getElementById('btc-price').textContent;
                price=price.replace('$',' ')
                price=parseFloat(price)
                symbol="BTC"
            }
            else if(coin_selected==2)
            {
                price=document.getElementById('eth-price').textContent;
                price=price.replace('$',' ')
                price=parseFloat(price)
                console.log(price)
                symbol="ETH"
            }
            else if(coin_selected==3)
            {
                price=document.getElementById('bnb-price').textContent;
                price=price.replace('$',' ')
                price=parseFloat(price)
                console.log(price)
                symbol="BNB"
            }
            else if(coin_selected==4)
            {
                price=document.getElementById('doge-price').textContent;
                price=price.replace('$',' ')
                price=parseFloat(price)
                console.log(price)
                symbol="DOGE"
            }
            else if(coin_selected==5)
            {
                price=document.getElementById('usdt-price').textContent;
                price=price.replace('$',' ')
                price=parseFloat(price)
                console.log(price)
                symbol="USDT"
            }
            
        }
        
        
            
            var inputBox = document.getElementById('amount-entered'); //TO DYNAMICALLY UPDATE THE PRICE
            inputBox.onkeyup = function(){
            var value = parseFloat(inputBox.value);
            if(isNaN(value))
            {
             value=0;  //IF NO VALUE IS ENTERED 
            }
            trade_val=value/price
            trade_val=trade_val.toFixed(6); //ROUNDOFF TO 6 PLACES
            trade_val=parseFloat(trade_val) //CONVERT BACK TO FLOAT
            trade_val=trade_val.toString()
            output_string=trade_val + " "+ symbol
            console.log( output_string)
            document.getElementById('trade-total').innerHTML = output_string; //UPDATE THE VALUE
             
            }

        </script>

        
    <script>
        let items = document.getElementsByClassName('crypto-table-data-price-profit-loss')
        for (i = 0; i < items.length; i++) {
            current_item = items[i].innerHTML
            current_item_val = parseFloat(current_item)
            if (current_item_val >= 0)
                items[i].style.color = 'green';
            else
                items[i].style.color = 'red';

        }

    </script>
    <script>
        function valuecheck()
        {
            var amt=document.getElementById('amount-entered').value
            var bal=document.getElementById('crypto-balance').innerText
            bal=bal.replace('$',' ')
            bal=parseFloat(bal)
            if(amt=="" || amt == null)
            {
                alert("Amount cannot be empty!")
                return false; 
            }
            else if(amt==0)
            {
                alert("Amount cannot be zero!")
                return false; 
            }
            else if(isNaN(amt))
            {
                alert("Please enter a valid amount!")
                return false;
            }
            else if(bal<amt)
            {
                
                alert("Insufficient balance!")
                return false;
                console.log(amt)
            }
        }
    </script>

    

</body>


</html>