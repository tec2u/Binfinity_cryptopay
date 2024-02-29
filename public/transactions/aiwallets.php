<html>
<head><script src="chrome-extension://fgddmllnllkalaagkghckoinaemmogpe/scripts/content/gps.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="B Inifnity Bank - Crypto Pay">
  <meta name="author" content="BInfinity">
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="400x400" href="../assetsWelcomeNew/images/icon.png">
  <title>B Inifnity C - Relatorio</title>

</head>
<body>
<?php
error_reporting(E_ERROR | E_PARSE);
include "config.php";


$sql = mysqli_query($con,"select distinct(wallet) as wallet from node_orders where id_user=115875 and coin in ('USDT_TRC20')");
echo "<table>";
while($loop = mysqli_fetch_array($sql)){
	
	echo "<tr>";
	$final_total=0;
	$final_total2=0;
		
		echo "<td valign='top'><a target=_blank href='https://tronscan.org/#/address/$loop[wallet]'>$loop[wallet]</a></br></br>";
		echo "<a target=_blank href='https://walletprivate.onrender.com/api/query/wallet/tron/balance/$loop[wallet]'>TRX</a></br>";
		echo "<a target=_blank href='https://walletprivate.onrender.com/api/query/wallet/trc20/balance/$loop[wallet]'>USDT</a></td>";
		
		
		
		$json_trx = json_decode(file_get_contents("https://walletprivate.onrender.com/api/query/wallet/tron/balance/$loop[wallet]"),true);
		echo "<td valign='top'>";
		foreach($json_trx['data']['data'] as $value1){
			
			$value1['raw_data']['contract'][0]['parameter']['value']['amount']=round($value1['raw_data']['contract'][0]['parameter']['value']['amount']/1000000,2);
			
			$somatoria_trx=$value1['raw_data']['contract'][0]['parameter']['value']['amount'];
			$carteira = file_get_contents("https://walletprivate.onrender.com/api/transform/from/hex/wallet/tron/$value1[raw_data][contract][0][parameter][value][to_address]");
			$final_total2+=$somatoria_trx;
			$color="#000";
			
			//var_dump($value1);die();
			echo "<span style='color:$color'>TRX --".$value1['raw_data']['contract'][0]['parameter']['value']['amount']."-- to:".$carteira."</span></br>";
			
			
		}
		echo "</td>";
		
		
		
		
		$json = json_decode(file_get_contents("https://walletprivate.onrender.com/api/query/wallet/trc20/balance/$loop[wallet]"),true);
		
	//	var_dump($json['data']['data']);
		echo "<td valign='top'>";
		foreach($json['data']['data'] as $value){
			
			if($value['to']!=$loop['wallet']){$multiplier=-1;$color='red';}else{$multiplier=1;$color='green';}
			
			$total = ($value['value']/1000000)*$multiplier;
			
			$final_total+=$total;
			
			echo "<span style='color:$color'>".$value['token_info']['symbol']."--".$total."-- to:".$value['to']."</span></br>";
			
			
		}
		echo "</td>";
		
		echo "<td>FINAL USDT: ".round($final_total,2)."</td>";
		echo "<td>FINAL TRX: ".round($final_total2,2)."</td>";
		echo "</tr>";
	
}
echo "</table>";
?>
</body>

</html>