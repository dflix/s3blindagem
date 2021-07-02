<?php

include '../../vendor/autoload.php';

$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//var_dump($filtro);



                $read = new Source\Models\Read();
                $read->ExeRead("app_post", "WHERE pagina LIKE '%' :p '%'" , "p={$filtro["palavra"]}");
                $read->getResult();
                if(empty($read->getResult())){
                    echo "<div class='alert alert-danger col-md-12'>Sua busca por <b>{$filtro['palavra']}</b> não retornou resultados </div>";
                }else{
                
                foreach ($read->getResult() as $cat) {

                ?>
                
                <div class="card"  style="width: 20%; margin-left: : 1%;">
  <img src="<?= CONF_URL_BASE ?>/uploads/<?= $cat["imagem"] ?>" width="100%"  class="card-img-top"  />
  <div class="card-body">
    <h5 class="card-title"><?= $cat["pagina"] ?> </h5>
    <p class="card-text"><?= $cat["description"] ?></p>
   <p class="btn btn-info"><a href="./?p=post&editar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Editar </a></p>
   <p class="btn btn-danger"><a href="./?p=post&deletar=<?= $cat["id"] ?>" style="text-decoration: none;color:#fff;">Excluir</a></p> 
  </div>
</div>


                <?php } } ?>


