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
<?php //if you use base scaner signal use this file
include "connect.php"; 
define('TIMEZONE', 'Asia/kolkata');
date_default_timezone_set(TIMEZONE);
  $date = DATE("Y-m-d H:i:s");
$keyapi = 'API_KEY:API_SECRET'; //wrtite your api key
$balurl = 'https://api.hitbtc.com/api/2/trading/balance';
$orderurl = 'https://api.hitbtc.com/api/2/order';

if(isset($_POST['submit']))
    {
        
        $symbol0 = $_POST['symbol'];
        $symbol1 = $_POST['symbol1'];
        $quantity = $_POST['quantity'];
        $base = $_POST['base'];
        $basep = $_POST['basep'];
        $sellprice = $_POST['sellprice'];
        $sellprice1 = $_POST['sellprice1'];
        $symbol=$symbol0.$symbol1;
        $buy0 = $base-$base*$basep/100; $buy = number_format($buy0,11);
        
        //$sell0 = $sellprice+$sellprice*$sellprice1/100; $sell = number_format($sell0,11);
        $sell0 = $buy+$buy*$sellprice1/100; $sell = number_format($sell0,11);
        $btcl = $quantity*$buy; $btclow = number_format($btcl,11);

    }
    ?>

<?php //market bal
 $chbal = curl_init($balurl); 
 curl_setopt($chbal, CURLOPT_USERPWD, $apikey); // API AND KEY
 curl_setopt($chbal, CURLOPT_RETURNTRANSFER,1);
 curl_setopt($chbal, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($chbal, CURLOPT_HTTPHEADER, array('accept: application/json'));
 $return = curl_exec($chbal); 
  curl_close($chbal); 
 //print_r($return);
$data = json_decode($return, true);
$need = array(
    //1 =>'DOGE',
    $symbol1
);
foreach ($data as $key => $value) {//Extract the Array Values by using Foreach Loop
          if (in_array($data[$key]['currency'], $need)) {
              $balance=$data[$key]['available'];
          }}

?>
<?php //coin bal 
 $chbal0 = curl_init($balurl); 
 curl_setopt($chbal0, CURLOPT_USERPWD, $apikey); // API AND KEY
 curl_setopt($chbal0, CURLOPT_RETURNTRANSFER,1);
 curl_setopt($chbal0, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($chbal0, CURLOPT_HTTPHEADER, array('accept: application/json'));
 $return0 = curl_exec($chbal0); 
  curl_close($chbal0); 
 //print_r($return0);
$data0 = json_decode($return0, true);
$need0 = array(
    //1 =>'DOGE',
    $symbol0
);
foreach ($data0 as $key0 => $value) {//Extract the Array Values by using Foreach Loop
          if (in_array($data0[$key0]['currency'], $need0)) {
              $balance0=$data0[$key0]['available'];
          }}
?>
<?php

$symbol = "$symbol";
$type = "limit";
$price= "$buy";
$quantityb="$quantity";
    echo "Coin balance ",$balance0; echo "<br>";
    echo "Market balance ",$balance; echo "<br>";
if($balance > $buyamount){ echo "buy"; 
     $ch = curl_init();
//do a post
curl_setopt($ch,CURLOPT_URL,$orderurl);
curl_setopt($ch, CURLOPT_USERPWD, $keyapi); // API AND KEY 
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"symbol=$symbol&side=buy&price=$price&quantity=$quantityb&type=$type&timeInForce=GTC");
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
$query = mysqli_query($connection,"INSERT INTO trade2(price,sellprice,quantity,date,clientOrderId,type,lastbal,currency,pair) VALUES ('$priceask','$sell','$quantity123','$date','$bid123','0','$balance0','$symbol0','$symbol')");

//buy end 

}else {echo "Someting wrong , order not store in database ";}
    
    
    
} else {echo "balance low";}

echo "---------------------------------";
    echo "<br>Pair : ",$symbol; echo "<br>";
    echo "Market : ",$symbol1; echo "<br>";
    echo "Base Price : ",$base; echo "<br>";
    echo "base percent : ",$basep; echo "<br>";
    echo "buy price : ",$buy; echo "<br>";
    echo "balance Required : ",$btclow; echo "<br>";
    
    echo "profit percent : ",$sellprice1; echo "<br>";
    //echo "sellprice : ",$sellprice; echo "<br>";
    
    echo "sellprice : ",$sell; echo "<br>";
    
    
    
    
    
    echo "<a href=orderformbase.php>Place another buy order</a>";
    ?></center>
    </body></html>
