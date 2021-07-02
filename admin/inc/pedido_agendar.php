

<?php
$pedido = new \Source\Core\Pedidos();
$pedido->agendar();

//var_dump($_SESSION);
?>

 <script type="text/javascript">
    $(function(){
        $("#valor").maskMoney();
    })
    $(function(){
        $("#valor2").maskMoney();
    })
    </script>

<div class="container-fluid"> 

    <!--    <div class="alert alert-success"> Pedido Iniciado com Sucesso</div>-->
    <div class="row"> 
        <div class="col-md-3"><b>  Pedido Nº </b> <?= $_SESSION["pedido_id"] ?> </div>

        <div class="col-md-3">
            <b> Cliente </b><?php
            $cliente = new \Source\Models\Read();
            $cliente->ExeRead("app_clientes", "WHERE cliente_id = :a", "a={$_SESSION["cliente_id"]}");
            $cliente->getResult();

            echo $cliente->getResult()[0]["nome"];
            ?> </div>

        <div class="col-md-3"> 
            <p> <b>Pessoa </b>
                <?php
                if ($cliente->getResult()[0]["tipo"] == "1") {
                    echo "Fisica";
                }
                if ($cliente->getResult()[0]["tipo"] == "2") {
                    echo "Juridica";
                }
                ?>
            </p>
        </div>

        <div class="col-md-3"><b> Documento:</b> <?= $cliente->getResult()[0]["cpf"] ?> <?= $cliente->getResult()[0]["cnpj"] ?></div>
    </div>

</div>

<?php
$veiculos = new \Source\Models\Read();
$veiculos->ExeRead("app_veiculos", "WHERE user_id = :a AND cliente_id = :b",
        "a={$_SESSION["user_id"]}&b={$_SESSION["cliente_id"]}");
$veiculos->getResult();

$json = $veiculos->getResult();
json_encode($json);
if ($json) {
    foreach ($json as $viewcar) {
        ?>

        <div class="row border-bottom col-md-12"> 
            <div class="col-md-1"> 
                <label> Tipo</label></br>
                <?= $viewcar["tipo"] ?> </div>
            <div class="col-md-1"> 
                <label> Marca</label></br>
                <?= $viewcar["marca"] ?> </div>
            <div class="col-md-3"> 
                <label> Modelo</label></br>
                <?= $viewcar["modelo"] ?> </div>
            <div class="col-md-1"> 
                <label> Ano</label></br>
                <?= $viewcar["ano"] ?> </div>
            <div class="col-md-1"> 
                <label> Fipe</label></br>
                <?= $viewcar["fipe"] ?> </div>
            <div class="col-md-1">
                <label> Valor</label></br>
                <?= $viewcar["valor"] ?> </div>
            <div class="col-md-2">
                <label> Plano</label></br>
                <?= $viewcar["plano_id"] ?> 
                <div class="altera"> </div>
            </div>
            <div class="col-md-2">
                <label> Selecionar Plano</label></br>
                
                        <select name="planosItem" id="veiculo"  class="form-control"> 
                <option value="#"> Selecione um plano</option>
                <?php
                $read = new \Source\Models\Read();
                $read->ExeRead("app_planos_user", "WHERE user_id = :id ", "id={$_SESSION["user_id"]}");
                $read->getResult();
                foreach ($read->getResult() as $planos) {
                    ?>
                    <option value="<?= $viewcar["id"] ?>|<?= $planos['id'] ?>"> <?= $planos['plano'] ?> |  <?= $planos['valor'] ?></option>

                <?php } ?>

            </select>
            
            
            
            
            </div>
        </div>

    <?php }
} else { ?>

    <div class="alert alert-warning"> Não existe veiculos cadastrado para esse pedido</div>
<?php } ?>




<script>

    $(function () {

        $('select[name=planos]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/themes/app/planos.php",
                    {veiculo: $(this).val()},
                    function (veiculo) {
                        $(".resposta").html(veiculo)
                    })
        });

        $('select[name=planosItem]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/themes/app/planosItem.php",
                    {planos: $(this).val()},
                    function (planos) {
                        $(".altera").html(planos)
                    })
        });



    });

</script>

<div class="container-fluid">
    <div class="col-md-12">  <h3> Itens do Pedido</h3></div>
    <table class="table table-responsive"> 
    
        <thead> 
            <tr> 
                <th>Qtd </th>
                <th>Produtos ou Serviços</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        
        <tbody> 
            <?php 
            $read = new \Source\Models\Read();
            $read->ExeRead("app_itens", "WHERE user_id = :a AND pedido_id = :b", 
                    "a={$_SESSION["user_id"]}&b={$_SESSION["pedido_id"]}");
            $read->getResult();
            if(empty($read->getResult())):
            ?>
            
        <div class="alert alert-warning">Não existem itens cadastrados para o pedido </div> 
        <?php endif; ?>
            
            
            
            
            <?php
            foreach ($read->getResult() as $item):
            ?>
            <tr> 
                <td><?= $item["qtd"] ?> </td>
                <td><?= $item["descricao"] ?> </td>
                <td><?= $item["valor_unit"] ?> </td>
                <td><?php 
                $total = $item["qtd"] * $item["valor_unit"];
                echo number_format($total / 100 , 2 ,"." , ",");
                ?> </td>
               
            </tr>
            <?php endforeach; ?>
           
        </tbody>
    
    </table>
</div>

<div class="col-md-12">Detalhes e Garantias </div>

<?php 
$read = new \Source\Models\Read();
$read->ExeRead("app_detalhes_pedido", "WHERE user_id = :a AND pedido_id = :b", 
        "a={$_SESSION["user_id"]}&b={$_SESSION["pedido_id"]}");
$read->getResult();
if($read->getResult()){
    echo $read->getResult()[0]["detalhes"];
}else{
    null;
}
?>


     <h1> Agendar Pedido </h1>
    <div class="row col-md-12"> 
    
       
        
     <form action="" method="post" >
      <div class="modal-body">
          <div class="row">
              
          <div class="col-md-12"> 
              <label>Titulo </label>
              <input type="text" class="form-control" name="title" value="Serviço <?= $viewcar["modelo"] ?> " />
                    
          </div>
              
          <div class="col-md-6"> 
              <label> Data Inicio </label>
             
              <input type="date" id="date" class="form-control"  name="start_dia" />
              
          </div>
              
          <div class="col-md-3"> 
              <label>Horas </label>
              <select class="form-control" name="start_horas">
                  <?php for($i=0 ; $i <= 24; $i++){ ?>
                  <option value="<?= $i ?> "> <?= $i ?> </option>
                  <?php } ?>
              </select>
          </div>
              
          <div class="col-md-3"> 
              <label>Minutos</label>
              <select class="form-control" name="start_minutos">
                  
                  <option value="00"> 00 </option>
                  <option value="15"> 15 </option>
                  <option value="30"> 30 </option>
                  <option value="45"> 45 </option>
                  
              </select>
          </div>
              
          <div class="col-md-6"> 
              <label> Data Fim </label>
             
              <input type="date" id="date" class="form-control"  name="end_dia" />
              
          </div>
              
          <div class="col-md-3"> 
              <label>Horas </label>
              <select class="form-control" name="end_horas">
                  <?php for($i=0 ; $i <= 24; $i++){ ?>
                  <option value="<?= $i ?>"> <?= $i ?> </option>
                  <?php } ?>
              </select>
          </div>
              
          <div class="col-md-3"> 
              <label>Minutos</label>
              <select class="form-control" name="end_minutos">
                  
                  <option value="00"> 00 </option>
                  <option value="15"> 15 </option>
                  <option value="30"> 30 </option>
                  <option value="45"> 45 </option>
                  
              </select>
          </div>
              
          <div class="col-md-6"> 
              <label>Cor </label>
              <select name="color" class="form-control"> 
                  <option value="#6A5ACD" style="background: #6A5ACD;">  AZUL  </option>
                  <option value="#00FFFF" style="background: #00FFFF;">  ACQUA  </option>
                  <option value="#FFFF00" style="background: #FFFF00;">  AMARELO </option>
                  <option value="#F5F5DC" style="background: #F5F5DC;">  BEGE </option>
                  <option value="#FFA500" style="background: #FFA500;">  LARANJA </option>
                  <option value="#00FF00" style="background: #00FF00;">  VERDE </option>
                  
                  <option value="##40E0D0" style="background: #40E0D0;">  TURQUESA </option>
                  <option value="#DAA520" style="background: #DAA520;">  GOLDEN </option>
                  <option value="#FF6347" style="background: #FF6347;">  VERMELHO </option>
              </select>
          </div>
              
              
              
          <div class="col-md-6"> 
              <label>. </label></BR>
              <input type="submit" class="btn btn-success" name="cadastra" value="CADASTRAR" />
          </div>
              
              
          </div>
      </div>
            </form>
    
    </div>





<hr>
<form action="" method="post"> 
    <input type="hidden" name="pular"  value="pular" />
    <input type="submit" name="submit" class="btn btn-info" value="PULAR ETAPA" />
</form>

</div>




