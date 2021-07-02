<div class="container-fluid"> 
            <div class="row"> 
        <div class="col-md-4"> <a href="./?p=categorias-estoque" style="text-decoration: none;color:#fff;"><p class="btn btn-info col-md-12"> Categorias Estoque </p></a> </div>
        <div class="col-md-4"> <a href="./?p=estoque" style="text-decoration: none;color:#fff;"><p class="btn btn-info col-md-12"> Cadastrar / Editar Estoque </p></a> </div>
    </div>
    <h3> Categorias de  Estoque </h3>
    <?php 
    if(!empty($_GET["editar"])){
        
        $ver = new \Source\Models\Read();
        $ver->ExeRead("app_categ_estoque", "WHERE user_id = :a", "a={$_SESSION["user_id"]}");
        $ver->getResult();
        
        $categ = new \Source\Functions\CategoriaEstoque();
        $categ->editar();
        
       // echo "editar";
        
    }elseif (!empty($_GET["deletar"])) {
        $categ = new Source\Core\CategoriaEstoque();
        $categ->deletar();
    }else{
        $categ = new Source\Core\CategoriaEstoque();
        $categ->cadastra();
    }
    
    ?>
    <form action="" method="post"> 
        <div class="col-md-12"> 
            <label>Estoque </label>
            <input type="text" name="estoque" class="form-control" <?php 
            if(!empty($_GET["editar"])){
                echo "value='{$ver->getResult()[0]["categoria"]}'";
            }
            ?> />
        </div>
        <div class="col-md-12"> 
            <?php 
            if(!empty($_GET["editar"])){
                echo "<input type='hidden' name='id' value='{$ver->getResult()[0]["id"]}' />";
            }
            ?>
            <input type="submit"  class="btn btn-success" value="CADASTRAR" />
        </div>
    
    </form>
    
    
    <table class="table"> 
        <thead> 
            <tr> 
                <th>Categoria </th>
                <th>Editar </th>
                <th>Deletar </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $ver = new \Source\Models\Read();
            $ver->ExeRead("app_categ_estoque", "ORDER BY id DESC");
            $ver->getResult();
            foreach ($ver->getResult() as $categ) {

            ?>
            <tr> 
                <td><?= $categ["categoria"] ?> </td>
  <td> <a href="?p=categorias-estoque&editar=<?= $categ["id"] ?>"><i class="fas fa-edit"></i></a></td>
  <td> <a href="?p=categorias-estoque&deletar=<?= $categ["id"] ?>" style="color:red; text-decoration: none;"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
