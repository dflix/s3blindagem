

<div class="container-fluid"> 

    <h3 class="border-bottom"> Clientes & Pedidos </h3>

    <div class="row"> 

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/contrato" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Clientes</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/plano" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Pedidos</div> </a>
        </div>



        <div class="col-md-12"> 
            <div class="row">
                <div class="col-md-6">
                    <h3 class="border-bottom col-md-12"> Cadastrar Contatos </h3>  

                    <form method="post" action="">


                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6">
                                    <label>Selecione o Tipo </label>
                                    <select name="tipo" class="form-control"> 
                                        <option value="#">Tipo de Contato </option>
                                        <option value="email">Email </option>
                                        <option value="telefone">Telefone </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Contato </label>
                                    <input type="text"  class="form-control" placeholder="contato" name="contato" />
                                </div>

                            </div>
                        </div>


                       
                        </br>
                        <div class="col-md-12">
                            </br>
                            <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>" />
                            <?php 
                            if(!empty($_GET["edit"])){
                            ?>
                            
                            <input type="hidden" name="cliente_id" value="<?= $_GET["edit"] ?>" />
                            
                            <?php }else{ ?>
                            
                            <input type="hidden" name="cliente_id" value="<?= $_SESSION["cliente_id"] ?>" />
                            
                            <?php } ?>
                            
                            <input type="submit" class="btn btn-success" value="cadastrar" />
                        </div>
                    </form>

                </div>

                <div class="col-md-6"> 
                    <h3> Cliente </h3>
                    <?php
                    $cliente = new Source\Core\Clientes();
                    $cliente->contatos();

                    //echo $_SESSION["cliente_id"];
                    if(!empty($_GET["edit"])){
                       $view = new Source\Models\Read();
                    $view->ExeRead("app_clientes", "WHERE user_id = :id AND cliente_id = :n", "id={$_SESSION["user_id"]}&n={$_GET["edit"]}");
                    $view->getResult();    
                    }else{
                    $view = new Source\Models\Read();
                    $view->ExeRead("app_clientes", "WHERE user_id = :id AND cliente_id = :n", "id={$_SESSION["user_id"]}&n={$_SESSION["cliente_id"]}");
                    $view->getResult();
                    }
                    ?>

                    <div class="col-md-12"> 
                        <p> Cliente Tipo : <?php
                            if ($view->getResult()[0]["tipo"] == "1") {
                                echo "<b>Pessoa Física </b></br>";
                            }
                            if ($view->getResult()[0]["tipo"] == "2") {
                                echo "<b>Pessoa Juridica </b></br>";
                            }
                            ?> </p>
                        <div class="col-md-6"> 
                            <p><b>Nome:</b></br> <?= $view->getResult()[0]["nome"] ?>  </p>
                        </div>
                        <div class="col-md-6"> 
                            <p><b>Data Nascimento:</b></br> <?= date("d/m/Y", strtotime($view->getResult()[0]["data_nascimento"])) ?>  </p>
                        </div>

                        <?php
                        if ($view->getResult()[0]["tipo"] == "1") {
                            ?>
                            <div class="col-md-6"> 
                                <p><b>CPF </b></br>  <?= $view->getResult()[0]["cpf"] ?> </p>
                            </div>
                            <div class="col-md-6"> 
                                <p><b>RG </b></br>  <?= $view->getResult()[0]["rg"] ?> </p>
                            </div>
                        <?php } ?>

                        <?php
                        if ($view->getResult()[0]["tipo"] == "2") {
                            ?>
                            <div class="col-md-6"> 
                                <p><b>CNPJ </b></br>  <?= $view->getResult()[0]["cnpj"] ?> </p>
                            </div>
                            <div class="col-md-6"> 
                                <p><b>IE </b></br>  <?= $view->getResult()[0]["ie"] ?> </p>
                            </div>
                        <?php } ?>


                    </div>

                    <div class="col-md-12"> 
                        <?php
                        if(!empty($_GET["edit"])){
                        $endereco = new Source\Models\Read();
                        $endereco->ExeRead("app_enderecos", "WHERE cliente_id = :c AND user_id = :id", "c={$_GET["edit"]}&id={$_SESSION["user_id"]}");
                        $endereco->getResult();                            
                        }else{
                        $endereco = new Source\Models\Read();
                        $endereco->ExeRead("app_enderecos", "WHERE cliente_id = :c AND user_id = :id", "c={$_SESSION["cliente_id"]}&id={$_SESSION["user_id"]}");
                        $endereco->getResult();
                        }
                        if (empty($endereco->getResult())) {
                            echo "<div class=\"alert alert-warning\" role=\"alert\">
               <h5> Não existe endereços cadastrados para cliente`{$view->getResult()[0]["nome"]}</h5> </div>";
                        }else{
                            foreach ($endereco->getResult() as $view) {
                    
                        ?>  
                        
                        <div class="row"> 
                            
                            <div class="col-md-12 border">
                                <p class="border-bottom"> <b>Endereços Cadastrados</b></p>
                                <div class="col-md-2"> <b>Cep</b></br></br> <?= $view["cep"] ?> </div>
                            <div class="col-md-8"> <b>Endereço</b></br> <?= $view["logradouro"] ?> </div>
                            <div class="col-md-2"> <b>Nº</b></br> <?= $view["cliente_id"] ?> </div>
                            <div class="col-md-8"> <b>Complemento</b></br> <?= $view["complemento"] ?> </div>
                            <div class="col-md-3"> <b>Bairro</b></br> <?= $view["bairro"] ?> </div>
                            <div class="col-md-3"> <b>Cidade</b></br> <?= $view["cidade"] ?> </div>
                            <div class="col-md-3"> <b>UF</b></br> <?= $view["uf"] ?> </div>
                            <div class="col-md-3"> <b>Tipo</b></br> <?= $view["tipo"] ?> </div>
                            
                            </div>
                        
                        </div>
                        
                        
                        
                            <?php }  ?>
                           
                            
                         <?php   } ?>
                        
                       

                    </div>   
                        <?php 
                        if(!empty($_GET["edit"])){
                        $email = new Source\Models\Read();
                        $email->ExeRead("app_contatos", "WHERE user_id = :id AND cliente_id = :c AND tipo = :t", "id={$_SESSION["user_id"]}&c={$_GET["edit"]}&t=email");
                        $email->getResult();    
                        }else{
                        $email = new Source\Models\Read();
                        $email->ExeRead("app_contatos", "WHERE user_id = :id AND cliente_id = :c AND tipo = :t", "id={$_SESSION["user_id"]}&c={$_SESSION["cliente_id"]}&t=email");
                        $email->getResult();
                        }
                        
                        if(!empty($_GET["edit"])){
                         $telefone = new Source\Models\Read();
                        $telefone->ExeRead("app_contatos", "WHERE user_id = :id AND cliente_id = :c AND tipo = :t", "id={$_SESSION["user_id"]}&c={$_GET["edit"]}&t=telefone");
                        $telefone->getResult();                           
                        }else{
                        $telefone = new Source\Models\Read();
                        $telefone->ExeRead("app_contatos", "WHERE user_id = :id AND cliente_id = :c AND tipo = :t", "id={$_SESSION["user_id"]}&c={$_SESSION["cliente_id"]}&t=telefone");
                        $telefone->getResult();
                        }
                        
                        ?>
                    <!--Exibe os emails -->
                    <?php 
                    if($email->getResult()){
                        foreach ($email->getResult() as $ver) {
                            
                       
                    ?>
                    <div class="col-md-12"> 

                        <p> <b> Emails </b> : <?=$ver["contato"] ?></p>
                    </div>
                        <?php  }}else{ ?>
                    <div class="col-md-12"> 

                        <div class="alert alert-warning"> Não existe e-mails cadastrados </div>
                    </div>               
                    
                    <?php } ?>
                    
                    
                    <!--Exibe os telefones -->
                    <?php 
                    if($telefone->getResult()){
                        foreach ($telefone->getResult() as $tel) {

                    ?>
                    <div class="col-md-12"> 

                        <p> <b>Fone:</b><?= $tel["contato"] ?> </p>
                    </div>
                    <?php  } }else{ ?>
                    <div class="col-md-12"> 

                      <div class="alert alert-warning"> Não existetelefones cadastrados </div>
                    </div>               
                    
                    <?php } ?>
                    

                    
                    
                      <div class="col-md-6"> 
                                 <p class="btn btn-success"> <a href="<?=CONF_URL_APP ?>/?p=cliente" style="text-decoration: none; color:#fff;">Finalizar Cadastro</a> </p>
                        </div>
                    
                    
                      <div class="col-md-6"> 
                                 <p class="btn btn-info"> <a href="./contato" style="text-decoration: none; color:#fff;">Cadastrar Pedido</a> </p>
                        </div>


                </div>



            </div>

        </div> 
    </div> 

