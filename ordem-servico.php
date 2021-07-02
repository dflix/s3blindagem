<?php
require './vendor/autoload.php';

//verificar ordem
$ordem = new \Source\Models\Read();
$ordem->ExeRead("app_pedidos", "WHERE pedido_id = :a", "a={$_GET["pedido"]}");
$ordem->getResult();

$cliente_id = $ordem->getResult()[0]["cliente_id"];

$cliente = new \Source\Models\Read();
$cliente->ExeRead("app_clientes", "WHERE cliente_id = :a", "a={$cliente_id }");
$cliente->getResult();

$os = str_pad($_GET["pedido"], 7, "0", STR_PAD_LEFT);

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
     <h2 class="text-center border-bottom"><?= CONF_SITE_NAME ?> </br> ORDEM DE SERVIÇO Nº <?= $os; ?>  </h2>
        </div>
         <table class="table"> 
            <thead> 
                <tr> 
                    <th> CLIENTE </th>
                    <th> CPF </th>
                    <th> RG </th>
            </thead>
            <tbody> 
                <tr>
                    <td><?= $cliente->getResult()[0]["nome"] ?> </td>
                    <td><?= $cliente->getResult()[0]["cpf"] ?> </td>
                    <td><?= $cliente->getResult()[0]["rg"] ?> </td>
                </tr>
            </tbody>
            
         </table>
        
            <h3 class="text-center border-bottom"> DADOS DO VEICULO </h3>
            
                      <?php 
          $rveiculos = new \Source\Models\Read();
          $rveiculos->ExeRead("app_veiculos", "WHERE pedido_id = :a AND cliente_id = :b ", 
                  "a={$_GET["pedido"]}&b={$cliente_id}");
          $rveiculos->getResult();
          if($rveiculos->getResult()){
          foreach ($rveiculos->getResult() as $veiculos) {

          ?>
          <div class="row">
          <p class="col-md-4">Tipo: <?= $veiculos["tipo"] ?> </p>
          <p class="col-md-4">Modelo: <?= $veiculos["modelo"] ?> </p>
          <p class="col-md-4">Marca: <?= $veiculos["marca"] ?> </p>
          <p class="col-md-4">Ano: <?= $veiculos["ano"] ?> </p>
          <p class="col-md-4">Cor: <?= $veiculos["cor"] ?> </p>
          <p class="col-md-4">Placa: <?= $veiculos["placa"] ?> </p>
          <p class="col-md-4">Chassi: <?= $veiculos["chassi"] ?> </p>
          <p class="col-md-4">Renavam <?= $veiculos["renavam"] ?> </p>
          <p class="col-md-4">FIPE: <?= $veiculos["fipe"] ?> </p>
          <p class="col-md-4">Valor <?= $veiculos["valor"] ?> </p>
          <p class="col-md-4">Plano: <?php 
          $plano = new \Source\Models\Read();
          $plano->ExeRead("app_planos_user", "WHERE id = :a", "a={$veiculos["plano_id"]}");
          if(!empty($plano->getResult()[0]["plano"])){
             echo $plano->getResult()[0]["plano"]; 
          }
         
           ?> </p>
          <p class="col-md-4"> 
          Mensal <?php 
            if(!empty($plano->getResult()[0]["valor"])){
        echo  $plano->getResult()[0]["valor"];
            }?>
          </p>
          </div>
          
          <div class="row"> 
              <h3 class="col-md-12 border-bottom text-center"><b>ITENS DO SERVIÇO</b></h3>
              <?php 
              $item = new \Source\Models\Read();
              $item->ExeRead("app_itens", "WHERE pedido_id = :b", 
                      "b={$_GET["pedido"]}");
                      $item->getResult();
                      if(!empty($item->getResult())){
                          $soma=0;
                      foreach ($item->getResult() as $itens) {
                          $total = $itens["qtd"] * $itens["valor_unit"];
                          $soma += $total;
              ?>
              
              <p class="col-md-3 border-bottom"><b>QTD:</b> </br> <?= $itens["qtd"] ?> </p>
              <p class="col-md-3 border-bottom"><b>Item:</b> </br> <?= $itens["descricao"] ?> </p>
              <p class="col-md-3 border-bottom"><b>Valor Unitário</b> </br>R$ <?= number_format($itens["valor_unit"]/100,2,",","."); ?> </p>
              <p class="col-md-3 border-bottom"><b>Total:</b></br>R$ <?= number_format($total/100,2,".",","); ?> </p>
            
              
                      <?php }}else{ ?>
              <p class="alert alert-warning"> Não existem itens cadastrados no pedido </p>
                      <?php } ?>  
                <p class="col-md-3 text-right"></p>
                <p class="col-md-3 text-right"> </p>
                <p class="col-md-3 text-right"> </p>
                <p class="col-md-3 text-left"><b>R$ <?= number_format($soma/100,2,",",".") ?></b> </p>
          </div>
          <?php }} ?>
            
            <h3 class="text-center border-bottom"> DETALHES E GARANTIAS </h3>
        
            <?php 

            
            $garantia = new Source\Models\Read();
            $garantia->ExeRead("app_detalhes_pedido", "WHERE pedido_id = :a", "a={$_GET["pedido"]}");
            $garantia->getResult();

          
            ?>
            
            <p class="text-center"><?php echo $garantia->getResult()[0]["detalhes"]; ?> </p>
            
            
               <h3 class="text-center border-bottom"> SERVIÇO REALIZADO EM </h3>

            
               <?PHP 
                    $eventos = new Source\Models\Read();
                    $eventos->ExeRead("eventos", "WHERE os = :a", "a={$_GET["pedido"]}");
            
               ?>
               
                              
               <div class="row"> 
               
                   <div class="col-md-6"> 
                       <label> Entrada Veículo </label>
                       <p><?= date("d/m/Y H:i:s" , strtotime($eventos->getResult()[0]["start"]))  ?></p>
                   </div>
                   <div class="col-md-6"> 
                       <label>Entrega Veículo </label>
                       <p><?= date("d/m/Y H:i:s" , strtotime($eventos->getResult()[0]["end"]))  ?></p>
                   </div>
               
               </div>
               
               <h3 class="text-center border-bottom"> Recibo </h3>
               
               <table class="table"> 
                   <thead> 
                       <tr> 
                           <th>Valor Serviço </th>
                           <th>Forma de Pagamento </th>
                       </tr>
                   </thead>
                   <tbody> 
                       <?php 
                       $recibo = new Source\Models\Read();
                       $recibo->ExeRead("app_recibo", "WHERE pedido_id = :a", "a={$_GET["pedido"]}");
                       $recibo->getResult();
                       ?>
                       <tr> 
                           <td>R$ <?= number_format($recibo->getResult()[0]["valor"]/100,2,",","."); ?> </td>
                           <td><?= $recibo->getResult()[0]["forma_pagamento"] ?> </td>
                       </tr>
                   </tbody>
               
               </table>
               
               </br> </br>
      
                              
               <table class="table"> 
                   <thead> 
                       <tr> 
                          
                           <th class="text-center"><?=CONF_SITE_NAME ?> </th>
                       </tr>
                   </thead>
                   <tbody> 
 
                       <tr> 
                          
                           <td class="border-bottom"></td>
                       </tr>
                   </tbody>
               
               </table>
               
               
               
               <form>
                   <input type="button" value="Imprimir" class="btn btn-light" onClick="window.print()"/>
</form>
        
               <script> 
               onClick="window.print()"
               </script>     
               
               
              
        
    </body>
</html>
