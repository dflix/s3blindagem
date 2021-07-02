

<?php
$pedido = new \Source\Core\Pedidos();
$pedido->itens();

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
        <div class="col-md-3"><b> Itens Pedido Nº </b> <?= $_SESSION["pedido_id"] ?> </div>

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
    <table class="table"> 
    
        <thead> 
            <tr> 
                <th>Qtd </th>
                <th>Produtos ou Serviços</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
                <th>Deletar</th>
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
            $soma = 0;
            foreach ($read->getResult() as $item):
                 $total = $item["qtd"] * $item["valor_unit"];
                $soma += $total;
            ?>
            <tr> 
                <td><?= $item["qtd"] ?> </td>
                <td><?= $item["descricao"] ?> </td>
                <td><?= $item["valor_unit"] ?> </td>
                <td><?php 
               
                echo number_format($total / 100 , 2 ,"." , ",");
                ?> </td>
                
                <td> <a href="?p=pedido_itens&deletar=<?= $item["id"] ?>&tipo=<?= $item["tipo"] ?>"><i class="fas fa-trash-alt"></i></a></td>
               
            </tr>
            <?php endforeach; ?>
            <tr> 
                <td> </td>
                <td> </td>
                <td>TOTAL DO SERVIÇO </td>
                <td>R$ <?= number_format($soma/100,2,".",","); ?> </td>
                <td> </td>
            </tr>
           
        </tbody>
    
    </table>
</div>


     <h1> Itens do Pedido </h1>
    <div class="row col-md-12"> 
    
       
        
        <form action="" method="post" class="form" > 
            <div class="col-md-2"> 
                <label>Qtd </label>
                <input type="text" name="qtd" class="form-control" />
            </div>
            <div class="col-md-7"> 
                <label>Produtos ou Serviços </label>
                <input type="text" name="descricao" placeholder="Descrição Produto ou Serviço" class="form-control" />
            </div>
            <div class="col-md-3"> 
                <label>Valor Unitário </label>
                <input type="text" name="valor_unit" id="valor"  class="form-control" />
            </div>
            <div class="col-md-12">
                <input type="hidden" name="tipo" value="servico" class="btn btn-success" />
                <input type="submit" value="cadastrar" class="btn btn-success" />
                </br> </br>
            </div>
        </form>
    
    
    </div>

     <p> Itens de Estoque </p>

      <form method="post" id="form-pesquisa" action=""> 
                <label>Pesquisa Produto </label>
                <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Digite o produto" />
            </form>
            <div class="resultado"> </div>
            
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
                                $.post("<?= CONF_URL_BASE ?>/processa.php", dados, function (retorna) {
                                    //Mostra dentro da ul os resultado obtidos 
                                    $(".resultado").html(retorna);
                                });
                            }
                        });
                    });

        </script>



<hr>
<form action="" method="post"> 
    <input type="hidden" name="pular"  value="pular" />
    <input type="submit" name="submit" class="btn btn-info" value="PULAR ETAPA" />
</form>

</div>




