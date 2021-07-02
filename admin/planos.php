<?php
//require("./vendor/autoload.php");
require '../../vendor/autoload.php';
session_start();
$_SESSION["plano"] = $_POST["veiculo"];
//var_dump($_POST , $_SESSION);

$read = new \Source\Models\Read();
$read->ExeRead("app_planos_user", "WHERE id = :id ", "id={$_SESSION["plano"]}");
$read->getResult();
?>
<div class="clear"> </div>
<div class="row">
    <div class="col-md-12"> <h3>Plano Selecionado</h3> </div>
    <div class="col-md-3">Plano <b><?= $read->getResult()[0]["plano"] ?></b> </div>
    <div class="col-md-3">Descrição <b> <?= $read->getResult()[0]["descricao"] ?> </b></div>
    <div class="col-md-3">Valor <b><?= number_format($read->getResult()[0]["valor"] / 100, 2, ".", "."); ?></b> </div>
    <div class="col-md-3">Periodo <b><?= $read->getResult()[0]["periodo"] ?></b> mÊs </div>
</div>
