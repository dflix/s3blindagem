

<div class="container-fluid"> 

    <h3 class="border-bottom"> Orçamentos </h3>

    <div class="row"> 

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="./?p=orcamento"> <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Criar Orçamentos</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="./?p=view_orcamento"> <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Ver Orçamentos</div> </a>
        </div>



        <div class="col-md-6"> 
            <div class="row">
                <?php
                if (empty($_SESSION["orcamento"])) {
                    ?>
                    <form method="post" name="form"> 

                        <div class="col-md-12">
                            <label>Cliente </label>
                            <input type="text" name="cliente" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label>Telefone </label>
                            <input type="text" name="telefone" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label>Email </label>
                            <input type="text" name="email" class="form-control" />
                        </div>

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



                        <div class="form-group col-md-6">
                            <label>
                                PLACA:</label>
                            <input type="text"  name="placa" id="placa" class="form-control" /> 

                        </div>

                        <div class="form-group col-md-6">
                            <label>
                                COR:</label>
                            <input type="text"  name="cor" id="cor" class="form-control" /> 

                        </div>

                    </form>

                <?php } ?>
            </div>
        </div>



        <div class="col-md-6"> 

            <h3>Itens do Orçamento </h3>
            <?php
            if (empty($_SESSION["orcamento"])) {
                echo "Orçamento vazio";
            }
            ?>

        </div>



    </div>

</div>


<script>

    $(function () {

        $('select[name=veiculo]').change(function () {
            $.post("./marca.php",
                    {veiculo: $(this).val()},
                    function (veiculo) {

                        $('select[name=marca1]').html(veiculo)

                    })
        });

        $('select[name=marca1]').change(function () {
            $.post("./modelo.php",
                    {marca: $(this).val()},
                    function (marca) {

                        $('select[name=modelo1]').html(marca)

                    })
        });

        $('select[name=modelo1]').change(function () {
            $.post("./ano.php",
                    {modelo: $(this).val()},
                    function (modelo) {

                        $('select[name=ano1]').html(modelo)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("./ano.php",
                    {modelo: $(this).val()},
                    function (modelo) {

                        $('select[name=fipe]').html(modelo)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("./codigofipe.php",
                    {fipe: $(this).val()},
                    function (fipe) {

                        $('select[name=fipe]').html(fipe)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("./preco.php",
                    {valor: $(this).val()},
                    function (valor) {

                        $('select[name=valor]').html(valor)

                    })
        });


    });


</script>