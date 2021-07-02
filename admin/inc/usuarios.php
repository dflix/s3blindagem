
<div class="container-fluid"> 
    
     <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=usuarios-niveis" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Niveis </div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=usuarios" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> usuarios</div> </a>
        </div>
    
    <div class="col-md-12 clear">.</div>
    
  
    <?php
    
    if(!empty($_GET["deletar"])){
       
        $delete = new \Source\Models\Delete();
        $delete->ExeDelete("usuarios", "WHERE id = :a", "a={$_GET["deletar"]}");
        $delete->getResult();
        
        if($delete->getResult()){
          echo "<div class='alert alert-success'> Deletado com sucesso </div>";  
        }else{
           echo "<div class='alert alert-danger'> Erro ao deletar </div>";     
        }
        
    }
    
    
    if(!empty($_GET["editar"])){
    $usuarios = new \Source\Core\Usuarios();
    $usuarios->editar();  
    
    $view = new Source\Models\Read();
    $view->ExeRead("usuarios", "WHERE id = :a", "a={$_GET["editar"]}");
    $view->getResult();
    
    
    
    }else{
    $usuarios = new \Source\Core\Usuarios();
    $usuarios->cadastra();
    } 
    
    
    
    ?>
    
    <div class="row">
    
        <div class="col-md-6"> <h3 class="text-white"> Niveis de Usuários </h3>
            <p>nivel 1 cliente | nivel 2 afiliado | nivel 3 financeiro | nivel 4 master</p>
            <div class="row">
               
                <form class="form" method="post" action=""> 
                <div class="col-md-6">
                 <label> Nome </label>     
                 <input type="text" name="empresa" 
                        <?php 
                        if(!empty($_GET["editar"])){
                            echo "value='{$view->getResult()[0]["empresa"]}'";
                        }
                        ?>
                        class="form-control col-md-12" />   
                </div> 
                <div class="col-md-6">
                 <label> Sobrenome </label>     
                 <input type="text" name="responsavel" 
                         <?php 
                        if(!empty($_GET["editar"])){
                            echo "value='{$view->getResult()[0]["responsavel"]}'";
                        }
                        ?>
                        class="form-control col-md-12" />   
                </div> 
                <div class="col-md-6">
                 <label> E-mail </label>     
                 <input type="text" name="email" 
                                                 <?php 
                        if(!empty($_GET["editar"])){
                            echo "value='{$view->getResult()[0]["email"]}'";
                        }
                        ?>
                        class="form-control col-md-12" />   
                </div> 
                    <?php 
                    if(empty($_GET["editar"])){
                    ?>
                <div class="col-md-6">
                 <label> Senha </label>     
                 <input type="text" name="password" class="form-control col-md-12" />   
                </div> 
                    <?php } ?>
                <div class="col-md-12">
                 <label> Nivel </label>     
                 <select class="form-control" name="nivel">
                                       <?php 
                    if(!empty($_GET["editar"])){
                    ?>
                     <option value="<?= $view->getResult()[0]["nivel"] ?>"> <?= $view->getResult()[0]["nivel"] ?> </option>
                    <?php } ?>
                     <option value="1"> Cliente (1)</option>
                     <option value="2"> Afiliado (2)</option>
                     <option value="3"> Administrador(3)</option>
                     <option value="4"> Master (4)</option>
                 </select>  
                </div> 
                <div class="col-md-12"> 
                      <?php 
                    if(!empty($_GET["editar"])){
                    ?>
                    <input type="hidden" name="id" value="<?= $view->getResult()[0]["id"] ?>" />
                    <?php } ?>
                    <input type="submit" class="btn btn-primary" value="cadastrar" />
                </div>
           
            
            </form>
            </div>
            
        </div>
        <div class="col-md-6"> 
            <table class="table"> 
                <thead> 
                    <tr> 
                        <th>Usuario </th>
                        <th>Email </th>
                        <th>Nivel </th>
                        <th>Status </th>
                        <th>Editar </th>
                        <th>Deletar </th>
                    </tr>
                </thead>
                
                <tbody> 
                <?php 
                $user = new Source\Models\Read();
                $user->ExeRead("usuarios", "WHERE nivel != :a", "a=1");
                $user->getResult();
                foreach ($user->getResult() as $valor) {

                ?>
                    <tr> 
                        <td><?=$valor["responsavel"] ?> </td>
                        <td><?=$valor["email"] ?> </td>
                        <td><?php

                                if($valor["nivel"] == "1"){
                                    echo "Cliente";
                                }
                                if($valor["nivel"] == "2"){
                                    echo "Afiliado";
                                }
                                if($valor["nivel"] == "3"){
                                    echo "Administrador";
                                }
                                if($valor["nivel"] == "4"){
                                    echo "Master";
                                }
                                
                                ?> </td>
                        <td><?php 
                        if($valor["status"] != "canceled"){
                            echo "ativo";
                        }
                        ?> </td>
                        <td><a href="?p=usuarios&editar=<?=$valor["id"] ?>" class="btn btn-info">Editar</a> </td>
                        <td><a href="?p=usuarios&deletar=<?=$valor["id"] ?>" class="btn btn-danger">Excluir</a> </td>
                    </tr>
                <?php } ?>

                
                </tbody>
            </table>
        
        </div>
    
    </div>
    
</div>

