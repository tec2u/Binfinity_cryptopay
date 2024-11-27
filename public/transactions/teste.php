<?php
error_reporting(E_ERROR | E_PARSE);
include "config.php";
return;

##SERV NODE
###Mudar o processo de criação de transferencia para ver o txt com a carteira em json no servidor secundario para pegar a key. 
###e fazer a função de comparação de ver a ultima atualização do arquivo do txt, bate com o mesmo dia de criação da carteira. 
###SE CARTEIRA PESSOAL FOI MUDADA DIA 12, TXT ULTIMA ATUALIZACAO EH DIA 2. BLOQUEIA TRANSFERENCIA DO USUARIO. 
###Se não, não transfere.

##SERV BINFINITY CRYPTO
###CRYPTOGRAFAR AS CARTEIRAS E COINS
###Criar uma função que checa a carteira que esta sendo exibida com a carteira do txt. Caso seja diferente/nao existir, não exibir, tambem checar se a data da ultima atualização do arquivo txt bate com o created_at do banco.
###Criar um trigger anti update na wallets e wallets request. nunca vai ter um update. ok
###Criar uma função E um cron, caso a carteira inserida/criada não tenha txt, deleta a carteira. GERA UM LOG COM STATUS URGENTE

###DEPOIS DA CRIACAO DAS 10 CARTEIRAS, CRIAR UM TRIGGER PRA CONTAR E NAO DEIXAR CRIAR MAIS. ok
###AQUI VAMOS TER UMA TABELA DE WHITELIST IP. SE O CLIENTE FOR CRIAR CARTEIRA PESSOAL, TEM QUE ESTAR NO WHITELIST. CASO QUEIRA MUDAR ENTRAR EM CONTATO COM SUPORTE. depois
###GRAVAR O IP DE TODOS QUE ENTRAM EM UM LOG_LOGIN--> ID | LOGIN | PASSWORD | IP | CREATED_AT | UPDATED_AT


##SERV SECUNDARIO BINFINTITY
###PEGAR TODAS AS CARTEIRAS, CRIAR AS PASTAS, GRAVAR AS INFOS EM TXT DELETAR AS INFO COMO KEY E MNEMONIC DO BANCO PRINCIPAL
###RECEBER AS CARTEIRAS EM UM BANCO SECUNDARIO, SOMENTE CARTEIRAS. -----

###############################################################################
##### FALHA DE ENVIO DA TRANSACAO NAO PODEM ENTRAR COMO PENDENTE NEM COMO PENDING, TEM QUE SER FAILED
##### Transferir de uma carteira de dentro pra outra. Exemplo: Transferir da carteira A pra carteira B ( as 2 dentro do sistema ) TRX 
##### Processar ordem no ato com um botao.
##### GRAVAR NA NODE_ORDERS a carteira pra qual vai a transferencia, gravar gas fee da transacao, nos pedidos de saque, gravar o pedido de qual vem. 
##### card para fazer as carteiras crypto, colocar uma coluna no saque pra saber qual pedido foi pago na transferencia. No card colocar a soma dos pedidos Pagos X Soma dos pedidos transferidos ( valor total sem taxa )



$sql = mysqli_query($con, "select * from wallets limit 3");

while ($loop = mysqli_fetch_array($sql)) {

	$array_important_wallet_info['wallet'] = $loop['wallet'];
	$array_important_wallet_info['user_id'] = $loop['user_id'];
	$array_important_wallet_info['created_at'] = $loop['created_at'];
	$array_important_wallet_info['updated_at'] = $loop['updated_at'];
	$array_important_wallet_info['key'] = $loop['key'];
	$array_important_wallet_info['mnemonic'] = $loop['mnemonic'];
	$array_important_wallet_info['coin'] = $loop['coin'];

	$json_wallet_info = json_encode($array_important_wallet_info);


	$wallet_encrypted = base64_encode($loop['wallet']);
	$user_id_encrypted = base64_encode($loop['user_id']);

	echo "USER ID: $loop[user_id] ---- W: $loop[wallet] --- ENC: " . $wallet_encrypted . "</br> ";
	mkdir("wallets/$user_id_encrypted", 0700);
	$myfile = fopen("wallets/$user_id_encrypted/$wallet_encrypted.txt", "w");
	$txt = $json_wallet_info;
	fwrite($myfile, $txt);
	fclose($myfile);

}


?>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
This Is The Most Secure Way To Encrypt And Decrypt Your Data,
It Is Almost Impossible To Crack Your Encryption.
--------------------------------------------------------
--- Create Two Random Keys And Save Them In Your Configuration File ---
<?php
// Create The First Key
echo base64_encode(openssl_random_pseudo_bytes(32));

// Create The Second Key
echo base64_encode(openssl_random_pseudo_bytes(64));
?>
--------------------------------------------------------
<?php
// Save The Keys In Your Configuration File
define('FIRSTKEY', 'Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=');
define('SECONDKEY', 'EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==');
?>
--------------------------------------------------------
<?php
function secured_encrypt($data)
{
	$first_key = base64_decode(FIRSTKEY);
	$second_key = base64_decode(SECONDKEY);

	$method = "aes-256-cbc";
	$iv_length = openssl_cipher_iv_length($method);
	$iv = openssl_random_pseudo_bytes($iv_length);

	$first_encrypted = openssl_encrypt($data, $method, $first_key, OPENSSL_RAW_DATA, $iv);
	$second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

	$output = base64_encode($iv . $second_encrypted . $first_encrypted);
	return $output;
}
?>
--------------------------------------------------------
<?php
function secured_decrypt($input)
{
	$first_key = base64_decode(FIRSTKEY);
	$second_key = base64_decode(SECONDKEY);
	$mix = base64_decode($input);

	$method = "aes-256-cbc";
	$iv_length = openssl_cipher_iv_length($method);

	$iv = substr($mix, 0, $iv_length);
	$second_encrypted = substr($mix, $iv_length, 64);
	$first_encrypted = substr($mix, $iv_length + 64);

	$data = openssl_decrypt($first_encrypted, $method, $first_key, OPENSSL_RAW_DATA, $iv);
	$second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

	if (hash_equals($second_encrypted, $second_encrypted_new))
		return $data;

	return false;
}
?>