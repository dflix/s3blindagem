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
        $prod->variacao();
        
       // var_dump($_SESSION);
        ?>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/prod-categ" style="text-decoration: none;color:#fff;">  <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Categorias</div> </a>
        </div>

        <div class="col-md-6" style="margin-top: 10px;"> 
            <a href="<?= CONF_URL_APP ?>/produtos" style="text-decoration: none;color:#fff;">   <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Produtos</div> </a>
        </div>
    </div>
    <div class="row"> 
        
        <?php 
        echo "Produto" . $_SESSION["produto"];
        $prod = new \Source\Models\Read();
        $prod->ExeRead("app_prod", "WHERE id = :a", "a={$_SESSION["produto"]}");
        $prod->getResult();
        ?>
        
        

        <div class="col-md-12"> 
            
            <p> <b>Produto</b> <?= $prod->getResult()[0]["produto"] ?> </p>
            
            <form name="form" action="" method="post" enctype="multipart/form-data" >
                <div class="form-group"> 
                    <p> Imagem do Produto </p>
                <input type="file" name="image" class="form-control" />
                </div>
<div class="form-group"> 
 <p class="border-bottom">Tamanho</p>
  <input type="text" name="tamanho" class="form-control col-md-12" />
</div>
<div class="form-group"> 
 <p class="border-bottom">Cor</p>
  <input type="text" name="cor" class="form-control col-md-12" />
</div>
<div class="form-group"> 
 <p class="border-bottom">Qtd</p>
  <input type="text" name="qtd" class="form-control col-md-12" />
</div>
<div class="form-group"> 
 <p class="border-bottom">Valor</p>
 <input type="text" name="valor" id="valor" class="form-control col-md-12" />
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
                $read->ExeRead("app_prod_var", "WHERE produto_id = :a" , "a={$_SESSION["produto"]}");
                $read->getResult();
                foreach ($read->getResult() as $cat) {

                ?>
                
                <div class="card"  style="width: 20%; margin-left: : 1%;">
  <img src="<?= CONF_URL_BASE ?>/uploads/<?= $cat["imagem"] ?>" width="100%"  class="card-img-top"  />
  <div class="card-body">
    <h5 class="card-title"><b>Estoque</b> <?= $cat["qtd"] ?> </h5>
    <p class="card-text">R$ <?= number_format($cat["valor"] / 100, 2, "," , ".") ?></p>
    <p class="card-text"><b>Tamanho </b> <?= $cat["tamanho"] ?></p>
    <p class="card-text"><b>Cor </b> <?= $cat["cor"] ?></p>
   <!--<p class="btn btn-info"><a href="./produtos&editar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Editar </a></p>-->
   <p class="btn btn-danger"><a href="./variacao&deletar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Excluir</a></p> 
  </div>
</div>


                <?php } ?>

            </tbody>
        
        </table>



    </div>




