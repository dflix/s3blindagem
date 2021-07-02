

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
            </br>
            <?php 
            $contrato = new Source\Core\Contratos();
            $contrato->cadastra();
            $contrato->editar();
            $contrato->delete();
            
            if(!empty($_GET["editar"])){
                $edit = new \Source\Models\Read();
                $edit->ExeRead("app_contratos", "WHERE id = :id", "id={$_GET["editar"]}");
                $edit->getResult();
            }
            ?>
            <form action="" method="post"> 
                <div class="col-md-12"> 

                    <input type="text" placeholder="Nome do Contrato" value="<?php 
                    if(!empty($_GET["editar"])){
                      echo $edit->getResult()[0]['nome'];  
                    } ?>" name="nome" class="form-control" />
                </div>


                <div class="col-md-12"> 
                    <label> Termos do Contrato</label>

                    <textarea id="summernote" class="form-control" name="termos"><?php
                    if(!empty($_GET["editar"])){
                        echo $edit->getResult()[0]['termos'];
                    }
                     ?></textarea>
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



        <div class="col-md-6"> 
            <h3 class="border-bottom">Orçamentos Enviados </h3>
            <table class="table table-responsive table-condensed table-striped"> 
                <thead class="bg-dark" style="color:#fff;"> 
                    <tr>
                        <th>Contrato </th>
                        <th>Editar </th>
                        <th>Excluir </th>


                    </tr>
                </thead>
                <tbody> 

                    <?php
                    $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                    $pager = new Source\Support\Pager("./contrato&atual=", "Primeiro", "Ultimo", "1");
                    $pager->ExePager($atual, 10);

                    $read = new \Source\Models\Read();
                    $read->ExeRead("app_contratos", "WHERE user_id = :id  LIMIT :limit OFFSET :offset",
                            "id={$_SESSION["user_id"]}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $read->getResult();

                    foreach ($read->getResult() as $contrato) {
                        ?>

                        <tr> 

                            <td> <?= $contrato["nome"] ?></td>
                            <td> <p class="btn btn-info"><a href="./contrato&editar=<?= $contrato["id"] ?>" style="text-decoration: none;color:#fff;">Editar</a></p></td>
                            <td> <p class="btn btn-danger"><a href="./contrato&deletar=<?= $contrato["id"] ?>" style="text-decoration: none;color:#fff;">Deletar</a></p></td>


                        </tr>
                    <?php } ?>



                </tbody>
            </table>
            <?php
            $pager->ExePaginator("app_contratos");
            echo $pager->getPaginator();
            ?>
        </div>




    </div>


</div>

