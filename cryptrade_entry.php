<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}


$con = mysqli_connect('localhost','root','');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"cryptrack");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $amt=$_POST['amount'];

$coin_type=$_POST['coin'];

$sql="SELECT price,symbol from crypto where cID = ".$coin_type; //TO FETCH THE COIN PRICE OF SELECTED CRYPTO
$result= $con -> query($sql);
while($row = $result -> fetch_assoc())
{
    $price=$row['price'];
    $crypt=$row['symbol'];
}
$price=floatval($price); //CONVERT STRING TO FLOAT



$amount_usd=floatval($amt); //CONVERT STRING TO FLOAT
$amount_crypto= $amt/$price;
$current_value= $amount_crypto * $price ; //AMOUNT OF CRYPTO OWNED * CURRENT PRICEE OF CRYPTO                                                                                   
$profit_loss= $current_value - $amount_usd ;
$status=1;
$userid=$_SESSION['uid'];
$update_bal="UPDATE users SET balance=balance-$amount_usd where uid=$userid";
$con->query($update_bal);
$insert_statement = "INSERT INTO cryptrade (uid,cid,amount_usd,amount_crypto,current_value,profit_loss,status) VALUES (".$_SESSION['uid'].",".$coin_type.",".$amount_usd.",".$amount_crypto.",".$current_value.",".$profit_loss.",".$status.")";
    if($con->query($insert_statement))
    {
        echo"success";
    }
    else
    {
        echo "wrong.";
    }

    
    header("location: cryptrade.php");

}
?>