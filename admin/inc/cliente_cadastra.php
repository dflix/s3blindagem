

<?php 
if(!empty($_GET["edit"])){
    $edit = new Source\Models\Read();
    $edit->ExeRead("app_clientes", "WHERE cliente_id = :id", "id={$_GET["edit"]}");
    $edit->getResult();
}
?>

<div class="container-fluid"> 

    <h3 class="border-bottom"> Clientes & Pedidos </h3>

    <div class="row"> 

<!--        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/contrato" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Clientes</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/plano" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Pedidos</div> </a>
        </div>-->

        <script>

            $(function () {


                $(".js_fisica").hide();
                $(".js_juridica").hide();
                $('input[name="tipo"]').change(function () {

                    if ($('input[name="tipo"]:checked').val() === "1") {
                        $('.js_fisica').show();
                    } else {
                        $('.js_fisica').hide();
                    }

                    if ($('input[name="tipo"]:checked').val() === "2") {
                        $('.js_juridica').show();
                    } else {
                        $('.js_juridica').hide();
                    }
                    
                    
                });

            });
        </script>


        <div class="col-md-12"> 
            <div class="row">
                <div class="col-md-6">
                <h3 class="border-bottom col-md-12"> Cadastrar Cliente </h3>  

                <form method="post" action="">
                    <div class="col-md-12">
                        <span><b>Selecione o Tipo de Pessoa </b> </span>
                        </br>
<!--                <input type="radio" name="tipo" value="Unica" class="form" >  Unica-->
                        
                        <?php 
                        if(!empty($_GET["edit"])):
                        ?>
                        
                <input type="radio" name="tipo" value="<?=$edit->getResult()[0]["tipo"] ?>" checked="" >  <?=$edit->getResult()[0]["tipo"] ?> 
                <input type="radio" name="tipo" value="1" >  Fisica 

                <input type="radio" name="tipo" value="2" > Juridica
                        
                        <?php else: ?>
                        
                 <input type="radio" name="tipo" value="1" >  Fisica 

                <input type="radio" name="tipo" value="2" > Juridica
                        
                        <?php  endif; ?>

               
                
                </div>
                    
                    <div class="col-md-12"> 
                        <label>Nome ou Razão Social </label>
                        <input type="text" class="form-control" placeholder="Nome ou Razão Social" name="nome_razao"
                               <?php 
                               if(!empty($_GET["edit"])){
                                   echo "value='{$edit->getResult()[0]["nome"]}'";
                               }
                               ?>/>
                    </div>

                <div class="js_fisica col-md-12"> 
                    <div class="row"> 
                        <div class="col-md-6"> 
                             <label>RG </label>
                            <input type="text" class="form-control" name="rg" placeholder="RG" <?php 
                               if(!empty($_GET["edit"])){
                                   echo "value='{$edit->getResult()[0]["rg"]}'";
                               }
                               ?> />
                        </div>
                        <div class="col-md-6"> 
                             <label>CPF </label>
                            <input type="text" class="form-control" name="cpf" placeholder="CPF"  <?php 
                               if(!empty($_GET["edit"])){
                                   echo "value='{$edit->getResult()[0]["cpf"]}'";
                               }
                               ?>/>
                        </div>
                    </div>
                
                </div>
                <div class="js_juridica col-md-12"> 
                
                                        <div class="row"> 
                        <div class="col-md-6"> 
                             <label>CNPJ </label>
                            <input type="text" class="form-control" name="cnpj" placeholder="CNPJ"  <?php 
                               if(!empty($_GET["edit"])){
                                   echo "value='{$edit->getResult()[0]["cnpj"]}'";
                               }
                               ?> />
                        </div>
                        <div class="col-md-6"> 
                             <label>IE </label>
                            <input type="text" class="form-control" name="ie" placeholder="IE"  <?php 
                               if(!empty($_GET["edit"])){
                                   echo "value='{$edit->getResult()[0]["ie"]}'";
                               }
                               ?> />
                        </div>
                    </div>
                
                </div>
                <div class=" col-md-12"> 
                
                                        <div class="row"> 
                        <div class="col-md-6"> 
                             <label>Responsavel </label>
                            <input type="text" class="form-control" name="responsavel" placeholder="Responsavel"  <?php 
                               if(!empty($_GET["edit"])){
                                   echo "value='{$edit->getResult()[0]["responsavel"]}'";
                               }
                               ?> />
                        </div>
                        <div class="col-md-6"> 
                             <label>Data de Nascimento </label>
                            <input type="date" id="date" class="form-control" name="data_nascimento" placeholder="data Nascimento" <?php 
                               if(!empty($_GET["edit"])){
                                   echo "value='{$edit->getResult()[0]["data_nascimento"]}'";
                               }
                               ?> />
                        </div>
                    </div>
                
                </div>
                    </br>
                    <div class="col-md-12">
                         </br>
                         <?php if(!empty($_GET["edit"])): ?>
                         <input type="hidden" name="editar" value="editar" />
                         <input type="hidden" name="id" value="<?= $edit->getResult()[0]["cliente_id"] ?>" />
                         
                         <?php endif; ?>
                    <input type="submit" class="btn btn-success" value="<?php 
                    if(!empty($_GET["edit"])){
                        echo "EDITAR";
                    }else{
                       echo "CADASTRAR"; 
                    }
                    ?>" />
                    </div>
                 </form>

            </div>
                
                <div class="col-md-6"> 
                    <h3> Cliente </h3>
                    <?php
                    $cliente = new Source\Core\Clientes();
                    if(!empty($_GET["edit"])){
                       $cliente->atualiza(); 
                    }else{
                    $cliente->cadastra();
                    }
                    ?>
                </div>



        </div>

    </div> 
</div> 

