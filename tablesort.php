<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/styling-maintable.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/utils.css">
    <link rel="stylesheet" href="css/fonts/fontstyle.css">
    <link rel="stylesheet" href="css/fonts/stylesheet.css">
    <link rel="stylesheet" href="css/responsive-about-us.css">
</head>
<body>

<?php

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


$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"cryptrack");
if($q==1)
{
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
while($row = mysqli_fetch_array($result)) {
  $price=rtrim($row['price'], '0');
  $img=$row['img'];
  $link=$row['info_link'];
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
  echo'<td class="crypto-table-data-24hchange c24hchange">'.$row['24h_change'].'%'.'</td>';
  echo '<td class="crypto-table-data-trade">'.$market_cap.'</td>';
  echo "</tr>";
  $count=$count+1;
  
}
echo "</tbody></table>";
mysqli_close($con);
}


if($q == 2)
{
$sql="SELECT * FROM crypto order by price desc";
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
  echo'<td class="crypto-table-data-24hchange c24hchange">'.$row['24h_change'].'%'.'</td>';
  echo '<td class="crypto-table-data-trade">'.$market_cap.'</td>';
  echo "</tr>";
  $count=$count+1;
}
echo "</tbody></table>";
mysqli_close($con);
}

if($q == 3)
{
$sql="SELECT * FROM crypto order by likes desc";
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
  echo'<td class="crypto-table-data-24hchange c24hchange">'.$row['24h_change'].'%'.'</td>';
  echo '<td class="crypto-table-data-trade">'.$market_cap.'</td>';
  echo "</tr>";
  $count=$count+1;

}
echo "</tbody></table>";
mysqli_close($con);
}




?>

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
