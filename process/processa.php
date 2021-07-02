<?php

include './vendor/autoload.php';

$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$resultado = new \Source\Models\Read();
$resultado->ExeRead("app_prod", "WHERE produto LIKE '%' :prod '%'", "prod={$filtro["palavra"]}");
$resultado->getResult();
if($resultado->getResult()){
    foreach ($resultado->getResult() as $value) {
     ?>
<div class="alert alert-info"> <?=$value["produto"] ?> </br>
<?php 
$var = new \Source\Models\Read();
$var->ExeRead("app_prod_var", "WHERE produto_id = :a", "a={$value["id"]}");
$var->getResult();
if($var->getResult()){
    foreach ($var->getResult() as $var) {

?>
    <img src="<?= CONF_URL_BASE ?>/uploads/<?=$var["imagem"] ?>" width="25%" />
    <p>Valor R$ <?=$var["valor"] ?> </p>
    <p>Tamanho <?=$var["tamanho"] ?> </p>
    <p>Cor <?=$var["cor"] ?> </p>
    <p class="btn btn-info"><a href="./caixa&acao=add&id=<?=$var["id"] ?>&qtd=1" style="text-decoration: none; color:#fff;">Adicionar ao carrinho</a> </p>
    
    <?php ?>
</div>
<?php   }  } }}else{  ?>
       <div class="alert alert-danger"> Produtos não encontrado </div>
   <?php } ?>





 
