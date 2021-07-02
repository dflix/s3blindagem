

<?php
$pedido = new \Source\Core\Pedidos();
$pedido->planos();

//var_dump($_SESSION);
?>

<div class="container-fluid"> 

    <!--    <div class="alert alert-success"> Pedido Iniciado com Sucesso</div>-->
    <div class="row"> 
        <div class="col-md-3"><b> Pedido Nº </b> <?= $_SESSION["pedido_id"] ?> </div>

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




<h3 class="border-bottom col-md-12" > Selecione Um Plano Único para o pedido </h3>


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

<div class="resposta col-md-12"> </div>

<form method="post" action="">
    <div class="row">
        <div class="form-group col-md-12">
            <label >Selecione o Plano: </label>
            <select name="planos" id="veiculo"  class="form-control"> 
                <option value="#"> Selecione um plano</option>
                <?php
                $read = new \Source\Models\Read();
                $read->ExeRead("app_planos_user", "WHERE user_id = :id ", "id={$_SESSION["user_id"]}");
                $read->getResult();
                foreach ($read->getResult() as $planos) {
                    ?>
                    <option value="<?= $planos["id"] ?>"> <?= $planos['plano'] ?> |  <?= $planos['valor'] ?></option>

                <?php } ?>

            </select>
        </div>


        <div class="form-group col-md-6">
            <label>.</label>
            <input type="submit" name="submit" value="CADASTRAR" class="btn btn-success" />


        </div>

</form>

<hr>
<form action="" method="post"> 
    <input type="hidden" name="pular"  value="pular" />
    <input type="submit" name="submit" class="btn btn-info" value="PULAR ETAPA" />
</form>

</div>




