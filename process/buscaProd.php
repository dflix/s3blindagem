<?php
include '../vendor/autoload.php';

$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$_SESSION["busca"] = $filtro["palavra"];

$resultado = new \Source\Models\Read();
$resultado->ExeRead("app_prod", "WHERE produto LIKE '%' :pagina '%'", "pagina={$_SESSION["busca"]}");
$resultado->getResult();



if(empty($resultado->getResult())){
    echo "<div class='alert alert-info'>Nenhum produto encontrado </div>";
}else{
?>

<div class="row">
      <div class="col-lg-11 mx-auto" id="blog">
      <!-- FIRST EXAMPLE ===================================-->
      <div class="row py-5">
          
        <?php 
        foreach ($resultado->getResult() as $value) {
            
            $img = new \Source\Models\Read();
                    $img->ExeRead("app_prod_var", "WHERE produto_id = :a", "a={$value["id"]}");
                    $img->getResult();
                    
                    $imagem = $img->getResult()[0]["imagem"];
                    $valor = number_format($img->getResult()[0]["valor"] / 100, 2 , ",", ".");

        ?>  
                   <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="#">
                        <img class="pic-1" src="<?= CONF_URL_BASE ?>/uploads/<?= $imagem ?>">
<!--                        <img class="pic-2" src="http://bestjquery.com/tutorial/product-grid/demo9/images/img-8.jpg">-->
                    </a>
                    <ul class="social">
                        <li><a href="" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                        <li><a href="" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <span class="product-new-label">Sale</span>
                    <span class="product-discount-label">50%</span>
                </div>
                <ul class="rating">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                </ul>
                <div class="product-content">
                    <h3 class="title"><a href="#"><?= $value["produto"] ?></a></h3>
                    <div class="price"><?= $valor ?>
<!--                        <span>$10.00</span>-->
                    </div>
                    <a class="add-to-cart" href="">+ Add To Cart</a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        

      </div>


      <div class="separator my-3"></div>


      </div>
    </div>
  </div>
</div>

