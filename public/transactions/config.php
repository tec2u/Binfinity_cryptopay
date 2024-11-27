<?php

$banco_user = 'tecnol15_binfinitycrypto';
$banco_senha = 'tecnol15_binfinitycrypto';
$con = @mysqli_connect("localhost", $banco_user, $banco_senha, "tecnol15_binfinitycrypto");


@mysqli_query($con, "SET NAMES 'utf8'");
@mysqli_query($con, 'SET character_set_connection=utf8');
@mysqli_query($con, 'SET character_set_client=utf8');
@mysqli_query($con, 'SET character_set_results=utf8');



?>