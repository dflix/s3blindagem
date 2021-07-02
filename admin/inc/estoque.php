<div class="container-fluid"> 
            <div class="row"> 
        <div class="col-md-4"> <a href="./?p=categorias-estoque" style="text-decoration: none;color:#fff;"><p class="btn btn-info col-md-12"> Categorias Estoque </p></a> </div>
        <div class="col-md-4"> <a href="./?p=estoque" style="text-decoration: none;color:#fff;"><p class="btn btn-info col-md-12"> Cadastrar / Editar Estoque </p></a> </div>
    </div>
    <h3 class="text-white"> Estoque </h3>
    <?php 
     if(!empty($_GET["editar"])){
         
         $ver = new Source\Models\Read();
         $ver->ExeRead("app_estoque", "WHERE id = :a", "a={$_GET["editar"]}");
         $ver->getResult();
         
        // echo "editar";
         $edit = new \Source\Core\Estoque();
         $edit->editar();
         
     }elseif(!empty ($_GET["deletar"])){
         
       //  echo "deletar";
         
         $del = new \Source\Core\Estoque();
         $del->deletar();
         
     }else{
         
         $cad = new \Source\Core\Estoque();
         $cad->cadadstra();
         //echo "cadastrar";
         
     }
    ?>
    <div class="row"> 
        <div class="col-md-6">
    <form method="post" action="" enctype="multipart/form-data"> 
        <div class="form-group"> 
            <label> Loja </label>
            <select name="loja" class="form-control-range"> 

                <?php 
                $loja = new Source\Models\Read();
                $loja->ExeRead("app_carterias", "WHERE user_id = :a", "a={$_SESSION["user_id"]}");
                $loja->getResult();
                foreach ($loja->getResult() as $lojas) {
                    
                ?>
                                 <?php 
                if(!empty($_GET["editar"])){
                    echo "<option value='{$ver->getResult()[0]["wallet"]}'> {$ver->getResult()[0]["wallet"]} </option>";
                }
                ?>
                <option value="<?=$lojas["wallet"] ?>"><?=$lojas["wallet"] ?> </option>
                <?php } ?>
            </select>
        </div>
            
        <div class="form-group">
            <label> Categoria</label>
            <select class="form-control-range" name="categoria"> 
                <?php 
                if(!empty($_GET["editar"])){
                    echo "<option value='{$ver->getResult()[0]["categoria"]}'> {$ver->getResult()[0]["categoria"]} </option>";
                }
                ?>
            <option > Selecione a categoria </option>
            <?php 
            $cat = new \Source\Models\Read();
            $cat->ExeRead("app_categ_estoque", "ORDER BY id DESC");
            $cat->getResult();
            foreach ($cat->getResult() as $vcat) {

            ?>
            <option value=" <?= $vcat["categoria"] ?>"> <?= $vcat["categoria"] ?></option>
            <?php } ?>
        </select>
        </div>
        
        <div class="form-group"> 
                    <p> Imagem Produto </p>
                <input type="file" name="image" class="form-control" />
                </div>
       
        <div class="form-group"> 
            <label>Produto </label>
            <input type="text" class="form-control" name="produto" <?php 
            if(!empty($_GET["editar"])){
                echo "value='{$ver->getResult()[0]["produto"]}'";
            }
            ?> />
        </div>
        <div class="form-group"> 
            <label>Quantidade </label>
            <input type="text" class="form-control" name="qtd" <?php 
            if(!empty($_GET["editar"])){
                echo "value='{$ver->getResult()[0]["qtd"]}'";
            }
            ?>/>
        </div>
        <div class="form-group"> 
            <label>Preço Compra </label>
            <input type="text" class="form-control" name="preco_compra" <?php 
            if(!empty($_GET["editar"])){
                $preco_compra = number_format($ver->getResult()[0]["preco_compra"] / 100, 2,",", ".");
                echo "value='{$preco_compra}'";
            }
            ?> />
        </div>
        <div class="form-group"> 
            <label>Preço Venda </label>
            <input type="text" class="form-control" name="preco_venda" <?php 
            if(!empty($_GET["editar"])){
                $preco_venda = number_format($ver->getResult()[0]["preco_venda"] / 100, 2,",", ".");
                echo "value='{$preco_venda}'";
            }
            ?> />
        </div>
        <div class="form-group"> 
            
            <input type="submit" class="btn btn-success" value="CADASTRAR" />
        </div>
    
    </form>
        </div>
        
        <div class="col-md-6"> 
            <h3> Estoque </h3>
            
              <form method="post" id="form-pesquisa" action=""> 
            <label>Pesquisa </label>
            <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Digite sua busca" />
        </form>

        <div class="resultado">  </div>


        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

        <script type="text/javascript">

            $(function () {
                $("#pesquisa").keyup(function () {
                    //Recuperar o valor do campo
                    var pesquisa = $(this).val();

                    $(".blog").hide();
                    //Verificar se há algo digitado
                    if (pesquisa != '') {
                        var dados = {
                            palavra: pesquisa
                        }
                        $.post("<?= CONF_URL_BASE ?>/assets/functions/estoque.php", dados, function (retorna) {
                            //Mostra dentro da ul os resultado obtidos 
                            $(".resultado").html(retorna);
                        });
                    }
                });
            });

        </script>
            <table class="table blog"> 
                <thead> 
                    <tr> 
                        <th> Imagem</th>
                        <th> Loja</th>
                        <th> Produto</th>
                        <th> Categoria</th>
                        <th> QTD</th>
                        <th> Preço</th>
                        <th> Editar</th>
                        <th> Excluir <img src="" width="100"</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php 
                    $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
                    $pager = new Source\Support\Pager("?p=estoque&atual=" , "Primeiro" , "Ultimo" , "1");
                    $pager->ExePager($atual, 5);
                    
                    $exibe = new Source\Models\Read();
                    $exibe->ExeRead("app_estoque", "WHERE user_id = :a LIMIT :limit OFFSET :offset", "a={$_SESSION["user_id"]}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    $exibe->getResult();
                    foreach ($exibe->getResult() as $value) {

                    ?>
                    <tr> 
                        <td> <?php 
                        $urlbase = CONF_URL_BASE;
                        if(!empty($value["imagem"])){
                          echo "<img src='./uploads/{$value["imagem"]}' width='100'  />";  
                        }else{
                           echo "<img src='{$urlbase}/assets/imagens/produto-sem-imagem.jpg' width='100' />";    
                        }
                        
                        ?></td>
                        <td> <?= $value["loja"] ?></td>
                        <td> <?= $value["produto"] ?></td>
                        <td> <b><?= $value["categoria"] ?></b></td>
                        <td> <?= $value["qtd"] ?></td>
                        <td>R$ <?= number_format($value["preco_venda"] / 100 , 2 , "." , ","); ?></td>
                        <td> <a href="?p=estoque&editar=<?= $value["id"] ?>"><i class="fas fa-edit"></i></a></td>
                        <td><a href="?p=estoque&deletar=<?= $value["id"] ?>" style="text-decoration: none; color: red;"> <i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <?php 
            $pager->ExePaginator("app_estoque");
            echo $pager->getPaginator();

            ?>
        </div>
        
    </div>
</div>
