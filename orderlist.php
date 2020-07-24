<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<?php
include("connect.php");
//$sqldel = mysqli_query($connection, "DELETE FROM trade1 WHERE type  = '5'") ;
//$sqldel1 = mysqli_query($connection, " DELETE FROM trade WHERE date < 'DATE_SUB(CURRENT_TIME (),INTERVAL 10 MINUTE)' ") ;

?>
	<table width="80%" border="2" style= "background-color: #030ffc; color: #ffffff; margin: 0 auto;" >

              <tr align="center" class="title" bgcolor="#ffffff">
			  <th height="21" colspan="16" align="center" bgcolor="#030ffc"><span class="style2"><font size="4">ALL ORDER LIST</font></span> </th>
              </tr>
              
              <tr align="center" class="title">
               <th width="4%" align="center" bgcolor="#030ffc"><span class="style3">S.No</span></th>
	   		  <th width="4%" align="center" bgcolor="#030ffc"><span class="style3">ID </span></th>
              <th width="4%" align="center" bgcolor="#030ffc"><span class="style3">TYPE</span></th>
              <th width="14%" align="center" bgcolor="#030ffc"><span class="style3">Pair</span></th>
              <th width="14%" align="center" bgcolor="#030ffc"><span class="style3">BUY PRICE</span></th>
              <th width="14%" align="center" bgcolor="#030ffc"><span class="style3">SELL PRICE</span></th>
              <th width="14%" align="center" bgcolor="#030ffc"><span class="style3">Sell</span></th>
              <th width="4%" align="center" bgcolor="#030ffc"><span class="style3">QUANTITY</span></th>
              <th width="14%" align="center" bgcolor="#030ffc"><span class="style3">BUY DATE</span></th>
              <th width="14%" align="center" bgcolor="#030ffc"><span class="style3">Sell Date</span></th>
              <th width="14%" align="center" bgcolor="#030ffc"><span class="style3">Coin Bal</span></th>
              
              
              
                </tr>
              <?php
			  $rowsPerPage = 20;
				$pageNum = 1;
				if(isset($_GET['page']))
				{
					$pageNum = $_GET['page'];
				}
				$offset = ($pageNum - 1) * $rowsPerPage;
				
				$counter=($pageNum -1)*$rowsPerPage + 1;
				
							$query1 = mysqli_query($connection,"SELECT * FROM trade2  order by id desc LIMIT $offset, $rowsPerPage") or die("Query Fail #1");
							$response1 = mysqli_num_rows($query1);
							if($response1>0)
							{
								for($count=1;$count<=$response1;$count++)
								{
									$data = mysqli_fetch_array($query1);
									?>
             
              <tr class="data">
			  	<td width="4%" align="center"><?php echo $counter;?></td>
                <td width="4%" align="justify"><?php echo $data['id']; ?></td>
                <td width="4%" align="center"><?php echo $data['type']; ?></td>
                <td width="14%" align="center"><?php echo $data['pair']; ?></td>
                <td width="14%" align="center"><?php echo $data['price']; ?></td>
                <td width="14%" align="center"><?php echo $data['sellprice']; ?></td>
                <td width="14%" align="center"><?php echo $data['sell']; ?></td>
                <td width="4%" align="center"><?php echo $data['quantity']; ?></td>
                <td width="14%" align="center"><?php echo $data['date']; ?></td>
                <td width="14%" align="center"><?php echo $data['selldate']; ?></td>
                
                <td width="14%" align="center"><?php echo $data['lastbal']; ?></td>
                
                
                
              </tr>
              <tr align="center" class="title"></tr>
              <?php
			  		$counter++;
								}
							}	
						?>
            </table>
	<center>
  <?php
  $resultpaging  = mysqli_query($connection,"SELECT * FROM trade2 order by id desc") or die('Error, query failed');
						$rows = mysqli_num_rows($resultpaging);
						$maxPage = ceil($rows/$rowsPerPage);
						$self = $_SERVER['PHP_SELF'];
						$nav  = '';
						for($page = 1; $page <= $maxPage; $page++)
						{
							if ($page == $pageNum)
							{
								$nav .= " $page "; 
							}
							else
							{
								$nav .= " <a href=\"$self?page=$page\" class=\"new\" style=\"color:#000000\">$page</a> ";
							} 
						}
						if ($pageNum > 1)
						{
							$page  = $pageNum - 1;
							$prev  = " <a href=\"$self?page=$page\" class=\"new\" style=\"color:#000000\">[Prev]</a> ";
							$first = " <a href=\"$self?page=1\" class=\"new\" style=\"color:#000000\">[First Page]</a>" ;
						} 
						else
						{
						   $prev  = '&nbsp;'; 
						   $first = '&nbsp;';
						}
						if ($pageNum < $maxPage)
						{
						   $page = $pageNum + 1;
						   $next = " <a href=\"$self?page=$page\" class=\"new\" style=\"color:#000000\">[Next]</a> ";
						
						   $last = " <a href=\"$self?page=$maxPage\" class=\"new\" style=\"color:#000000\">[Last Page]</a> ";
						} 
						else
						{
						   $next = '&nbsp;';
						   $last = '&nbsp;';
						}
						echo "<tr><td align=\"center\" width=\"100%\"  style=\"color:#000000\"><strong>Page No: ".$first . $prev . "$pageNum of $maxPage" . $next . $last."</strong></td></tr>";
					
					  ?>

</center>
	</body>
	</html>
