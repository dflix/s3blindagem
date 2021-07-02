<?php
//require("./vendor/autoload.php");
require '../../vendor/autoload.php';
session_start();
//$_SESSION["plano"] = $_POST["veiculo"];
//var_dump($_POST , $_SESSION);

$trata = $_POST["planos"];

$trata = explode("|", $trata);

$Dados = [
    "plano_id" => $trata['1']
];

$exibe = new \Source\Models\Read();
$exibe->ExeRead("app_planos_user", "WHERE id = :id", "id={$trata[1]}");
$exibe->getResult();


$update = new \Source\Models\Update();
$update->ExeUpdate("app_veiculos", $Dados, "WHERE id = :id", "id={$trata['0']}");
$update->getResult();
if($update->getResult()){
    echo $exibe->getResult()[0]['plano'];
}

//var_dump($trata);


?>
