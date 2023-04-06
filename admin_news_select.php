<!DOCTYPE html>
<html>
<head>

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
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"cryptrack");

if($q==1)
{
  $sql="select nid,ntitle,ndate,cnt from news left join (select nid as n,count(uid) as cnt from news_likes group by nid) as t1 on news.nid=t1.n";
}

if($q==2)
{
  $sql="select nid,ntitle,ndate,cnt from news left join (select nid as n,count(uid) as cnt from news_likes group by nid) as t1 on news.nid=t1.n where cnt is not null";
}

if($q==3)
{
  $sql="select nid,ntitle,ndate,cnt from news left join (select nid as n,count(uid) as cnt from news_likes group by nid) as t1 on news.nid=t1.n order by cnt desc";
}
if($q==4)
{
  $sql="select nid,ntitle,ndate,cnt from news left join (select nid as n,count(uid) as cnt from news_likes group by nid) as t1 on news.nid=t1.n order by ndate desc";
}

  $result = mysqli_query($con,$sql);
  echo'
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
echo '</tbody>';

mysqli_close($con);




?>

</body>

</html>
