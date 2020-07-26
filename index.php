<!-- if you use base scaner signal then use this -->
<html><head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <style>
    body {
  background-color: blue;
  color: white;
}
</style></head>
<body>
    <div class="container">
  
<center>
    <h2>Order form for Hitbtc</h2>
    <form action="submit.php" method="post">
        <table>
    <tr><td></td><td>COIN NAME</td><td>Choose a Market:</td></tr>
    <tr><td></td><td><input style="height:40px;font-size:14pt;" type="text" name="symbol" placeholder="write coin name" required>-<label for="symbol1"></label>
<select style="height:40px;font-size:14pt;" name="symbol1">
  <option value="BTC">BTC</option>
  <option value="USD">USD</option>
  <option value="ETH">ETH</option>
</select>
<tr><td>Quantity</td><td><input style="height:40px;font-size:14pt;" type="text" name="quantity" placeholder="quantity" required></td></tr>
    <tr><td>Buy price : </td><td><input style="height:40px;font-size:14pt;" type="text" name="base" placeholder="write buy price" required>
    <input style="height:40px;font-size:14pt;" type="hidden" name="basep" value="0" required>
   <!-- <label for="basep"></label>
<select style="height:40px;font-size:14pt;" name="basep">
    <option value="10">10%</option>
  <option value="5">5%</option>
  <option value="0">0%</option>
  <option value="20">20%</option>
</select> -->
</td></tr>
    <tr><td>Sell price : </td><td>
    <input style="height:40px;font-size:14pt;" type="text" name="sellprice" placeholder="write sellprice" required>
    <input style="height:40px;font-size:14pt;" type="hidden" name="sellprice1" value="0" required>
  <!--  <label for="sellprice1"></label>
<select style="height:40px;font-size:14pt;" name="sellprice1">
  <option value="0.5">0.5%</option>
  <option value="1">1%</option>
  <option value="2">2%</option>
  <option value="3">3%</option>
  <option value="5">5%</option>
  <!-- <option value="20">20%</option>
  <option value="10">10%</option>
  <option value="7">7%</option>
  <option value="0">0%</option> 
</select> -->
</td></tr>

    <tr><td></td><td><input style="height:40px;font-size:14pt;" type="submit" name="submit" value="submit"></td></tr>
        
        
        </table>
        
    </form>
</center>
</div>
</body></html>
