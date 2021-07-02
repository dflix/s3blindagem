

<?php
//var_dump($_SESSION);
$pedido = new \Source\Core\Pedidos();
$pedido->veiculos();
?>

<div class="container-fluid"> 
  
<!--    <div class="alert alert-success"> Pedido Iniciado com Sucesso</div>-->
    <div class="row"> 
        <div class="col-md-3"><b> Pedido Nº </b> <?=$_SESSION["pedido_id"] ?> </div>
        
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
            if($cliente->getResult()[0]["tipo"] == "1"){
                echo "Fisica";
            }
            if($cliente->getResult()[0]["tipo"] == "2"){
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
    if($veiculos->getResult()){
        foreach ($veiculos->getResult() as $viewcar) {
    ?>
    
<div class="row border-bottom col-md-12"> 
    <div class="col-md-1"> 
        <label> Tipo</label></br>
            <?=$viewcar["tipo"] ?> </div>
    <div class="col-md-2"> 
            <label> Marca</label></br>
            <?=$viewcar["marca"] ?> </div>
    <div class="col-md-3"> 
             <label> Modelo</label></br>
            <?=$viewcar["modelo"] ?> </div>
    <div class="col-md-2"> 
             <label> Ano</label></br>
            <?=$viewcar["ano"] ?> </div>
    <div class="col-md-2"> 
             <label> Fipe</label></br>
            <?=$viewcar["fipe"] ?> </div>
    <div class="col-md-2">
         <label> Valor</label></br>
 <?=$viewcar["valor"] ?> </div>
</div>
    
        <?php } }else{ ?>
    
    <div class="alert alert-warning"> Não existe veiculos cadastrado para esse pedido</div>
    <?php } ?>

</div>


    <h3 class="border-bottom text-white" style="width: 100%;"> Setor Automotivo selecione o veículo</h3>


    <script>



        $(function () {

        $('select[name=veiculo]').change(function(){
        $.post("./marca.php",
                    {veiculo: $(this).val()},
            function(veiculo) {
                
                $('select[name=marca1]').html(veiculo)

            })
    });

        $('select[name=marca1]').change(function(){
        $.post("./modelo.php",
                    {marca: $(this).val()},
            function(marca) {
                
                $('select[name=modelo1]').html(marca)

            })
    });
    
        $('select[name=modelo1]').change(function(){
        $.post("./ano.php",
                    {modelo: $(this).val()},
            function(modelo) {
                
                $('select[name=ano1]').html(modelo)

            })
    });
    
        $('select[name=ano1]').change(function(){
        $.post("./ano.php",
                    {modelo: $(this).val()},
            function(modelo) {
                
                $('select[name=fipe]').html(modelo)

            })
    });
    
        $('select[name=ano1]').change(function(){
        $.post("./codigofipe.php",
                    {fipe: $(this).val()},
            function(fipe) {
                
                $('select[name=fipe]').html(fipe)

            })
    });
    
        $('select[name=ano1]').change(function(){
        $.post("./preco.php",
                    {valor: $(this).val()},
            function(valor) {
                
                $('select[name=valor]').html(valor)

            })
    });
    

    
    
    
    });       

     
        
        
     
    </script>

    <form method="post" action="">
    <div class="row">
        <div class="form-group col-md-4">
            <label >VEICULO: </label>
            <select name="veiculo" id="veiculo"  class="form-control"> 
                <option value="#"> Selecione o veiculo</option>
                <option value="motos"> Motos</option>
                <option value="carros"> Carros</option>
                <option value="caminhoes"> Caminhão</option>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label >MARCA: </label>

            <select name="marca1" id="marca1"  class="form-control"> </select>
        </div>

        <div class="form-group col-md-4">
            <label>MODELO </label>
            <select name="modelo1" id="modelo1" class="form-control"> </select>
            </label>
        </div>

        <div class="form-group col-md-4">
            <label>ANO:</label>
            <select name="ano1"  id="ano1" class="form-control"  > </select>

        </div>

        <div class="form-group col-md-4">
            <label>
                CODIGO FIPE:</label>
            <select  name="fipe" id="fipe" class="form-control" > </select>

        </div>

        <div class="form-group col-md-4">
            <label>
                VALOR:</label>
            <select  name="valor" id="valor" class="form-control"> </select>

        </div>

        <div class="form-group col-md-3">
            <label>
                CHASSI:</label>
            <input type="text"  name="chassi" id="chassi" class="form-control" /> 

        </div>

        <div class="form-group col-md-3">
            <label>
                RENAVAM:</label>
            <input type="text"  name="renavam" id="renavam" class="form-control" /> 

        </div>

        <div class="form-group col-md-3">
            <label>
                PLACA:</label>
            <input type="text"  name="placa" id="placa" class="form-control" /> 

        </div>

        <div class="form-group col-md-3">
            <label>
                COR:</label>
            <input type="text"  name="cor" id="cor" class="form-control" /> 

        </div>

        <div class="form-group col-md-6">
            <label>
               Pular essa etapa:</label>
            <input type="radio" name="pular" value="sim" /> Sim
            <input type="radio" name="pular" value="não" /> Não
            <input type="hidden" name="cliente_id" value="<?= $_SESSION["cliente_id"] ?>" />

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
  
   

 
