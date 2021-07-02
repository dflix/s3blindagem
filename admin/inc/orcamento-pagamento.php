<div class="container-fluid"> 

    <h1 class="header-ul"> ORÇAMENTO </h1>
    
      <?php 
//
//    $agenda = new \Source\Core\Agenda();
//    $agenda->cadastraOs();
    
   //   $_SESSION["orcamento_id"] = $_GET["editar"];
      
  // var_dump($_SESSION);
      
      $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
      
      if($filtro){
          $filtro["user_id"] = $_SESSION["user_id"];
          $filtro["orcamento_id"] = $_SESSION["orcamento"];
          unset($filtro["files"]);
          var_dump($filtro);
          
          //verifica se tem registro com mesmo orcamento_id para fazer update
          
          $verifica = new \Source\Models\Read();
          $verifica->ExeRead("app_orcamento_pagamento", "WHERE orcamento_id = :a", "a={$_SESSION["orcamento"]}");
          $verifica->getResult();
          if($verifica->getResult()){
              //faz update
              $update = new Source\Models\Update();
              $update->ExeUpdate("app_orcamento_pagamento", $filtro, "WHERE orcamento_id = :a AND user_id = :b", "a={$_SESSION["orcamento"]}&b={$_SESSION["user_id"]}");
              $update->getResult();
              if($update->getResult()){
                 echo "<div class='alert alert-success'> Atualizado com Sucesso </div>"; 
                  echo "<meta http-equiv=\"refresh\" content=2;url=\"painel&p=orcamento\">";
              }else{
                echo "<div class='alert alert-danger'> Erro ao atualizar </div>";   
              }
          }else{
              //faz cadastro
              $cad = new \Source\Models\Create();
              $cad->ExeCreate("app_orcamento_pagamento", $filtro);
              $cad->getResult();
              if($cad->getResult()){
                  echo "<div class='alert alert-success'>Cadastrado com Sucesso Orçamento Finalizado </div>";
                  echo "<meta http-equiv=\"refresh\" content=2;url=\"./?p=orcamento\">";
              }else{
                 echo "<div class='alert alert-danger'>Erro ao cadastrar </div>"; 
              }
          }
      }
    
    $os = new Source\Models\Read();
    $os->ExeRead("app_orcamento", "WHERE orcamento_id = :a", "a={$_SESSION["orcamento"]}");
    $os->getResult();
    ?>
    
    <div class="row"> 
        <div class="col-md-4"> <label>Ordem de Serviço </label> </br> <?= $os->getResult()[0]["orcamento_id"] ?> </div>
        <div class="col-md-4"> <label>Veiculo </label> </br><?= $os->getResult()[0]["tipo"] ?> </div>
        <div class="col-md-4"> <label>Marca </label> </br><?= $os->getResult()[0]["marca"] ?> </div>
        <div class="col-md-4"> <label>Modelo </label> </br> <?= $os->getResult()[0]["modelo"] ?> </div>
        <div class="col-md-4"> <label>Ano </label> </br><?= $os->getResult()[0]["ano"] ?> </div>
        <div class="col-md-4"> <label>Placa </label> </br><?= $os->getResult()[0]["placa"] ?> </div>
        <div class="col-md-4"> <label>Cliente </label> </br><?= $os->getResult()[0]["cliente"] ?> </div>
        <div class="col-md-4"> <label>Telefone </label> </br><?= $os->getResult()[0]["telefone"] ?> </div>
<!--        <div class="col-md-4"> <label>KM </label> </br><?= $os->getResult()[0]["kilometragem"] ?> </div>-->
    

            

        
        
        <div class="col-md-12"> 
            <h3> Itens do Orçamento </h3>
            
            <table class="table"> 
                <thead> 
                    <tr> 
                        <th>Item </th>
                        <th>QTD </th>
                        <th>Preço Unit </th>
                        <th>Preço Total </th>
                        <th>Remover </th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    $total = 0;
                    $ver = new Source\Models\Read();
                    $ver->ExeRead("app_orcamento_itens", "WHERE user_id = :a AND orcamento_id = :b", "a={$_SESSION["user_id"]}&b={$_SESSION["orcamento"]}");
                    $ver->getResult();
                    if(empty( $ver->getResult())){
                      echo "<tr><td>Não existe produtos ou serviços cadastrados nessa OS</td></tr>";  
                    }else{
                        $total = 0;
                    foreach ($ver->getResult() as $vos) {
                        $total += $vos["valor_total"];
                    ?>
                    <tr> 
                        <td><?= $vos["item"] ?> </td>
                        <td><?= $vos["qtd"] ?> </td>
                        <td>R$ <?=  number_format($vos["valor_unit"] / 100 , 2, ",","."); ?> </td>
                        <td>R$ <?=  number_format($vos["valor_total"] / 100 , 2, ",","."); ?> </td>
                        <td> <a href="./?p=servicos-itens&deletar=<?= $vos["id"] ?>" style="text-decoration: none; color:red;"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php } }?>
                    
                                        <tr> 
                        <td> </td>
                        <td> </td>
                        <td>Total Compra </td>
                        <td>R$ <?=  number_format($total / 100 , 2, ",","."); ?> </td>
                        <td> </td>
                    </tr>
                  
                </tbody>
            
            </table>
        
        </div>
    
    
    </div>
    
    
    <div class="col-md-12"> 
        <h3> Forma de Pagamento </h3>

        <form action="" method="post">  
            <div class="form-group"> 
                <label> Descrição da Forma de Pagamento</label>
                <textarea name="forma_pagamento" id="summernote"> </textarea>
                <input type="submit" class="btn btn-success" value="Finalizar Orçamento" />
            </div>
        
        </form>
        
    
  

</div>


        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

        <script type="text/javascript">

                    $(function () {
                        $("#pesquisa").keyup(function () {
                            //Recuperar o valor do campo
                            var pesquisa = $(this).val();

                            //Verificar se há algo digitado
                            if (pesquisa != '') {
                                var dados = {
                                    palavra: pesquisa
                                }
                                $.post("<?= CONF_URL_BASE ?>/assets/functions/os.php", dados, function (retorna) {
                                    //Mostra dentro da ul os resultado obtidos 
                                    $(".resultado").html(retorna);
                                });
                            }
                        });
                    });

        </script>

