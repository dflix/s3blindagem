

<div class="container-fluid"> 
    <div class="row"> 
        
        <?php 
        
        if(empty($_GET["editar"])){
            $acao = "cadastrar";
        }else{
            $acao = "editar";
            
            $view = new Source\Models\Read();
            $view->ExeRead("app_prod","WHERE id = :a", "a={$_GET["editar"]}");
            $view->getResult();
        }
        
        $prod = new \Source\Core\Produtos();
        $prod->produtos();
        ?>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=prod-categ" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Categorias</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=produtos" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Produtos</div> </a>
        </div>
    </div>
    <div class="row"> 

        <div class="col-md-12"> 
            <form name="form" action="" method="post" enctype="multipart/form-data" >
<!--                <div class="form-group"> 
                    <p> Imagem de Capa </p>
                <input type="file" name="image" class="form-control" />
                </div>-->
<div class="form-group"> 
 <p class="border-bottom">Produto Tipo</p>
 <select name="tipo" class="form-control"> 
     <option 
         <?php 
                           if(!empty($_GET["editar"])){
                             echo "value='{$view->getResult()[0]['tipo']}'";  
                           }
                           ?>
         >Selecione Tipo de Produto </option>
     <option value="1">Fisico </option>
     <option value="2">Serviço </option>
     <option value="3">Digital </option>
 </select>
</div>
                <div class="form-group"> 
                    <p class="border-bottom">Categoria</p>
                    <select name="categoria" class="form-control col-md-12"> 
                        <option
                            <?php 
                           if(!empty($_GET["editar"])){
                             echo "value='{$view->getResult()[0]['categoria']}'";  
                           }
                           ?>
                            > Selecione a Categoria </option>
                        <?php 
                        
                        $read = new Source\Models\Read();
                        $read->ExeRead("app_prod_categ", "ORDER BY id DESC");
                        $read->getResult();
                        foreach ( $read->getResult() as $categ) {

                        ?>
                        <option value="<?= $categ["slug"] ?>"><?= $categ["categoria"] ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <p>Produto </p>
                    <input type="text" name="produto" class="form-control col-md-12"
                           <?php 
                           if(!empty($_GET["editar"])){
                             echo "value='{$view->getResult()[0]['produto']}'";  
                           }
                           ?>
                           
                           />
                </div>
                <div class="form-group">
                    <p>Titulo </p>
                    <input type="text" name="titulo" class="form-control col-md-12"
                            <?php 
                           if(!empty($_GET["editar"])){
                             echo "value='{$view->getResult()[0]['titulo']}'";  
                           }
                           ?>
                           />
                </div>
                <div class="form-group">
                    <p>Descrição </p>
                    <textarea name="descricao" class="form-control">  <?php if(!empty($_GET["editar"])){echo $view->getResult()[0]['descricao'];}?>  </textarea>
                    
                   
                </div>
                <div class="form-group">
                    <p>Conteudo </p>
                    <textarea name="conteudo" id="summernote">
                     <?php if(!empty($_GET["editar"])){echo $view->getResult()[0]['conteudo'];}?>
                    </textarea>
                </div>
                <div class="form-group">
                    <p>Detalhes / Peso , Tamanho , especificações </p>
                    <textarea name="detalhes" class="form-control">
                     <?php if(!empty($_GET["editar"])){echo $view->getResult()[0]['detalhes'];}?>
                    </textarea>
                </div>
                <input type="hidden" name="acao" value="<?= $acao ?>" />
                  <?php 
                           if(!empty($_GET["editar"])){ ?>
                
                    <input type="hidden" name="id" value="<?= $view->getResult()[0]['id']; ?>" />       
                
                
                           <?php } ?>
                <input type="submit" name="submit" value="cadastrar"  class="btn btn-success" />


            </form>
        </div>


                <?php 
                $read = new Source\Models\Read();
                $read->ExeRead("app_prod", "ORDER BY id DESC");
                $read->getResult();
                foreach ($read->getResult() as $cat) {
                    
                    $imagem = new \Source\Models\Read();
                    $imagem->ExeRead("app_prod_var", "WHERE produto_id = :a", "a={$cat["id"]}");
                    $imagem->getResult();

                ?>
                
               <div class="card"  style="width: 20%; margin-left: : 1%;">
  <img src="<?= CONF_URL_BASE ?>/uploads/<?= $imagem->getResult()[0]["imagem"] ?>" width="100%"  class="card-img-top"  />
  <div class="card-body">
    <h5 class="card-title"><?= $cat["produto"] ?> </h5>
    <p class="card-text"><?= $cat["descricao"] ?></p>
   <p class="btn btn-info"><a href="./produtos&editar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Editar </a></p>
   <p class="btn btn-danger"><a href="./produtos&deletar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Excluir</a></p> 
  </div>
</div>


                <?php } ?>

            </tbody>
        
        </table>



    </div>




