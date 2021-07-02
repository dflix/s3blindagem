<?php
include '../vendor/autoload.php';

$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$_SESSION["busca"] = $filtro["palavra"];

$resultado = new \Source\Models\Read();
$resultado->ExeRead("app_post", "WHERE pagina LIKE '%' :pagina '%'", "pagina={$_SESSION["busca"]}");
$resultado->getResult();



if(empty($resultado->getResult())){
    echo "<div class='alert alert-info'>Nenhum resultado encontrado </div>";
}else{
?>

<div class="row">
      <div class="col-lg-11 mx-auto" id="blog">
      <!-- FIRST EXAMPLE ===================================-->
      <div class="row py-5">
          
        <?php 
        foreach ($resultado->getResult() as $value) {

        ?>  
        <div class="col-lg-4">
          <figure class="rounded p-3 bg-white shadow-sm">
              <img src="<?=CONF_URL_BASE ?>/uploads/<?= $value["imagem"] ?>" alt="" class="w-100 card-img-top">
            <figcaption class="p-4 card-img-bottom">
              <h2 class="h5 font-weight-bold mb-2 font-italic"><?= $value["pagina"] ?></h2>
              <p class="mb-0 text-small text-muted font-italic"><?= $value["description"] ?></p>
              <button class="btn btn-info"><a href="<?=CONF_URL_BASE ?>/<?= $value["slug"] ?>" style="text-decoration: none; color:#fff;"> Saiba Mais ... </a> </button>
              
            </figcaption>
          </figure>
        </div>
        <?php } ?>
        <?php } ?>
        

      </div>


      <div class="separator my-3"></div>


      </div>
    </div>
  </div>
</div>

