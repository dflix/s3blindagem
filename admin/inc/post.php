

<div class="container-fluid"> 
    <div class="row"> 
        
        <?php 
        
        if(empty($_GET["editar"])){
            $acao = "cadastrar";
        }else{
            $acao = "editar";
            
            $view = new Source\Models\Read();
            $view->ExeRead("app_post","WHERE id = :a", "a={$_GET["editar"]}");
            $view->getResult();
        }
        
        $categ = new Source\Core\Post();
       $categ->post();
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
                    <p>Categoria</p>
                    <select name="categoria" class="form-comtrol col-md-12"> 
                        <option value="pagina"> Inserir como Página </option>
                        <?php 
                        
                        $read = new Source\Models\Read();
                        $read->ExeRead("app_post_categ", "ORDER BY id DESC");
                        $read->getResult();
                        foreach ( $read->getResult() as $categ) {

                        ?>
                        <option value="<?= $categ["slug"] ?>"><?= $categ["categoria"] ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <p>Pagina </p>
                    <input type="text" name="pagina" class="form-comtrol col-md-12"
                           <?php 
                           if(!empty($_GET["editar"])){
                             echo "value='{$view->getResult()[0]['pagina']}'";  
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
                                $.post("<?= CONF_URL_BASE ?>/admin/processa/buscapost.php", dados, function (retorna) {
                                    //Mostra dentro da ul os resultado obtidos 
                                    $(".resultado").html(retorna);
                                });
                            }
                        });
                    });

        </script>

        
        <div class="col-md-12 border-bottom">
        
                    <form method="post" id="form-pesquisa" action=""> 
                <label>Pesquisa Ppaginas </label>
                <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Digite o produto" />
            </form>
            <div class="resultado"> </div>
        
        </div>
        
                   



            </tbody>
        
        </table>



    </div>




