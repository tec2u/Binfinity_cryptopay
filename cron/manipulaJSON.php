<?php
date_default_timezone_set('America/New_York');
$_POST['data'] = date("Y-m-d", strtotime("-1 days"));
$_POST['busca_usuarios'] = '1';
include __DIR__.'/novoBonusManual.php';
$server_output = $array_users;
$split_output = array_chunk($server_output, ceil(count($server_output) / 20));
$cont = 0;
foreach ($split_output as $output) {
    $jsonFile = fopen("TXTBonusCron" . $cont . ".txt", "w") or die("Unable to open file!");
    $txt = str_replace(array(','), '&', str_replace(array(':'), '=', str_replace(array('{', '}', '"'), '', str_replace(array('[', ']'), '', str_replace(array('},{'), '}' . PHP_EOL . '{', json_encode($output))))));
    fwrite($jsonFile, $txt);
    fclose($jsonFile);
    $cont++;
}
die("OK");
