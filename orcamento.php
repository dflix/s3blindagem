<?php
require './vendor/autoload.php';

$os = new Source\Models\Read();
$os->ExeRead("app_orcamento", "WHERE orcamento_id = :a", "a={$_GET["os"]}");
$os->getResult();

 $orc = str_pad($os->getResult()[0]["orcamento_id"], 7, "0", STR_PAD_LEFT);
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Orçamento <?= CONF_SITE_NAME ?></title>
        <link rel="stylesheet" href="_cdn/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container-fluid"> 
            <div class="row"> 

                <div class="col-md-6 m1"> <img src="assets/image/logo2.png" width="200" /></div>
                <div class="col-md-6"> 
                    <p class="text-right"> <b><?= CONF_SITE_NAME ?></b> </p>
                    <p class="text-right"> <?= CONF_SITE_ADDR_STREET ?> nº <?= CONF_SITE_ADDR_NUMBER ?> - <?= CONF_SITE_ADDR_ZIPCODE ?> </p>
                    <p class="text-right"> <?= CONF_SITE_ADDR_TELEFONE ?>  </p>
                </div>
            </div>
            <h2 class="text-center border-bottom">ORÇAMENTO <?= CONF_SITE_NAME ?></br> nº <?= $orc; ?> </h2>
        </div>
        <table class="table"> 
            <thead> 
                <tr> 
                    <th> CLIENTE </th>
                    <th> TELEFONE </th>
                    <th> EMAIL </th>
                </tr>
            </thead>
            <tbody> 
                <tr>
                    <td><?= $os->getResult()[0]["cliente"] ?> </td>
                    <td><?= $os->getResult()[0]["telefone"] ?> </td>
                    <td><?= $os->getResult()[0]["email"] ?> </td>
                </tr>
            </tbody>

        </table>
        
        <table class="table"> 
         <thead> 
                <tr> 
                    <th> MARCA </th>
                    <th> MODELO </th>
                    <th> ANO </th>
                    <th> COR </th>
                    <th> PLACA </th>
                    <th> km </th>
                </tr>
            </thead>
            <tbody> 
                <tr> 
                    <td> <?= $os->getResult()[0]["marca"] ?></td>
                    <td><?= $os->getResult()[0]["modelo"] ?> </td>
                    <td><?= $os->getResult()[0]["ano"] ?> </td>
                    <td> <?= $os->getResult()[0]["cor"] ?></td>
                    <td><?= $os->getResult()[0]["placa"] ?> </td>
                    <td><?= $os->getResult()[0]["km"] ?> </td>
                </tr>
            </tbody>
        </table>
        <h3 class="text-center border-bottom"> ITENS DO SERVIÇO </h3>
        
        <table class="table"> 
        
            <thead> 
                <tr> 
                    <th>QTD </th>
                    <th>ITEM </th>
                    <th>VALOR UNITARIO </th>
                    <th>VALOR TOTAL </th>
                </tr>
            </thead>
            <tbody> 
                <?php 
                $itens = new \Source\Models\Read();
                $itens->ExeRead("app_orcamento_itens", "WHERE orcamento_id = :a" , "a={$_GET["os"]}");
                $itens->getResult();
                $soma = 0;
                foreach ($itens->getResult() as $item) {
                    $total = $item["qtd"] * $item["valor_unit"];
                    
                    $soma += $total;
                ?>
                <tr> 
                    <td> <?= $item["qtd"] ?></td>
                    <td> <?= $item["item"] ?> </td>
                    <td> <?= number_format($item["valor_unit"] / 100,2,".",",")  ?>  </td>
                    <td><?= number_format($total / 100,2,".",",")  ?> </td>
                </tr>
                <?php } ?>
                <tr> 
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>R$ <?= number_format($soma/100,2,".",".") ?> </td>
                </tr>
            </tbody>
        
        </table>
        
        
        <h3 class="text-center border-bottom"> FORMAS DE PAGAMENTO </h3>
        <div class="container"> 
        
            <?php 
            
            $forma = new \Source\Models\Read();
            $forma->ExeRead("app_orcamento_pagamento", "WHERE orcamento_id = :a", "a={$_GET["os"]}");
            $forma->getResult();
            
            ?>
            
            <p class="text-center"> <?= $forma->getResult()[0]["forma_pagamento"] ?> </p>
        
            <p class="text-center">Orçamento realizado dia <?= date("d/m/Y H:i:s" , strtotime($os->getResult()[0]["data"])); ?> </p>
            <p class="text-center">Orçamento valido por 5 dias </p>
        </div>
        
    </body>
</html>
