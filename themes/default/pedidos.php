

<header class="container backwhite"> 

    <h1>Meus Pedidos </h1>
    
    <?php var_dump($_SESSION) ?>
    
    <table class="table"> 
        <thead> 
            <tr> 
                <th>Data </th>
                <th>Pedido </th>
                <th>Itens </th>
                <th>Valor </th>
                <th>Pagamento </th>
                <th>Status </th>
            </tr>
        </thead>
        
        <tbody> 
            <?php 
            $pedidos = new Source\Models\Read();
            $pedidos->ExeRead("app_pedidos", "WHERE cliente_id = :a" , "a={$_SESSION["user_id"]}");
            $pedidos->getResult();
            foreach ($pedidos->getResult() as $value) {

            ?>
        <tr> 
            <td><?= date("d/m/Y H:i:s" , strtotime($value["data"])) ?> </td>
                <td>#<?=$value["pedido_id"] ?> </td>
                <td>
                <!-- Aqui itens dos peddo -->
                
                <?php 
                $item = new Source\Models\Read();
                $item->ExeRead("app_pedidos_itens", "WHERE pedido_id = :a", "a={$value["pedido_id"]}");
                $item->getResult();
                foreach ($item->getResult() as $valueItem) {
                    $nome = new Source\Models\Read();
                    $nome->ExeRead("app_prod", "WHERE id = :a", "a={$item->getResult()[0]["produto_id"]}");
                    $nome->getResult();
                    
                    echo "<p>{$nome->getResult()[0]["produto"]} </p>";
                    
                }
                ?>
                
                <!-- Aqui itens dos peddo -->
                </td>
                <td>R$ <?php 
                 $total = $value["frete_valor"] + $value["valor"];
                 
                 echo number_format($total / 100, 2, ",", ".");
                ?> </td>
                <td><?=$value["metodo_pagamento"] ?> </td>
                <td><?php
                if($value["status"] == "1"){
                    echo "<span class='alert alert-info'>Aguardando Pagamento</span>";
                }
                if($value["status"] == "2"){
                    echo "<span class='alert alert-success'>Pago</span>";
                }
                if($value["status"] == "3"){
                    echo "<span class='alert alert-success'>Pagamento Recusado</span>";
                }
                 ?> </td>
            </tr>
            <?php } ?>
       
        </tbody>
    
    </table>
    
    
    
      </header>
