

<script type="text/javascript">
    $(function () {
        $("#valor").maskMoney();
    })
    $(function () {
        $("#valor2").maskMoney();
    })
</script>

<div class="container-fluid"> 
    <div class="row"> 

        <?php
         unset($_SESSION["pagamento"]);
        ?>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <p class="border-bottom"> <i class="fas fa-cash-register" style="font-size: 2.5em;"></i> CCC Caixa Registro </p>
            <form method="post" id="form-pesquisa" action=""> 
                <label>Pesquisa Produto </label>
                <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Digite o produto" />
            </form>
            <div class="resultado"> </div>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <p class="border-bottom"> Carrinho de Compras </p>
            <?php
            $carrinho = new \Source\Core\Carrinho();
            $carrinho->carrinho();
            $carrinho->pedido();
            $carrinho->finalizar();
            ?>

            <?php
            if (count($_SESSION['carrinho']) == 0) {
                echo "
                
                    <div class='alert alert-warning'>Não há produto no carrinho</div>
                
            ";
            } else {

                $total = 0;
                foreach ($_SESSION['carrinho'] as $id => $qtd) {

                    $ler = new \Source\Models\Read();
                    $ler->ExeRead("app_prod_var", "WHERE id = :a", "a={$id}");
                    $ler->getResult();

                    $nomeProd = new \Source\Models\Read();
                    $nomeProd->ExeRead("app_prod", "WHERE id = :a", "a={$ler->getResult()[0]["produto_id"]}");
                    $nomeProd->getResult();

//                    $nome = $nomeProd->getResult()[0]["produto"];
                    $precoview = number_format($ler->getResult()[0]["valor"] / 100 , 2, ',', '.');
                    $subview = number_format($ler->getResult()[0]["valor"] / 100  * $qtd, 2, ',', '.');
                    $nome = $nomeProd->getResult()[0]["produto"];
                    $preco = $ler->getResult()[0]["valor"] ;
                    $sub = $ler->getResult()[0]["valor"] * $qtd;
                   $total += $sub;
                    //echo $total += $ler->getResult()[0]["valor"] * $qtd;
                    //$total += $sub;
                    
                    ?>
            <div class="row border-bottom">       
                                <div class="col-md-2"><?=$nome ?> </div>
                                <div class="col-md-2"><?=$ler->getResult()[0]["tamanho"]  ?> <?= $ler->getResult()[0]["cor"] ?> </div>
                                 <div class="col-md-1"><?=$qtd ?> <a href="./caixa&acao=add&id=<?=$id ?>"><span> adicionar </span></a>   </div>
                                <div class="col-md-2">R$ <?=$precoview ?></div>
                                <div class="col-md-2">R$ <?=$subview ?></div>
                                <?php 
                                if(!empty($_SESSION["pagamento"])){
                                    null;
                                }else{
                                ?>    
                                <div class="col-md-2"><a class="btn btn-danger" href="?acao=del&id=<?=$id ?>">Remove</a></div>
                                <?php } ?>
                            </div>
            <?php // $total = number_format($total / 100 , 2, '.', '.'); ?>
            <?php 

                }
                //$total = number_format($total , 2, '.', '.');
                $_SESSION["totalpedido"] = $total;
                echo '';
            }
            ?>
            <div class="col-md-12">                         
                            <td colspan="4">Total</td>
                            <td><b>R$ <?=
                           
                               number_format($total / 100, 2,"." , "."); 
                          
                            ?></b></td>
                    </div>
            <form id="pedido" action="./caixa" method="post"> 
                <?php 
                if(!empty($_SESSION["pagamento"])){
                    null;
                }else{
                ?>
                <input type="submit" name="cadastrar" class="btn btn-success" value="Processar Pagamento" />
                <?php } ?>
            </form>

            <?php
            if (!empty($_SESSION["pagamento"])) {
                ?>

                <script>

                    $(function () {

                        $(".camposExtras").hide();
                        $(".js_dinheiro").hide();
                        $(".js_credito").hide();
                        $(".js_debito").hide();
                        $(".js_boleto").hide();
                        $('input[name="tipo"]').change(function () {
                            if ($('input[name="tipo"]:checked').val() === "Dinheiro") {
                                $('.js_dinheiro').show();
                            } else {
                                $('.js_dinheiro').hide();
                            }

                            if ($('input[name="tipo"]:checked').val() === "Cartão Crédito") {
                                $('.js_credito').show();
                            } else {
                                $('.js_credito').hide();
                            }

                            if ($('input[name="tipo"]:checked').val() === "Cartão Débito") {
                                $('.js_debito').show();
                            } else {
                                $('.js_debito').hide();
                            }

                            if ($('input[name="tipo"]:checked').val() === "Boleto") {
                                $('.js_boleto').show();
                            } else {
                                $('.js_boleto').hide();
                            }

                        });

                    });
                </script>

                <h3> Forma de Pagamento </h3>
                <input type="radio" name="tipo" value="Cartão Crédito" class="form" >  Cartão Crédito
                <input type="radio" name="tipo" value="Cartão Débito" class="form" >  Cartão Débito
                <input type="radio" name="tipo" value="Boleto" class="form" >  Boleto

                <input type="radio" name="tipo" value="Dinheiro" >  Dinheiro

    <!--                <input type="radio" name="tipo" value="Parcela" > Parcela-->

                <div class="col-lg-12 js_dinheiro" id="ocultar"> 
                    </br>
                    <label class="js_fixa"> Dinheiro </label>
                    <input type="text" name="dinheiro" class="troco" id="valor" class="form-control" />
                    <form action="" method="post">
                        <input type="hidden" name="forma_pagamento" value="Dinheiro" />
                    <input type="submit" name="finalizar"  class="btn btn-success" value="Finalizar Compra" />
                    </form>
                            <script type="text/javascript">

                    $(function () {
                        $(".troco").keyup(function () {
                            //Recuperar o valor do campo
                            var pesquisa = $(this).val();

                            //Verificar se há algo digitado
                            if (pesquisa != '') {
                                var dados = {
                                    troco: pesquisa
                                }
                                $.post("<?= CONF_URL_BASE ?>/troco.php", dados, function (retorna) {
                                    //Mostra dentro da ul os resultado obtidos 
                                    $(".troco").html(retorna);
                                });
                            }
                        });
                    });

        </script>
                    <div class="troco" > </div>
                </div>

                <div class="col-lg-12 js_credito" id="ocultar"> 
                    </br>
                    <label class="js_fixa"> Cartão Crédito </label>
                    <input type="submit" name="finalizar"  class="btn btn-success" value="Finalizar Compra" />
                </div>

                <div class="col-lg-12 js_debito" id="ocultar"> 
                    </br>
                    <label class="js_fixa"> Cartão Débito </label>
                    <input type="submit" name="finalizar"  class="btn btn-success" value="Finalizar Compra" />
                </div>

                <div class="col-lg-12 js_boleto" id="ocultar"> 
                    </br>
                    <label class="js_fixa"> Boleto </label>
                    <input type="submit" name="finalizar"  class="btn btn-success" value="Finalizar Compra" />
                </div>




            <?php } ?>
        </div>
    </div>
    <div class="row"> 
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






