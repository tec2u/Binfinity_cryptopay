<?php
error_reporting(E_ERROR | E_PARSE);
include "config.php";

if($_GET['type']=='' or $_GET['type']=='1'){$and = 'and type=1';}else{$and = 'and type=2';}

$sql = mysqli_query($con,"select * from node_orders where id>83 $and order by id desc");

if($_GET['change_withdrawal']!=''){
	
	
	$get_change = mysqli_fetch_array(mysqli_query($con,"select * from node_orders where id=".$_GET['id']));
	
	if($get_change['withdrawn']==1){$change=0;}
	if($get_change['withdrawn']==0){$change=1;}
	
	mysqli_query($con,"update node_orders set withdrawn=$change where id=".$_GET['id']);
	
}

echo "<a href='?type=1'>ENTRADAS</a> | <a href='?type=2'>SAIDAS</a></br></br>";

while($pega_order = mysqli_fetch_array($sql)){
	
	if($pega_order['status']=="failed"){$color='red';}
	if($pega_order['status']=="Expired"){$color='orange';}
	if($pega_order['status']=="Paid"){$color='green';}
	if($pega_order['status']=="Pending"){$color='yellow';}
	
	echo "--------------------------------------------------------------------------</br>";
	echo "--------------------------------------------------------------------------</br>";
	echo "<span style='background-color:$color'>$pega_order[id]|$pega_order[coin]|$pega_order[status]|$pega_order[price]</span> </br>";
	
	if ($pega_order['coin'] == 'TRX' or  $pega_order['coin'] == 'USDT_TRC20'){echo "<a href='https://tronscan.org/#/transaction/$pega_order[hash]'>LINK</a>";}
	if ($pega_order['coin'] == 'ETH' or  $pega_order['coin'] == 'USDT_ERC20'){echo "<a href='https://etherscan.io/tx/$pega_order[hash]'>LINK</a>";}
	if ($pega_order['coin'] == 'BTC'){echo "<a href='https://blockchair.com/bitcoin/transaction/$pega_order[hash]'>LINK</a>";}
	
	echo  "</br>CRYPTO PRICE: $pega_order[price_crypto] </br>
		  CRYPTO PRICE PAID: $pega_order[price_crypto_payed] </br>
		  
		  WALLET: $pega_order[wallet]</br>
		  WITHDRAWAL: $pega_order[withdrawn] </br>";
		  
		  if($pega_order['withdrawn']==1){$change="Zero";}
		  if($pega_order['withdrawn']==0){$change="One";}
		  
		  echo "<a href='?change_withdrawal=1&id=$pega_order[id]'>CHANGE WITHDRAWAL TO $change</a></br>";
	echo "--------------------------------------------------------------------------</br>";
	echo "--------------------------------------------------------------------------</br>";
	
}

?>