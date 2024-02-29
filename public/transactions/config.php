<?php

$banco_user = 'binfinit_cryptopay';
$banco_senha = 'Hnash@kjPbab@';
$con = @mysqli_connect("localhost", $banco_user, $banco_senha, "binfinit_cryptopay");


@mysqli_query($con, "SET NAMES 'utf8'");
@mysqli_query($con, 'SET character_set_connection=utf8');
@mysqli_query($con, 'SET character_set_client=utf8');
@mysqli_query($con, 'SET character_set_results=utf8');



?>