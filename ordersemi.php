<html><head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <style>
    body {
  background-color: blue;
  color: white;
  font-size: 25px;
  
}
a {
  color: hotpink;
  font-size: 30px;
}
</style></head>
<body>
<center>
<?php
include "connect.php";
define('TIMEZONE', 'Asia/kolkata');
date_default_timezone_set(TIMEZONE);
  $date = DATE("Y-m-d H:i:s");
$keyapi = 'API_KEY:API_SECRET'; //wrtite your api key
$balurl = 'https://api.hitbtc.com/api/2/trading/balance';
$orderurl = 'https://api.hitbtc.com/api/2/order';
?>
<h2>Balance</h2>
<?php 
$coinname = mysqli_fetch_array(mysqli_query($connection,"select * from trade2 where type ='0' order by RAND() limit 1"));
$coin = $coinname['currency'];
echo " currency name : ",$coin;
 $chbal = curl_init($balurl); 
 curl_setopt($chbal, CURLOPT_USERPWD, $keyapi); // API AND KEY
 curl_setopt($chbal, CURLOPT_RETURNTRANSFER,1);
 curl_setopt($chbal, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($chbal, CURLOPT_HTTPHEADER, array('accept: application/json'));
 $return = curl_exec($chbal); 
  curl_close($chbal); 
 //print_r($return);
$data = json_decode($return, true);
$need = array(
    //1 =>'DOGE',
    $coin
);
foreach ($data as $key => $value) {//Extract the Array Values by using Foreach Loop
          if (in_array($data[$key]['currency'], $need)) {
              $available=$data[$key]['available'];
 //        $querybal = mysqli_query($connection,"UPDATE balance set currency='".$data[$key]['currency']."' , available='".$data[$key]['available']."' , reserved = '".$data[$key]['reserved']."' , date='$date' where currency='$coin'");
          }}
echo " : Available Bal ", $available ; echo "<br>";
?>
<?php
$sql = "SELECT * FROM trade2 where type='0' AND currency = '$coin' AND lastbal < '$available' order by price desc limit 1";
//$sql = "SELECT m.id,m.available,m.currency,c.pair,c.quantity,c.lastbal,c.type,c.price ,c.sellprice FROM balance m INNER JOIN trade2 c ON c.currency = m.currency AND c.lastbal < m.available where type='0' order by rand() limit 1";
//$sql = "SELECT * FROM balance INNER JOIN trade2 ON currency.DOGE = currency.DOGE";
//$sql = "SELECT * FROM balance ";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $symbol = $row["pair"];
      $currency = $row["currency"];
    //  $available =$row["available"];
      $sellprice1 = $row["sellprice"];
      $quantity =$row["quantity"];
      $lastbal =$row["lastbal"];
    echo "id: " . $row["id"]. "pair: " . $row["pair"]. " - Currency: " . $row["currency"]." - available: " . $row["available"]." - lastbal: " . $row["lastbal"]." - price: " . $row["price"]." - sellprice: " . $row["sellprice"]." - type: " . $row["type"]." - quantity: " . $row["quantity"]. "<br>";
 
 //ask - bid check
$url = "https://api.hitbtc.com/api/2/public/ticker/$symbol";
$dataDOGEBTC = json_decode(file_get_contents($url), true);
$bid=$dataDOGEBTC['bid']; echo "bid price :",$bid;

 if($sellprice1 > $bid){$sellprice = $sellprice1; } else { $sellprice = $bid;}
 echo "symbol :",$symbol; echo "<br>";
 echo "Coin :",$currency; echo "<br>";
 echo "balance :",$available; echo "<br>";
 echo "sellprice :",$sellprice; echo "<br>";
 echo "quantity :",$quantity; echo "<br>";
 
$symbol = "$symbol";
$type = "limit";
$price= "$sellprice";
$quantityb="$quantity";
 
if($available > $lastbal){ echo "sell";
if($price > 0.00000001){ echo "sell price ok";
     $ch = curl_init();
//do a post
curl_setopt($ch,CURLOPT_URL,$orderurl);
curl_setopt($ch, CURLOPT_USERPWD, $keyapi); // API AND KEY 
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"symbol=$symbol&side=sell&price=$price&quantity=$quantityb&type=$type&timeInForce=GTC");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  //return the result of curl_exec,instead
  //of outputting it directly
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
//curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
$result=curl_exec($ch);
curl_close($ch);
//$result=json_decode($result);
//echo"<pre>";
//print_r($result);
//order buy end
$sita=json_decode($result, true);

$ids=$sita['id'];
$sideask=$sita['side'];
$priceask=$sita['price'];
$quantity123=$sita['quantity'];
$bid123=$sita['clientOrderId'];
echo "sita"; echo "$ids"; 
//insert order details
if($quantity123 == $quantity) { 
$query = mysqli_query($connection,"INSERT INTO trade(sellprice,quantity,date,clientOrderId,type,lastbal,symbol) VALUES ('$priceask','$quantity123','$date','$bid123','0','$balance','$symbol')");

$trade0u = mysqli_query($connection,"UPDATE trade2 SET sell='$priceask',selldate='$date', type ='1' WHERE pair = '$symbol' AND type='0'");

//buy end 

}else {echo "Someting wrong , order not store in database ";}
    
    
} else {echo "sell price wrong";}    
} else {echo "balance low";}

 
 
 
  }
} else {
  echo "0 data for sell";
}
?>
