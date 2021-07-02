<?php
include './vendor/autoload.php';

$filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$resultado = new \Source\Models\Read();
$resultado->ExeRead("app_estoque", "WHERE produto LIKE '%' :produto '%'", "produto={$filtro["palavra"]}");
$resultado->getResult();
if ($resultado->getResult()) {
    foreach ($resultado->getResult() as $value) {
        ?>
        <div class="alert alert-info"> <?= $value["produto"] ?> </br>
            <?php
            ?>
            <img src="<?= CONF_URL_BASE ?>/uploads/<?= $value["imagem"] ?>" width="25%" />
            <p>Valor R$ <?= $value["preco_venda"] ?> </p>
            <p>QTD <?= $value["qtd"] ?> </p>
            
          
                        <form action="" method="post" class="form" > 
            <div class="col-md-3"> 
                <label>Qtd </label>
                <input type="text" name="qtd" class="form-control" />
            </div>
            <div class="col-md-3"> 
                <label>Produtos ou Serviços </label>
                <input type="text" name="descricao" placeholder="Descrição Produto ou Serviço" value="<?= $value["produto"] ?>" class="form-control" />
            </div>
            <div class="col-md-3"> 
                <label>Valor Unitário </label>
                <input type="text" name="valor_unit" id="valor" value=" <?= $value["preco_venda"] ?>"  class="form-control" />
            </div>
            <div class="col-md-3">
                <input type="hidden" name="tipo" value="estoque" />
                <input type="hidden" name="id" value="<?= $value["id"] ?>" />
                <input type="submit" value="cadastrar" class="btn btn-success" />
                </br> </br>
            </div>
        
            
            </form>
            
            </br> </br> </br>

            <!--<p class="btn btn-info"><a href="./?p=caixa&acao=add&id=<?= $value["id"] ?>&qtd=1" style="text-decoration: none; color:#fff;">Adicionar ao carrinho</a> </p>-->

        <?php ?>
        </div>
        <?php }
    } else { ?>
    <div class="alert alert-danger"> Produtos não encontrado </div>
<?php } ?>






