
<div class="container-fluid"> 

    <h1 class="header-ul"> Itens do Orçamento</h1>

    <?php
    
    
        if (!empty($_GET["excluir"])) {

            $deletar = new \Source\Models\Delete();
            $deletar->ExeDelete("app_orcamento_itens", "WHERE id = :a", "a={$_GET["excluir"]}");
            $deletar->getResult();
            if($deletar->getResult()){
                echo "<div class='alert alert-success'> Item removido com sucesso</div>";
            }else{
               echo "<div class='alert alert-danger'> erro ao deletar item</div>"; 
            }
            
            
        } 
    
    if (!empty($_GET["editar"])) {

        $os = new Source\Models\Read();
        $os->ExeRead("app_orcamento", "WHERE orcamento_id = :a AND user_id = :b", "a={$_GET["editar"]}&b={$_SESSION["user_id"]}");
        $os->getResult();

        $_SESSION["orcamento"] = $_GET["editar"];
        //$_SESSION["os"] = $ver->getResult()[0]["os"];
        //  $_SESSION["loja"] = $ver->getResult()[0]["loja"];

        $carrinho = new \Source\Core\CarrinhoOrcamento();
        $carrinho->carrinho();

        // var_dump($_SESSION);
    } else {



            $_SESSION["orcamento"] = $_GET["editar"];

            $carrinho = new Source\Core\CarrinhoOrcamento();
            $carrinho->carrinho();

            $os = new Source\Models\Read();
            $os->ExeRead("app_orcamento", "WHERE orcamento_id = :a AND user_id = :b", "a={$_GET["editar"]}&b={$_SESSION["user_id"]}");
            $os->getResult();

            var_dump($_SESSION);
       
    }
    ?>

    <div class="row"> 
        <div class="col-md-4"> <label>Orçamento </label> </br> <?= str_pad($os->getResult()[0]["orcamento_id"], 9, "0", STR_PAD_LEFT) ?> </div>
        <div class="col-md-4"> <label>Veiculo </label> </br><?= $os->getResult()[0]["tipo"] ?> </div>
        <div class="col-md-4"> <label>Marca </label> </br><?= $os->getResult()[0]["marca"] ?> </div>
        <div class="col-md-4"> <label>Modelo </label> </br> <?= $os->getResult()[0]["modelo"] ?> </div>
        <div class="col-md-4"> <label>Ano </label> </br><?= $os->getResult()[0]["ano"] ?> </div>
        <div class="col-md-4"> <label>Placa </label> </br><?= $os->getResult()[0]["placa"] ?> </div>
        <div class="col-md-4"> <label>Cliente </label> </br><?= $os->getResult()[0]["cliente"] ?> </div>
        <div class="col-md-4"> <label>Telefone </label> </br><?= $os->getResult()[0]["telefone"] ?> </div>


        <div class="col-md-6"> 



            <h3> Itens do Orçamento </h3>

            <form method="post" id="form-pesquisa" action=""> 
                <label>Pesquisa Produto em Estoque </label>
                <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Digite o produto" />
            </form>
            <div class="resultado"> </div>

            <h3> Cadastrar Itens Manual </h3>
            <form action="" method="post"> 
                <div class="form-group"> 
                    <label> Item </label>
                    <input type="text" class="form-control" name="item" />
                </div>
                <div class="form-group"> 
                    <label> quantidade </label>
                    <input type="text" class="form-control" name="qtd" />
                </div>
                <div class="form-group"> 
                    <label> Valor unitario </label>
                    <input type="text" class="form-control" name="valor_unit" />
                </div>
                <div class="form-group"> 
                    <label> Valor Total </label>
                    <input type="text" class="form-control" name="valor_total" />
                </div>
                <div class="form-group"> 

                    <input type="hidden" name="acao" value="manual"/>
                    <input type="submit" class="btn btn-success" value="CADASTRAR"/>
                </div>

            </form> 

        </div>


        <div class="col-md-6"> 
            <h3> Itens do Orçamento </h3>

            <table class="table"> 
                <thead> 
                    <tr> 
                        <th>Item </th>
                        <th>QTD </th>
                        <th>Preço Unit </th>
                        <th>Preço Total </th>
                        <th>Remover </th>
                    </tr>
                </thead>
                <tbody> 
<?php
$total = 0;
$ver = new Source\Models\Read();
$ver->ExeRead("app_orcamento_itens", "WHERE user_id = :a AND orcamento_id = :b", "a={$_SESSION["user_id"]}&b={$_SESSION["orcamento"]}");
$ver->getResult();
if (empty($ver->getResult())) {
    echo "<tr><td>Não existe produtos ou serviços cadastrados nessa OS</td></tr>";
} else {
    $total = 0;
    foreach ($ver->getResult() as $vos) {
        $total += $vos["valor_total"];
        ?>
                            <tr> 
                                <td><?= $vos["item"] ?> </td>
                                <td><?= $vos["qtd"] ?> </td>
                                <td>R$ <?= number_format($vos["valor_unit"] / 100, 2, ",", "."); ?> </td>
                                <td>R$ <?= number_format($vos["valor_total"] / 100, 2, ",", "."); ?> </td>
                                <td> <a href="./?p=orcamento-itens&editar=<?= $_GET["editar"] ?>&excluir=<?= $vos["id"] ?>" style="text-decoration: none; color:red;"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
    <?php }
}
?>

                    <tr> 
                        <td> </td>
                        <td> </td>
                        <td>Total Compra </td>
                        <td>R$ <?= number_format($total / 100, 2, ",", "."); ?> </td>
                        <td> </td>
                    </tr>

                </tbody>

            </table>

            <a href="./?p=orcamento-pagamento&editar=<?= $_GET["editar"] ?>"> <p class="btn btn-success">  Proseguir com Orçamento</p> </a>
        </div>


    </div>



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
                $.post("<?= CONF_URL_BASE ?>/assets/functions/os.php", dados, function (retorna) {
                    //Mostra dentro da ul os resultado obtidos 
                    $(".resultado").html(retorna);
                });
            }
        });
    });

</script>

