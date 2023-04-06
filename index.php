<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>CrypTrack</title>
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/styling-landingpage.css">
    <link rel="stylesheet" href="css/scrollbar.css">

</head>

<body onload="numchecker()">
    <header>
        <img src="img/logo.png" alt="" class="logo">
        <nav>
            <ul>
                <li><a href="index.php">Explore</a></li>
                <li><a href="aboutus.php">About Us</a></li>
            </ul>
        </nav>
    </header>




    <main >
        <div class="top-flex">
            <div class="top-flex-left">
                <div class="top-flex-left-heading">
                <div class="top-flex-left-top-heading">
                    <h1>Track your </h1>
                    <div id="container">
                        <div id="text"></div><div id="cursor"></div>
                    </div>
                </div>
                <h1>today with CrypTrack.</h1>
            </div>
                <class class="button-flex">
                    <button id="login" onclick="window.location.href='login.php';">
                        Login
                    </button>
                    <button id="signup" onclick="window.location.href='signup.php';">
                        Sign Up
                    </button>
                </class>
            </div>
            <div class="hand">
                <img src="img/landingpage/hnd.png" alt="" class="hand-image">

            </div>
            <span class="hand-background"></span>
        </div>
        <div class="middle-flex">
            <img src="img/landingpage/banner.png" alt="" class="banner-image">
            <h2>Crypto tracking made easy with CrypTrack</h2>
            <h3>Popular Cryptocurrencies</h3>
            <div class="crypto-table-flex" id="crypto-tbl" onload='numchecker()'>
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
            <h4>Our Features</h4>
            <h3>Signup on CrypTrack to avail exciting features.</h3>
            <div class="info-flex">
                <div class="info-flex-item">
                    <div class="info-flex-item-header">
                        <img src="img/landingpage/icons/line-chart-fill.png" alt="">
                        <h5>Price Chart</h5>
                    </div>
                    <p>See the past price trends of cryptocurrencies in the form of a chart.</p>
                </div>
                <div class="info-flex-item">
                    <div class="info-flex-item-header">
                        <img src="img/landingpage/icons/newspaper-line.png" alt="">
                        <h5>News</h5>
                    </div>
                    <p>Read latest news to keep an eye
                        on the world of cryptocurrency.</p>
                </div>
                <div class="info-flex-item">
                    <div class="info-flex-item-header">
                        <img src="img/landingpage/icons/heart-fill.png" alt="">
                        <h5>Trending</h5>
                    </div>
                    <p>See whats the most trending cryptocurrency among the investors.</p>
                </div>
            </div>
            <div class="converter-flex">
                <div class="converter-text-flex">
                    <h2>CrypTrade&#8482;</h2>
                    <p>A beginner-friendly crypto mock trading simulator which allows you to simulate crypto investments, without the
                        risk of losing real money! Track your portfolio, profits, losses at one place.</p>
                </div>
                <img src="img/landingpage/cryptrade.png" alt="" id="detailed-info-img">
            </div>

            <div class="converter-flex flex-rev">
                <div class="converter-text-flex">
                    <h2>Easy to check your crypto in other currencies</h2>
                    <p>We offer price converter to allow you to check the value of crypto in your local currency.</p>
                </div>
                <img src="img/landingpage/converter.png" alt="">
            </div>
            <div class="converter-flex">
                <div class="converter-text-flex">
                    <h2>Detailed Info</h2>
                    <p>Check the detailed information of each cryptocurrency along with its circulating supply, daily
                        stats, weekly stats, monthly stats, yearly stats and graph.</p>
                </div>
                <img src="img/landingpage/detailedinfo.png" alt="" id="detailed-info-img">
            </div>



        </div>
            <h4 class="bottom-h4">Many more features awaiting for you!</h4>
         <p class="bottom-p">Avail all these features today by becoming a part of the CrypTrack family.</p>
        <div class="bottom-flex">
        <button id="get-started" onclick="topFunction()">
            Get Started
        </button>
    </div> 
<script>
    function topFunction() {
  document.body.scrollTop = 0; // For Safari
  window.scrollTo({top: 0})
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

<script>
    // List of sentences
var _CONTENT = [ 
	"crypto", 
	"BTC", 
	"ETH", 
	"BNB",
    "DOGE",
    "USDT"
];

// Current sentence being processed
var _PART = 0;

// Character number of the current sentence being processed 
var _PART_INDEX = 0;

// Holds the handle returned from setInterval
var _INTERVAL_VAL;

// Element that holds the text
var _ELEMENT = document.querySelector("#text");

// Cursor element 
var _CURSOR = document.querySelector("#cursor");

// Implements typing effect
function Type() { 
	// Get substring with 1 characater added
	var text =  _CONTENT[_PART].substring(0, _PART_INDEX + 1);
	_ELEMENT.innerHTML = text;
	_PART_INDEX++;

	// If full sentence has been displayed then start to delete the sentence after some time
	if(text === _CONTENT[_PART]) {
		// Hide the cursor
		_CURSOR.style.display = 'none';

		clearInterval(_INTERVAL_VAL);
		setTimeout(function() {
			_INTERVAL_VAL = setInterval(Delete, 50);
		}, 2000);
	}
}

// Implements deleting effect
function Delete() {
	// Get substring with 1 characater deleted
	var text =  _CONTENT[_PART].substring(0, _PART_INDEX - 1);
	_ELEMENT.innerHTML = text;
	_PART_INDEX--;

	// If sentence has been deleted then start to display the next sentence
	if(text === '') {
		clearInterval(_INTERVAL_VAL);

		// If current sentence was last then display the first one, else move to the next
		if(_PART == (_CONTENT.length - 1))
			_PART = 0;
		else
			_PART++;
		
		_PART_INDEX = 0;

		// Start to display the next sentence after some time
		setTimeout(function() {
			_CURSOR.style.display = 'inline-block';
			_INTERVAL_VAL = setInterval(Type, 100);
		}, 200);
	}
}

// Start the typing effect on load
_INTERVAL_VAL = setInterval(Type, 100);
</script>

</html>