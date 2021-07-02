

<div class="container-fluid"> 
    <div class="row"> 
        
        <?php 

            $view = new Source\Models\Read();
            $view->ExeRead("app_post_home","WHERE id = :a", "a=1");
            $view->getResult();
   
        $categ = new Source\Core\Post();
       $categ->postHome();
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
                    <p>Titulo </p>
                    <input type="text" name="title" value="<?= $view->getResult()[0]['title'] ?>" class="form-comtrol col-md-12"
                       
                           />
                </div>
                <div class="form-group">
                    <p>Descrição </p>
                    <textarea name="description" class="form-control">  <?php echo $view->getResult()[0]['description']; ?>  </textarea>
                    
                   
                </div>
                <div class="form-group">
                    <p>Conteudo </p>
                    <textarea name="content" id="summernote">
                     <?php echo $view->getResult()[0]['content']; ?>
                    </textarea>
                </div>
                <div class="form-group"> 
                    <p>Video </p>
                    <input type="text" class="form-control" name="video" value=" <?php echo $view->getResult()[0]['video']; ?>" />
                </div>
                <input type="hidden" name="id" value="1" />   
  
                <input type="submit" name="submit" value="cadastrar"  class="btn btn-success" />


            </form>
        </div>



            </tbody>
        
        </table>



    </div>




