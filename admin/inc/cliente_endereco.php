

<!-- Adicionando Javascript -->
<script type="text/javascript" >

    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('logradouro').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('uf').value = ("");

    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('uf').value = (conteudo.uf);

        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('logradouro').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('uf').value = "...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }
    ;

</script>

<div class="container-fluid"> 

    <h3 class="border-bottom"> Clientes & Pedidos </h3>

    <div class="row"> 

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/contrato" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Clientes</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/plano" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Pedidos</div> </a>
        </div>

        <?php
        if (!empty($_GET["edit"])) {
            $view = new \Source\Models\Read();
            $view->ExeRead("app_enderecos", "WHERE user_id = :id AND cliente_id = :n", "id={$_SESSION["user_id"]}&n={$_GET["edit"]}");
            $view->getResult();
        }
        ?>

        <div class="col-md-12"> 
            <div class="row">
                <div class="col-md-6">
                    <h3 class="border-bottom col-md-12"> Cadastrar Endereço </h3>  

                    <form method="post" action="">


                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6">
                                    <label>Selecione o Tipo </label>


                                    <select name="tipo" class="form-control"> 
                                        <?php
                                        if (!empty($_GET["edit"])):
                                            ?>
                                            <option value="<?= $view->getResult()[0]["tipo"] ?>"><?= $view->getResult()[0]["tipo"] ?> </option>                              
                                        <?php endif; ?>
                                        <option value="#">Tipo de Endereço </option>
                                        <option value="1">Residêncial </option>
                                        <option value="2">Empresarial </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Cep </label>
                                    <input type="text" id="cep" <?php
                                    if (!empty($_GET["edit"])) {
                                        echo "value='{$view->getResult()[0]["cep"]}'";
                                    }
                                    ?>  onblur="pesquisacep(this.value);" class="form-control" placeholder="Nome ou Razão Social" name="cep" />
                                </div>

                            </div>
                        </div>


                        <div class=" col-md-12"> 

                            <div class="row"> 
                                <div class="col-md-10"> 
                                    <label>Logradouro </label>
                                    <input type="text" <?php
                                    if (!empty($_GET["edit"])) {
                                        echo "value='{$view->getResult()[0]["logradouro"]}'";
                                    }
                                    ?> id="logradouro" class="form-control" name="logradouro" placeholder="logradouro" />
                                </div>
                                <div class="col-md-2"> 
                                    <label>Numero </label>
                                    <input type="text" <?php
                                    if (!empty($_GET["edit"])) {
                                        echo "value='{$view->getResult()[0]["numero"]}'";
                                    }
                                    ?>  class="form-control" name="numero" placeholder="nº" />
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-md-8"> 
                                    <label>Complemento </label>
                                    <input type="text" <?php
                                    if (!empty($_GET["edit"])) {
                                        echo "value='{$view->getResult()[0]["complemento"]}'";
                                    }
                                    ?> class="form-control" name="complemento" placeholder="complemento" />
                                </div>
                                <div class="col-md-4"> 
                                    <label>Bairro </label>
                                    <input type="text" <?php
                                    if (!empty($_GET["edit"])) {
                                        echo "value='{$view->getResult()[0]["bairro"]}'";
                                    }
                                    ?> id="bairro"  class="form-control" name="bairro" placeholder="bairro" />
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-md-6"> 
                                    <label>Cidade </label>
                                    <input type="text" <?php
                                    if (!empty($_GET["edit"])) {
                                        echo "value='{$view->getResult()[0]["cidade"]}'";
                                    }
                                    ?> id="cidade" class="form-control" name="cidade" placeholder="cidade" />
                                </div>
                                <div class="col-md-6"> 
                                    <label>UF </label>
                                    <input type="text" <?php
                                    if (!empty($_GET["edit"])) {
                                        echo "value='{$view->getResult()[0]["uf"]}'";
                                    }
                                    ?> id="uf"  class="form-control" name="uf" placeholder="uf" />
                                </div>
                            </div>

                        </div>
                        </br>
                        <div class="col-md-12">
                            </br>
                            <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>" />


                            <?php
                            if (!empty($_GET["edit"])):
                                ?>
                                <input type="hidden" name="cliente_id" value="<?= $_GET["edit"] ?>" />
                                <input type="hidden" name="id" value="<?= $view->getResult()[0]["id"] ?>" />
                                <input type="submit" class="btn btn-success" value="atualizar" />
                            <?php else: ?>
                                <input type="hidden" name="cliente_id" value="<?= $_SESSION["cliente_id"] ?>" />
                                <input type="submit" class="btn btn-success" value="cadastrar" />
                            <?php endif; ?>
                        </div>
                    </form>

                </div>

                <div class="col-md-6"> 
                    <h3> Cliente </h3>
                    <?php
                    $cliente = new Source\Core\Clientes();
                    if (!empty($_GET["edit"])) {
                        $cliente->atualizaEndereco();
                    } else {
                        $cliente->endereco();
                    }

                    //  echo $_SESSION["cliente"];
                    if (!empty($_GET["edit"])) {
                        $view = new Source\Models\Read();
                        $view->ExeRead("app_clientes", "WHERE user_id = :id AND cliente_id = :n", "id={$_SESSION["user_id"]}&n={$_GET["edit"]}");
                        $view->getResult();
                    } else {
                        $view = new Source\Models\Read();
                        $view->ExeRead("app_clientes", "WHERE user_id = :id AND cliente_id = :n", "id={$_SESSION["user_id"]}&n={$_SESSION["cliente_id"]}");
                        $view->getResult();
                    }
                    ?>

                    <div class="col-md-12"> 
                        <p> Cliente Tipo : <?php
                            if (!empty($_GET["edit"])) {
                                if ($view->getResult()[0]["tipo"] == "1") {
                                    echo "<b>Pessoa Física </b></br>";
                                }
                                if ($view->getResult()[0]["tipo"] == "2") {
                                    echo "<b>Pessoa Juridica </b></br>";
                                }
                            } else {
                                if ($view->getResult()[0]["tipo"] == "1") {
                                    echo "<b>Pessoa Física </b></br>";
                                }
                                if ($view->getResult()[0]["tipo"] == "2") {
                                    echo "<b>Pessoa Juridica </b></br>";
                                }
                            }
                            ?> </p>
                        <div class="col-md-6"> 
                            <p><b>Nome:</b></br> <?php
                                if (!empty($_GET["edit"])) {
                                    echo $view->getResult()[0]["nome"];
                                } else {
                                    echo $view->getResult()[0]["nome"];
                                }
                                ?>  </p>
                        </div>
                        <div class="col-md-6"> 
                            <p><b>Data Nascimento:</b></br> <?php
                                if (!empty($_GET["edit"])) {
                                    echo date("d/m/Y", strtotime($view->getResult()[0]["data_nascimento"]));
                                } else {
                                    echo date("d/m/Y", strtotime($view->getResult()[0]["data_nascimento"]));
                                }
                                ?>  </p>
                        </div>

                        <?php
                        if (!empty($_GET["edit"])) {
                            if ($view->getResult()[0]["tipo"] == "1") {
                                ?>
                                <div class="col-md-6"> 
                                    <p><b>CPF </b></br>  <?php
                                        if (!empty($_GET["edit"])) {
                                            echo $view->getResult()[0]["cpf"];
                                        }
                                        ?> </p>
                                </div>
                                <div class="col-md-6"> 
                                    <p><b>RG </b></br>  <?= $view->getResult()[0]["rg"] ?> </p>
                                </div>
                                <?php
                            }
                        }
                        ?>

                        <?php
                        if (!empty($_GET["edit"])) {
                            if ($view->getResult()[0]["tipo"] == "2") {
                                ?>
                                <div class="col-md-6"> 
                                    <p><b>CNPJ </b></br>  <?= $view->getResult()[0]["cnpj"] ?> </p>
                                </div>
                                <div class="col-md-6"> 
                                    <p><b>IE </b></br>  <?= $view->getResult()[0]["ie"] ?> </p>
                                </div>
                            <?php
                            }
                        }
                        ?>


                    </div>

                    <div class="col-md-12"> 
                        <?php
                        //var_dump($_SESSION);
                        if (!empty($GET["edit"])) {
                            $endereco = new Source\Models\Read();
                            $endereco->ExeRead("app_enderecos", "WHERE cliente_id = :c AND user_id = :id", "c={$_SESSION["cliente_id"]}&id={$_SESSION["user_id"]}");
                            $endereco->getResult();
                        } else {
                            $endereco = new Source\Models\Read();
                            $endereco->ExeRead("app_enderecos", "WHERE cliente_id = :c AND user_id = :id", "c={$_SESSION["cliente_id"]}&id={$_SESSION["user_id"]}");
                            $endereco->getResult();
                        }
                        if (empty($endereco->getResult())) {
                            echo "<div class=\"alert alert-warning\" role=\"alert\">
               <h5> Não existe endereços cadastrados </h5> </div>";
                        } else {
                            foreach ($endereco->getResult() as $view) {
                                ?>  

                                <div class="row"> 

                                    <div class="col-md-12 border">
                                        <p class="border-bottom"> <b>Endereços Cadastrados</b></p>
                                        <div class="col-md-2"> <b>Cep</b></br></br> <?= $view["cep"] ?> </div>
                                        <div class="col-md-8"> <b>Endereço</b></br> <?= $view["logradouro"] ?> </div>
                                        <div class="col-md-2"> <b>Nº</b></br> <?= $view["numero"] ?> </div>
                                        <div class="col-md-8"> <b>Complemento</b></br> <?= $view["complemento"] ?> </div>
                                        <div class="col-md-3"> <b>Bairro</b></br> <?= $view["bairro"] ?> </div>
                                        <div class="col-md-3"> <b>Cidade</b></br> <?= $view["cidade"] ?> </div>
                                        <div class="col-md-3"> <b>UF</b></br> <?= $view["uf"] ?> </div>
                                        <div class="col-md-3"> <b>Tipo</b></br> <?= $view["tipo"] ?> </div>

                                    </div>

                                </div>



                            <?php } ?>

                            <?php
                            if (!empty($_GET["edit"])) {
                                ?>
                                <div class="col-md-12"> 
                                    <p class="btn btn-success"> <a href="./?p=cliente_contato&edit=<?= $_GET["edit"] ?>" style="text-decoration: none; color:#fff;">Seguir Cadastro</a> </p>
                                </div>

    <?php } else { ?>
                                <div class="col-md-12"> 
                                    <p class="btn btn-success"> <a href="./?p=cliente_contato" style="text-decoration: none; color:#fff;">Seguir Cadastro</a> </p>
                                </div>            

                            <?php } ?>

<?php } ?> 



                    </div>                    


                </div>



            </div>

        </div> 
    </div> 

