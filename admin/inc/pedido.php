
<h2> Pedido </h2>

<?php 

$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

     $verifica = new \Source\Models\Read();
        $verifica->ExeRead("app_pedidos", "ORDER BY id DESC " );
        $verifica->getResult();


            if ($verifica->getResult()) {
                $id = $verifica->getResult()[0]["pedido_id"];
            } else {
                $id = 0;
            }

            $_SESSION["pedido_id"] = $id + 1;
            $_SESSION["totalPedido"] = 0;
            
            $_SESSION["cliente_id"] = $filtro["cliente_id"];

            $cad = [
                "user_id" => intval($_SESSION["user_id"]),
                "cliente_id" => $filtro["cliente_id"],
                "pedido_id" => intval($_SESSION["pedido_id"]),

                "valor" => $_SESSION["totalPedido"],
                "status" => intval("1"),
                "data" => date("Y-m-d H:i:s")
            ];
            
            
                        $cadastra = new \Source\Models\Create();
            $cadastra->ExeCreate("app_pedidos", $cad);
            $cadastra->getResult();


            if ($cadastra->getResult()) {
                echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5>Pedido Iniciado</h5>  </div>";
                $_SESSION["etapa"] = "1";
                //$this->veiculos();
                echo "<meta http-equiv=\"refresh\" content=\"2; URL='./?p=pedido_veiculos'\"/>";
              //header("location:./pedido/veiculos");
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
               <h5>Erro ao iniciar pedido</h5>  </div>";
                var_dump($_SESSION, $this->filtro);
            }
            
           // var_dump( $cad);

    
//     $verifica = new \Source\Models\Read();
//        $verifica->ExeRead("app_pedidos", "ORDER BY id DESC " );
//        $verifica->getResult();
//
//
//            if ($verifica->getResult()) {
//                $id = $verifica->getResult()[0]["pedido_id"];
//            } else {
//                $id = 0;
//            }
//
//            $_SESSION["pedido_id"] = $id + 1;
//            $_SESSION["cliente_id"] = $this->filtro["cliente_id"];
//            $_SESSION["totalPedido"] = 0;
//            
////            $frete = str_replace(".", "", $_SESSION["frete"]);
////            $frete = str_replace(",", "", $_SESSION["frete"]);
//
//            $cad = [
//                "user_id" => intval($_SESSION["user_id"]),
//                "cliente_id" => intval($_SESSION["cliente_id"]),
//                "pedido_id" => intval($_SESSION["pedido_id"]),
////                "frete" => $_SESSION["freteTipo"],
////                "frete_valor" => $frete,
//                "valor" => $_SESSION["totalPedido"],
//                "status" => intval("1"),
//                "data" => date("Y-m-d H:i:s")
//            ];
//
//            $cadastra = new \Source\Models\Create();
//            $cadastra->ExeCreate("app_pedidos", $cad);
//            $cadastra->getResult();
//
//
//            if ($cadastra->getResult()) {
//                echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
//               <h5>Pedido Iniciado</h5>  </div>";
//                $_SESSION["etapa"] = "1";
//                //$this->veiculos();
//                echo "<meta http-equiv=\"refresh\" content=\"2; URL='./?p=pedido_veiculos'\"/>";
//              //header("location:./pedido/veiculos");
//            } else {
//                echo "<div class=\"alert alert-danger\" role=\"alert\">
//               <h5>Erro ao iniciar pedido</h5>  </div>";
//                var_dump($_SESSION, $this->filtro);
//            }
    
    
    ?>

