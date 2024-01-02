<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set("America/New_York");

$lines = file('../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) {
        continue;
    } else if (strpos(trim($line), 'DB') === 0) {
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

$con = mysqli_connect($_ENV['DB_HOST'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD'],$_ENV['DB_DATABASE']);


if (!isset($_SERVER["HTTP_HOST"])) {
    parse_str($argv[1], $_GET);
    parse_str($argv[1], $_POST);
}

if (file_get_contents("php://input") || isset($_POST['gera_bonus']) || isset($_POST['busca_usuarios'])) {
    if (isset($_POST['busca_usuarios'])) {
        $data = mysqli_real_escape_string($con, $_POST["data"]);
        $count = 0;
        $array_users = array();
        $buscaUsuario = mysqli_query($con, '
        SELECT users.id, packages.capping_coin, packages.bonus, orders_package.id AS order_id 
        FROM users 
        INNER JOIN orders_package ON orders_package.user_id = users.id 
        INNER JOIN packages ON packages.id = orders_package.package_id 
        WHERE orders_package.status = "1"');
        $buscaUsuario = mysqli_fetch_all($buscaUsuario, MYSQLI_ASSOC);
        
        $flag = 0;
        foreach ($buscaUsuario as $usuariox) {
            $profit = $usuariox["capping_coin"];
            $array_users[] = array('id_user' => $usuariox["id"], 'data' => $data, 'profit' => $profit, 'order_id' => $usuariox["order_id"]);
            $flag = 1;
        }
        if ($flag == 0) die("ERRO");
    } else if (isset($_POST['gera_bonus'])) {
        $retorno = UnilevelBot($_POST['id_user'], $_POST['data'], $_POST['profit'], $_POST['order_id']);
        die(mysqli_query($con, $retorno));
    }
}

function UnilevelBot($id_user, $data, $profit, $order_id)
{
    $data_atual = date($data . " 01:01:01");
    $insert = "INSERT INTO `banco` (`user_id`, `order_id`, `description`, `price`, `status`) VALUES ('{$id_user}', '{$order_id}', 'Daily Bonus', '{$profit}', '1');";
    return $insert;
}
