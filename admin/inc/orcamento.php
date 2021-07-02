<div class="container-fluid"> 
    <h3 class="text-white">Orçamentos </h3>
    <?php


    
    $orcamento = new \Source\Core\Orcamento();
    $orcamento->cadastra();


    unset($_SESSION['carrinho']);
    unset($_SESSION['os']);
   // unset($_SESSION['loja']);
    unset($_SESSION['totalpedido']);
    unset($_SESSION['busca']);

    // var_dump($_SESSION);
    ?>


    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalreceita">
        (+) Novo Orçamento
    </button>


    <!-- Modal -->
    <div class="modal fade" id="modalreceita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-flag" aria-hidden="true" style="color:green;"></i> Cadastrar Orçamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" method="post">
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
                                <select name="marca1" id="marca1"  class="form-control"> 
                                </select>

                            </div>

                            <div class="form-group col-md-4">
                                <label>MODELO </label>
                                <select name="modelo1" id="modelo1" class="form-control"> 

                                </select>
                                </label>
                            </div>

                            <div class="form-group col-md-3">
                                <label>ANO:</label>
                                <select name="ano1"  id="ano1" class="form-control"  > 

                                </select>

                            </div>


                            <div class="form-group col-md-3">
                                <label>
                                    VALOR:</label>
                                <select  name="valor" id="valor" class="form-control"> 

                                </select>

                            </div>

                            <div class="form-group col-md-3">
                                <label>Cor</label>
                                <input type="text" name="cor" class="form-control" />

                            </div>

                            <div class="form-group col-md-3">
                                <label>Placa</label>
                                <input type="text" name="placa" class="form-control" />

                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    Cliente:</label>
                                <input type="text" name="cliente" class="form-control" />

                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    Telefone:</label>
                                <input type="text" name="telefone" placeholder="(DDD)XXXXX-XXXX" class="form-control" />

                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    Kilometragem:</label>
                                <input type="text" name="kilometragem" placeholder="kilometragem do veiculo" class="form-control" />

                            </div>

                            <div class="form-group col-md-12">
                                <label>
                                    Loja:</label>
                                <select name="loja" class="form-control">
                                    <?php
                                    $loja = new Source\Models\Read();
                                    $loja->ExeRead("app_carterias", "WHERE user_id = :a", "a={$_SESSION["user_id"]}");
                                    $loja->getResult();
                                    foreach ($loja->getResult() as $vLoja) {
                                        ?>
                                        <option value="<?= $vLoja["wallet"] ?>"> <?= $vLoja["wallet"] ?> </option>

                                    <?php } ?>
                                </select>

                            </div>



                            <div class="form-group col-md-12"> 
                          <?php              //verifica o numero da OS
        $vos = new \Source\Models\Read();
        $vos->ExeRead("app_orcamento", "WHERE user_id = :a ORDER BY orcamento_id DESC", "a={$_SESSION["user_id"]}");
        $vos->getResult();
        if($vos->getResult()){
            
            $os = $vos->getResult()[0]["orcamento_id"] + 1;

            
            $_SESSION["os"] = $os ;
        }else{
            $os = 1;
       
           $_SESSION["os"] = $os;
        } ?>
                                <input type="hidden" name="os" value="<?=$os ?>" />
                                <input type="submit" class="btn btn-success" name="acao" value="CADASTRAR" />
                            </div>
                        </div>
                    </form>  



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">(x)Fechar</button>

                </div>
            </div>
        </div>
    </div>
</div>

</br> </br>

<div class="col-md-12"> 


              <form method="post" id="form-pesquisa" action=""> 
            <label>Pesquisa </label>
            <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Busque por placa ou numero de OS" />
        </form>

        <div class="resultado">  </div>


        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

        <script type="text/javascript">

            $(function () {
                $("#pesquisa").keyup(function () {
                    //Recuperar o valor do campo
                    var pesquisa = $(this).val();

                    $(".blog").hide();
                    //Verificar se há algo digitado
                    if (pesquisa != '') {
                        var dados = {
                            palavra: pesquisa
                        }
                        $.post("<?= CONF_URL_BASE ?>/assets/functions/orcamento.php", dados, function (retorna) {
                            //Mostra dentro da ul os resultado obtidos 
                            $(".resultado").html(retorna);
                        });
                    }
                });
            });

        </script>
</div>

<table class="table blog"> 
    <thead> 
        <tr> 
            <th> Data </th>
            <th> Orçamento Nº </th>
            <th> Placa </th>
            <th> Veiculo </th>
            <th> Cor </th>
           
            <th> Serviço </th>
            <th> Impressos </th>
            <th> Enviar </th>
            <th> Status </th>
            <th> Editar </th>

        </tr>
    </thead>
    <tbody>
        <?php
        $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
        $pager = new Source\Support\Pager("painel&p=servicos&atual=", "Primeiro", "Ultimo", "1");
        $pager->ExePager($atual, 10);

        $ler = new Source\Models\Read();
        $ler->ExeRead("app_orcamento", "WHERE user_id = :a ORDER BY orcamento_id DESC LIMIT :limit OFFSET :offset", "a={$_SESSION["user_id"]}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
        $ler->getResult();
        foreach ($ler->getResult() as $vler) {
            ?>
            <tr> 
                <td style="font-size: 0.8em;"> <?= date("d/m/Y H:i:s", strtotime($vler["data"])); ?> </td>
                <td> <b><?= str_pad($vler["orcamento_id"], 7, "0", STR_PAD_LEFT) ?></b> </td>
                <td> <?= $vler["placa"] ?> </td>
                <td> <?= $vler["modelo"] ?> </td>
                <td> <?= $vler["cor"] ?> </td>
                
                <td>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalreceita<?= $vler["orcamento_id"] ?>">
                        Serviços
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="modalreceita<?= $vler["orcamento_id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-flag" aria-hidden="true" style="color:green;"></i> Serviços</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <table class="table"> 
                                        <thead> 
                                            <tr> 
                                                <th>Item </th>
                                                <th>QTD </th>
                                                <th>Preço Unit </th>
                                                <th>Preço Total </th>

                                            </tr>
                                        </thead>
                                        <tbody> 
    <?php
    $total = 0;
    $ver = new Source\Models\Read();
    $ver->ExeRead("app_orcamento_itens", "WHERE user_id = :a AND orcamento_id = :b", "a={$_SESSION["user_id"]}&b={$vler["orcamento_id"]}");
    $ver->getResult();
    if (empty($ver->getResult())) {
        echo "<tr><td>Não existe produtos ou serviços cadastrados nessa Orçamento</td></tr>";
    } else {
        $total = 0;
        foreach ($ver->getResult() as $vos) {
            $total += $vos["valor_total"];
            ?>
                                                    <tr> 
                                                        <td><?= $vos["item"] ?> </td>
                                                        <td><?= $vos["qtd"] ?> </td>
                                                        <td>R$ <?= number_format($vos["valor_unit"] / 100, 2, ",", "."); ?> </td>
                                                        <td>R$ <?= number_format($vos["valor_total"] / 100, 2, ",", "."); ?> </td>

                                                    </tr>
        <?php }
    } ?>

                                            <tr> 
                                                <td> </td>
                                                <td> </td>
                                                <td>Total Compra </td>
                                                <td>R$ <?= number_format($total / 100, 2, ",", "."); ?> </td>
                                                <td> </td>
                                            </tr>

                                        </tbody>

                                    </table>




                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
          
          
                </td>
                <td> <a href="../orcamento.php?os=<?= $vler["orcamento_id"] ?>" target="_blank" style="font-size:2.0em; color:orange;"> <i class="fas fa-file-alt"></i> </a> </td>
                <td>
                    
                    <?php 
                    $orc = str_pad($vler["orcamento_id"], 7, "0", STR_PAD_LEFT);
                    
                    $base = CONF_URL_BASE; 
                    
                    $loja = new Source\Models\Read();
                    $loja->ExeRead("app_lojas", "WHERE user_id = :a AND loja = :b", "a={$_SESSION["user_id"]}&b={$_SESSION["carteira"]}");
                    $loja->getResult();
                    
                   // $img = "https://www.localhost/dflixcontrolnew/uploads/images/2020/12/associacao.jpg";
                    
                    $proposta = ""
                            . "*Orcamento:* {$orc} %0A "
                            . "*".CONF_SITE_NAME."* %0A"
                            . "*Endereço:* ".CONF_SITE_ADDR_STREET."  Nº ".CONF_SITE_ADDR_NUMBER."  %0A"
                            . "*CEP:* ".CONF_SITE_ADDR_ZIPCODE." Cidade ".CONF_SITE_ADDR_ZIPCODE."  "
                            . "*Telefone*".CONF_SITE_ADDR_TELEFONE." %0A"
                            . "*ORÇAMENTO PARA VEICULO ABAIXO* %0A"
                            . "*Cliente:* {$vler["cliente"]} %0A"
                            . "*Veiculo:* {$vler["tipo"]} %0A"
                            . "*Marca:* {$vler["marca"]} %0A"
                            . "*Modelo:* {$vler["modelo"]} %0A"
                            . "*Placa:* {$vler["placa"]} %0A"
                            . "*Cor:* {$vler["cor"]} %0A"
                            . "Visualize seu orçamento %0A {$base}/orcamento.php?os={$vler["orcamento_id"]} %0A";
                    ?>
                   
                    
                    <a href="https://api.whatsapp.com/send?phone=55<?= $vler["telefone"] ?>&text=<?= $proposta ?>" target="_blank" style="font-size:2.5em; color:green; text-decoration: none;"> <i class="fab fa-whatsapp-square"></i></a> </td>
                <td> 
                    <?php if ($vler["status"] == "1") { ?>
                        <p style="color:#006cad; font-weight: bold;"> Enviado </p> 
                    <?php } ?>
                    <?php if ($vler["status"] == "2") { ?>
                        <p style="color:green; font-weight: bold;"> Executar </p> 
                    <?php } ?>
                    <?php if ($vler["status"] == "3") { ?>
                        <p style="color:red; font-weight: bold;"> Cancelar </p>
                    <?php } ?>
                   

                    <?php if ($vler["status"] == "2") { ?>
                        <!--- Aqui função dar entrada  -->
                     
                        <a href="./?p=funcao-os&editar=<?= $vler["orcamento_id"] ?>"><p class="btn btn-info"> Cadastrar Ordem Serviço </p></a>


    <?php } else { ?>

                        <form method="post" action=""> 
                            <div class="form-group"> 
                                <select name="status" class="form-control"> 
                                    <option value="1"> Enviado </option>
                                    <option value="2"> Executar </option>
                                    <option value="3"> Cancelar </option>
                                   
                                </select>
                                <input type="hidden" name="acao"  value="MUDAR STATUS" />
                                <input type="hidden" name="id"  value="<?= $vler["id"] ?>" />
                                <input type="submit" class="btb btn-warning" name="atualiza"  value="MUDAR STATUS" />
                            </div>

                        </form>
    <?php } ?>
                </td>
                <td> <a href="./?p=orcamento-itens&editar=<?= $vler["orcamento_id"] ?>"><i class="fas fa-edit"></i> </a></td>

            </tr>
<?php } ?>

    </tbody>
</table>


            
            <?php 
            $pager->ExePaginator("app_orcamento", "WHERE user_id = :a ORDER BY orcamento_id DESC", "a={$_SESSION["user_id"]}");
            echo $pager->getPaginator();

            ?>
</div>


<script>



    $(function () {

        $('select[name=veiculo]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/assets/functions/marca.php",
                    {veiculo: $(this).val()},
                    function (veiculo) {

                        $('select[name=marca1]').html(veiculo)

                    })
        });

        $('select[name=marca1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/assets/functions/modelo.php",
                    {marca: $(this).val()},
                    function (marca) {

                        $('select[name=modelo1]').html(marca)

                    })
        });

        $('select[name=modelo1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/assets/functions/ano.php",
                    {modelo: $(this).val()},
                    function (modelo) {

                        $('select[name=ano1]').html(modelo)

                    })
        });

        $('select[name=ano1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/assets/functions/ano.php",
                    {modelo: $(this).val()},
                    function (modelo) {

                        $('select[name=fipe]').html(modelo)

                    })
        });

//        $('select[name=ano1]').change(function () {
//            $.post("<?= CONF_URL_BASE ?>/assets/functions/codigofipe.php",
//                    {fipe: $(this).val()},
//                    function (fipe) {
//
//                        $('select[name=fipe]').html(fipe)
//
//                    })
//        });

        $('select[name=ano1]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/assets/functions/preco.php",
                    {valor: $(this).val()},
                    function (valor) {

                        $('select[name=valor]').html(valor)

                    })
        });

        $('select[name=plano]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/plano_desc.php",
                    {plano: $(this).val()},
                    function (plano) {

                        $('select[name=plano_desc]').html(plano)

                    })
        });

        $('select[name=plano]').change(function () {
            $.post("<?= CONF_URL_BASE ?>/admin/plano_valor.php",
                    {valorplan: $(this).val()},
                    function (valorplan) {

                        $('select[name=plano_valor]').html(valorplan)

                    })
        });





    });





</script>

