

<div class="container-fluid"> 
    <div class="row"> 
        
        <?php 
        
        if(empty($_GET["editar"])){
            $acao = "cadastrar";
        }else{
            $acao = "editar";
            
            $view = new Source\Models\Read();
            $view->ExeRead("app_post_categ","WHERE id = :a", "a={$_GET["editar"]}");
            $view->getResult();
        }
        
        $categ = new Source\Core\Post();
        $categ->categoria();
        ?>

        <div class="col-md-4" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=post-categ" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Categorias</div> </a>
        </div>

        <div class="col-md-4" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=post" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Post</div> </a>
        </div>
        
        
        <div class="col-md-4" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/?p=post-home" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Home</div> </a>
        </div>
    </div>
    <div class="row"> 

        <div class="col-md-12"> 
            <form name="form" action="" method="post" enctype="multipart/form-data" >
                <div class="form-group"> 
                    <p> Imagem de Capa </p>
                <input type="file" name="image" class="form-control" />
                </div>
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
                    <input type="text" name="title" class="form-comtrol col-md-12"
                            <?php 
                           if(!empty($_GET["editar"])){
                             echo "value='{$view->getResult()[0]['title']}'";  
                           }
                           ?>
                           />
                </div>
                <div class="form-group">
                    <p>Descrição </p>
                    <textarea name="description" class="form-control">  <?php if(!empty($_GET["editar"])){echo $view->getResult()[0]['description'];}?>  </textarea>
                    
                   
                </div>
                <div class="form-group">
                    <p>Conteudo </p>
                    <textarea name="content" id="summernote">
                     <?php if(!empty($_GET["editar"])){echo $view->getResult()[0]['content'];}?>
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


        <table class="table table-responsive">
            <thead> 
                <tr> 
                    <th>Imagem </th>
                    <th>Categoria </th>
                    <th>Descrição </th>
                    <th>Editar </th>
                    <th>Excluir </th>
                </tr>
            </thead>
            
            <tbody> 
                <?php 
                $read = new Source\Models\Read();
                $read->ExeRead("app_post_categ", "ORDER BY id DESC");
                $read->getResult();
                foreach ($read->getResult() as $cat) {

                ?>
                <tr> 
                    <td><img src="<?= CONF_URL_BASE ?>/uploads/<?= $cat["imagem"] ?>" width="100%" /> </td>
                    <td><?= $cat["categoria"] ?> </td>
                    <td><?= $cat["description"] ?> </td>
                    <td><p class="btn btn-info"><a href="./post-categ&editar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Editar </a></p> </td>
                    <td><p class="btn btn-danger"><a href="./post-categ&deletar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Excluir</a></p> </td>
                </tr>
                <?php } ?>

            </tbody>
        
        </table>



    </div>




