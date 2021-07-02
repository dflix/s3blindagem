<?php
session_start();
include './vendor/autoload.php';

$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

 $pedido = number_format($_SESSION["totalpedido"] / 100, 2, ".", ".");

$troco =  $filtro["troco"] - $pedido ;

$troco = number_format($troco, 2, "." , ".");

//var_dump($filtro , $pedido );

echo "<p style='color:red;'>Troco R$ " . $troco . "</p>";