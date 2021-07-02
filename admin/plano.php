<?php $v->layout("_theme"); ?>

 <script type="text/javascript">
    $(function(){
        $("#valor").maskMoney();
    })
    $(function(){
        $("#valor2").maskMoney();
    })
    </script>

<div class="container-fluid"> 

    <h3 class="border-bottom"> Contratos & Planos </h3>

    <div class="row"> 

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/contrato" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Contratos</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/plano" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Planos </div> </a>
        </div>


        <div class="col-md-6"> 
            <h3 class="border-bottom">Planos Cadastrados </h3>
            <table class="table table-responsive table-condensed table-striped"> 
                <thead class="bg-dark" style="color:#fff;"> 
                    <tr>
                        <th>Plano </th>
                        <th>Descrição </th>
                        <th>Valor </th>
                        <th>Periodo </th>
                        <th>Editar </th>
                        <th>Excluir </th>


                    </tr>
                </thead>
                <tbody> 

                    <?php
                    $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                    $pager = new Source\Support\Pager("./plano&atual=", "Primeiro", "Ultimo", "1");
                    $pager->ExePager($atual, 10);

                    $read = new \Source\Models\Read();
                    $read->ExeRead("app_planos_user", "WHERE user_id = :id  LIMIT :limit OFFSET :offset",
                            "id={$_SESSION["user_id"]}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $read->getResult();

                    foreach ($read->getResult() as $contrato) {
                       
                        ?>

                        <tr> 

                            <td> <?= $contrato["plano"] ?></td>
                            <td> <?= $contrato["descricao"] ?></td>
                            <td>R$ <?= number_format($contrato["valor"] / 100, 2, ".", ".") ?></td>
                            <td> <?= $contrato["periodo"] ?> (mês)</td>
                            <td> <p class="btn btn-info"><a href="./plano&editar=<?= $contrato["id"] ?>" style="text-decoration: none;color:#fff;">Editar</a></p></td>
                            <td> <p class="btn btn-danger"><a href="./plano&deletar=<?= $contrato["id"] ?>" style="text-decoration: none;color:#fff;">Deletar</a></p></td>


                        </tr>
                    <?php } ?>



                </tbody>
            </table>
            <?php
            $pager->ExePaginator("app_planos_user");
            echo $pager->getPaginator();
            ?>
        </div>
        
        <div class="col-md-6"> 
            
            <h3 class="border-bottom">Cadastrar Planos </h3>
            <?php 
            $plano = new Source\Core\Planos();
            $plano->cadastra();
            $plano->editar();
            $plano->delete();
            
            if(!empty($_GET["editar"])){
                $edit = new \Source\Models\Read();
                $edit->ExeRead("app_planos_user", "WHERE id = :id", "id={$_GET["editar"]}");
                $edit->getResult();
            }
            ?>
            <form action="" method="post"> 
                <div class="col-md-12"> 
                    </br>
                    <input type="text" placeholder="Nome do Plano" value="<?php 
                    if(!empty($_GET["editar"])){
                      echo $edit->getResult()[0]['plano'];  
                    } ?>" name="plano"  class="form-control" />
                </div>
                <div class="col-md-12"> 
                    </br>
                    <input type="text" placeholder="Descrição do Plano" value="<?php 
                    if(!empty($_GET["editar"])){
                      echo $edit->getResult()[0]['descricao'];  
                    } ?>" name="descricao" class="form-control" />
                </div>
                <div class="col-md-12"> 
                    </br>
                    <input type="text" placeholder="Valor do Plano" value="<?php 
                    if(!empty($_GET["editar"])){
                      echo $edit->getResult()[0]['valor'];  
                    } ?>" name="valor" id="valor" class="form-control" />
                </div>
                <div class="col-md-12"> 
                    </br>
                    <select class="form-control" name="periodo"> 
                        
                        <option value="1">Mensal </option>
                        <option value="3">Trimestral </option>
                        <option value="6">Semestral </option>
                        <option value="12">Anual </option>
                    
                    </select> 
                </div>


                <div class="col-md-12"> 
                    <?php 
                    if(!empty($_GET["editar"])){
                    ?>
                    <input type="hidden" name="metodo" value="editar" />
                    <input type="hidden" name="id" value="<?= $edit->getResult()[0]['id']; ?>" />
                    <?php }else{ ?>
                     <input type="hidden" name="metodo" value="cadastrar" />
                    <?php  } ?>
                    <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>" />
                    <input type="submit" name="submit" value="enviar" class="btn btn-success" />
                </div>
            </form>




        </div>




    </div>


</div>

