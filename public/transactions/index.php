<!DOCTYPE html>
<html lang="en">

<head>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="B Inifnity Bank - Crypto Pay">
		<meta name="author" content="BInfinity">
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
		<link rel="icon" type="image/png" sizes="400x400" href="../assetsWelcomeNew/images/icon.png">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<title>B Inifnity C - Relatorio</title>
		<style>
			tr td {
				overflow-x: auto;
				max-width: 100px;
			}

			tbody tr {
				margin-top: 2rem;
			}
		</style>
	</head>
</head>

<body>
	<?php

	error_reporting(E_ERROR | E_PARSE);
	include "config.php";

	if ($_GET['type'] == '' or $_GET['type'] == '1') {
		$and = 'and type=1';
	} else {
		$and = 'and type=2';
	}

	$sql = mysqli_query($con, "select * from node_orders where id>0 $and order by id desc");

	if ($_GET['change_withdrawal'] != '') {


		$get_change = mysqli_fetch_array(mysqli_query($con, "select * from node_orders where id=" . $_GET['id']));

		if ($get_change['withdrawn'] == 1) {
			$change = 0;
		}
		if ($get_change['withdrawn'] == 0) {
			$change = 1;
		}

		mysqli_query($con, "update node_orders set withdrawn=$change where id=" . $_GET['id']);

	}

	echo "<a href='?type=1'>ENTRADAS</a> | <a href='?type=2'>SAIDAS</a></br></br>";

	?>

	<table class="table" style="overflow-x: scroll;">
		<thead>
			<tr>
				<th scope="col">id</th>
				<th scope="col">Coin</th>
				<th scope="col">Status</th>
				<th scope="col">Price</th>
				<th scope="col">Price crypto</th>
				<th scope="col">Price crypto Paid</th>
				<th scope="col">Wallet</th>
				<th scope="col">Withdrawn</th>
				<th scope="col">Change Withdrawn</th>
				<th scope="col">Link Hash</th>
				<th scope="col">Withdrawn Link Hash</th>
			</tr>
		</thead>
		<tbody>



			<?php while ($pega_order = mysqli_fetch_array($sql)): ?>
				<?php
				if (strtolower($pega_order['status']) == "failed") {
					$class = 'table-danger';
				}
				if (strtolower($pega_order['status']) == "expired") {
					$class = 'table-warning';
				}
				if (strtolower($pega_order['status']) == "paid") {
					$class = 'table-success';
				}
				if (strtolower($pega_order['status']) == "pending") {
					$class = 'table-light';
				}

				if ($pega_order['withdrawn'] == 1) {
					$change = "No";
				}
				if ($pega_order['withdrawn'] == 0) {
					$change = "Yes";
				}

				if ($pega_order['coin'] == 'TRX' or $pega_order['coin'] == 'USDT_TRC20') {
					$link_hash = "<a target='_blank' href='https://tronscan.org/#/transaction/$pega_order[hash]'>LINK</a>";
				}
				if ($pega_order['coin'] == 'ETH' or $pega_order['coin'] == 'USDT_ERC20') {
					$link_hash = "<a target='_blank' href='https://etherscan.io/tx/$pega_order[hash]'>LINK</a>";
				}
				if ($pega_order['coin'] == 'BTC') {
					$link_hash = "<a target='_blank' href='https://blockchair.com/bitcoin/transaction/$pega_order[hash]'>LINK</a>";
				}

				$id_order = $pega_order['id'];
				$sql2 = mysqli_query($con, "select * from node_orders where type=2 and payment_of_id=$id_order order by id desc");
				$pega_order_2 = null;

				if ($sql2) {
					$pega_order_2 = mysqli_fetch_array($sql2);
				}
				mysqli_free_result($sql2);

				?>
				<tr class="<?php echo $class ?>">
					<td scope="col">
						<?php echo $pega_order['id'] ?>
					</td>
					<td>
						<?php echo $pega_order['coin'] ?>
					</td>
					<td>
						<?php echo $pega_order['status'] ?>
					</td>
					<td>
						<?php echo $pega_order['price'] * 1 ?>
					</td>
					<td>
						<?php echo $pega_order['price_crypto'] * 1 ?>
					</td>
					<td>
						<?php echo $pega_order['price_crypto_payed'] * 1 ?>
					</td>
					<td>
						<?php echo $pega_order['wallet'] ?>
					</td>
					<td>
						<?php echo $pega_order['withdrawn'] == 1 ? "Yes" : "No" ?>
					</td>
					<td><a href='?change_withdrawal=1&id=<?php echo $pega_order['id'] ?>'>CHANGE WITHDRAWAL TO
							<?php echo $change ?>
						</a>
					</td>
					<td>
						<?php echo $link_hash ?>
					</td>
					<td>
						<?php
						$link_hash2 = null;
						if (isset($pega_order_2['id']) && $pega_order_2['payment_of_id'] == $pega_order['id']) {
							if ($pega_order_2['coin'] == 'TRX' or $pega_order_2['coin'] == 'USDT_TRC20') {
								$link_hash2 = "<a target='_blank' href='https://tronscan.org/#/transaction/$pega_order_2[hash]'>LINK</a>";
							}
							if ($pega_order_2['coin'] == 'ETH' or $pega_order_2['coin'] == 'USDT_ERC20') {
								$link_hash2 = "<a target='_blank' href='https://etherscan.io/tx/$pega_order_2[hash]'>LINK</a>";
							}
							if ($pega_order_2['coin'] == 'BTC') {
								$link_hash2 = "<a target='_blank' href='https://blockchair.com/bitcoin/transaction/$pega_order_2[hash]'>LINK</a>";
							}
						}

						echo $link_hash2;
						echo $pega_order_2['id'];
						$pega_order_2 = null;
						?>
					</td>
				</tr>

			<?php endwhile; ?>
		</tbody>
	</table>


	<?php

	// while ($pega_order = mysqli_fetch_array($sql)) {
	
	// 	if ($pega_order['status'] == "failed") {
	// 		$color = 'red';
	// 	}
	// 	if ($pega_order['status'] == "Expired") {
	// 		$color = 'orange';
	// 	}
	// 	if ($pega_order['status'] == "Paid") {
	// 		$color = 'green';
	// 	}
	// 	if ($pega_order['status'] == "Pending") {
	// 		$color = 'yellow';
	// 	}
	
	// 	echo "--------------------------------------------------------------------------</br>";
	// 	echo "--------------------------------------------------------------------------</br>";
	// 	echo "<span style='background-color:$color'>$pega_order[id]|$pega_order[coin]|$pega_order[status]|$pega_order[price]</span> </br>";
	
	// 	if ($pega_order['coin'] == 'TRX' or $pega_order['coin'] == 'USDT_TRC20') {
	// 		echo "<a href='https://tronscan.org/#/transaction/$pega_order[hash]'>LINK</a>";
	// 	}
	// 	if ($pega_order['coin'] == 'ETH' or $pega_order['coin'] == 'USDT_ERC20') {
	// 		echo "<a href='https://etherscan.io/tx/$pega_order[hash]'>LINK</a>";
	// 	}
	// 	if ($pega_order['coin'] == 'BTC') {
	// 		echo "<a href='https://blockchair.com/bitcoin/transaction/$pega_order[hash]'>LINK</a>";
	// 	}
	
	// 	echo "</br>CRYPTO PRICE: $pega_order[price_crypto] </br>
	// 	  CRYPTO PRICE PAID: $pega_order[price_crypto_payed] </br>
	
	// 	  WALLET: $pega_order[wallet]</br>
	// 	  WITHDRAWAL: $pega_order[withdrawn] </br>";
	
	// 	if ($pega_order['withdrawn'] == 1) {
	// 		$change = "Zero";
	// 	}
	// 	if ($pega_order['withdrawn'] == 0) {
	// 		$change = "One";
	// 	}
	
	// 	echo "<a href='?change_withdrawal=1&id=$pega_order[id]'>CHANGE WITHDRAWAL TO $change</a></br>";
	// 	echo "--------------------------------------------------------------------------</br>";
	// 	echo "--------------------------------------------------------------------------</br>";
	
	// }
	
	?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
</body>

</html>