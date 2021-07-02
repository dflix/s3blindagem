

<div class="container-fluid"> 
    <div class="row"> 
        
        <?php 
        
        if(empty($_GET["editar"])){
            $acao = "cadastrar";
        }else{
            $acao = "editar";
            
            $view = new Source\Models\Read();
            $view->ExeRead("app_prod_categ","WHERE id = :a", "a={$_GET["editar"]}");
            $view->getResult();
        }
        
        $prod = new Source\Core\Produtos();
       $prod->categoria();
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
                <div class="form-group"> 
                    <p> Imagem de Capa </p>
                <input type="file" name="image" class="form-control" />
                </div>
<!--                <div class="form-group"> 
                    <p>Categoria</p>
                    <select name="categoria" class="form-comtrol col-md-12"> 
                        <option value="pagina"> Inserir como Página </option>
                        <?php 
                        
                        $read = new Source\Models\Read();
                        $read->ExeRead("app_prod_categ", "ORDER BY id DESC");
                        $read->getResult();
                        foreach ( $read->getResult() as $categ) {

                        ?>
                        <option value="<?= $categ["slug"] ?>"><?= $categ["categoria"] ?> </option>
                        <?php } ?>
                    </select>
                </div>-->
                <div class="form-group">
                    <p>Categoria </p>
                    <input type="text" name="categoria" class="form-comtrol col-md-12"
                           <?php 
                           if(!empty($_GET["editar"])){
                             echo "value='{$view->getResult()[0]['categoria']}'";  
                           }
                           ?>
                           
                           />
                </div>
                <div class="form-group">
                    <p>Titulo </p>
                    <input type="text" name="titulo" class="form-comtrol col-md-12"
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
                    <textarea name="conteud" id="summernote">
                     <?php if(!empty($_GET["editar"])){echo $view->getResult()[0]['conteudo'];}?>
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
                $read->ExeRead("app_prod_categ", "ORDER BY id DESC");
                $read->getResult();
                foreach ($read->getResult() as $cat) {

                ?>
                
                <div class="card"  style="width: 20%; margin-left: : 1%;">
  <img src="<?= CONF_URL_BASE ?>/uploads/<?= $cat["imagem"] ?>" width="100%"  class="card-img-top"  />
  <div class="card-body">
    <h5 class="card-title"><?= $cat["categoria"] ?> </h5>
    <p class="card-text"><?= $cat["descricao"] ?></p>
   <p class="btn btn-info"><a href="./prod-categ&editar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Editar </a></p>
   <p class="btn btn-danger"><a href="./prod-categ&deletar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Excluir</a></p> 
  </div>
</div>


                <?php } ?>

            </tbody>
        
        </table>



    </div>




