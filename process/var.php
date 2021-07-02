<?php
include '../vendor/autoload.php';

$img = new \Source\Models\Read();
$img->ExeRead("app_prod_var", "WHERE id = :a", "a={$_POST["veiculo"]}");
$img->getResult();

$imagem = $img->getResult()[0]["imagem"];
?>


        <!-- Image -->
        <div class="col-12 col-lg-6">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <a href="" data-toggle="modal" data-target="#productModal">
                        <!--<img class="img-fluid" src="https://dummyimage.com/800x800/55595c/fff" />-->
                        <img class="img-fluid" src="<?=CONF_URL_BASE ?>/uploads/<?=$imagem ?>" style="width:100%;" />
                        <p class="text-center">Zoom</p>
                    </a>
                </div>
            </div>
        </div>

