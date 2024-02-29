<?php

$banco_user = 'root';
$banco_senha = 'root';
$con = @mysqli_connect("localhost", $banco_user, $banco_senha, "binfinit_cryptopay");


@mysqli_query($con, "SET NAMES 'utf8'");
@mysqli_query($con, 'SET character_set_connection=utf8');
@mysqli_query($con, 'SET character_set_client=utf8');
@mysqli_query($con, 'SET character_set_results=utf8');



?>