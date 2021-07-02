

<div class="container-fluid"> 

    <h5> Perfil</h5>

    <?php
    $view = new Source\Models\Read();
    $view->ExeRead("usuarios", "WHERE id = :id", "id={$_SESSION["user_id"]}");
    $view->getResult();

    $filtro = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
    if (!empty($filtro["submit"])) {

        $Image = $_FILES["image"];

        // var_dump($_FILES);

        if (!empty($_FILES["image"]["name"])) {
            $retira = "./uploads/{$view->getResult()[0]['foto']}";
            unlink($retira);

            $upload = new Source\Support\Upload("./../uploads/");
            $upload->Image($Image);
            $upload->getResult();

          $filtro["foto"] = $upload->getResult();
        }


        unset($filtro["submit"]);
        unset($filtro["image"]);

        $atualiza = new \Source\Models\Update();
        $atualiza->ExeUpdate("usuarios", $filtro, "WHERE id = :id", "id={$_SESSION["user_id"]}");
        $atualiza->getResult();
        if ($atualiza->getResult()) {
            echo "<div class=\"alert alert-success\" role=\"alert\">
               <h5>Perfil atualizado com sucesso</h5>  </div>";
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
               <h5>Erro ao atualizar perfil</h5>  </div>";
        }
        //var_dump($filtro);
    }
    ?>

    <form class="form" name="perfil" method="post" action="" enctype="multipart/form-data"> 
        <div class="row">
            <div class="col-md-12"> 
                <div class="container">


                    <div class="card">
                        <div class="card-body">
                            <img src="<?= CONF_URL_BASE ?>/uploads/<?= $view->getResult()[0]["foto"] ?>" class="float-left rounded-circle" style="width: 100px; ">
                            <div class="message">
                             

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="file" name="image" class="form-control" />
            </div>

            <div class="col-md-6"> 
                <label>Empresa </label>
                <input type="text" class="form-control" name="empresa" value="<?= $view->getResult()[0]["empresa"] ?>" />
            </div>

            <div class="col-md-6"> 
                <label>Resonsavel </label>
                <input type="text" class="form-control" name="responsavel" value="<?= $view->getResult()[0]["responsavel"] ?>" />
            </div>

            <div class="col-md-6"> 
                <label>CPF  </label>
                <input type="text" class="form-control" name="cpf" value="<?= $view->getResult()[0]["cpf"] ?>" />
            </div>

            <div class="col-md-6"> 
                <label>Telefone </label>
                <input type="text" class="form-control" name="telefone" value="<?= $view->getResult()[0]["telefone"] ?>" />
            </div>


            <div class="col-md-6"> 
                <label>Sexo  </label>
                <input type="text" class="form-control" name="sexo" value="<?= $view->getResult()[0]["sexo"] ?>" />
            </div>

            <div class="col-md-6"> 
                <label>Aniversário </label>
                <input type="date" id="date" class="form-control" name="aniversario" value="<?= $view->getResult()[0]["aniversario"] ?>" />
            </div>

            <div class="col-md-2"> 
                <label>Cep </label>
                <input type="text" class="form-control" name="cep" value="<?= $view->getResult()[0]["cep"] ?>" />
            </div>

            <div class="col-md-8"> 
                <label>Logradouro </label>
                <input type="text" class="form-control" name="logradouro" value="<?= $view->getResult()[0]["logradouro"] ?>" />
            </div>

            <div class="col-md-2"> 
                <label>Numero </label>
                <input type="text" class="form-control" name="numero" value="<?= $view->getResult()[0]["numero"] ?>" />
            </div>

            <div class="col-md-6"> 
                <label>Bairro </label>
                <input type="text" class="form-control" name="bairro" value="<?= $view->getResult()[0]["bairro"] ?>" />
            </div>

            <div class="col-md-4"> 
                <label>Cidade </label>
                <input type="text" class="form-control" name="cidade" value="<?= $view->getResult()[0]["cidade"] ?>" />
            </div>

            <div class="col-md-2"> 
                <label>UF </label>
                <input type="text" class="form-control" name="uf" value="<?= $view->getResult()[0]["uf"] ?>" />
            </div>

            <div class="col-md-12"> 
                </BR>
                <input type="submit" class="btn btn-primary" name="submit" value="ATUALIZAR" />
            </div>

        </div>
    </form>
</div>
