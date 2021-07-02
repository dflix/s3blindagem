<?php

namespace Source\Core;

class Estoque {

    private $filtro;

    public function __construct() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->filtro = $filtro;
    }

    /**
     * função cadastra
     */
    public function cadadstra() {

        if (!empty($this->filtro)) {

            if (!empty($_FILES["image"])) {
                $Image = $_FILES["image"];

                $upload = new \Source\Support\Upload("./uploads/");
                $upload->Image($Image);
                $upload->getResult();
                if ($upload->getResult()) {
                    $imagem = $upload->getResult();
                    echo "<div class='alert alert-success'> Arquivo enviado com Sucesso </div>";
                } else {
                    $imagem = null;
                   // echo "<div class='alert alert-danger'> Erro </div>";
                }
            }

            $this->filtro["categoria"] = trim($this->filtro["categoria"]);
            $this->filtro["preco_compra"] = str_replace(".", "", $this->filtro["preco_compra"]);
            $this->filtro["preco_compra"] = str_replace(",", "", $this->filtro["preco_compra"]);
            $this->filtro["preco_compra"] = str_replace("R", "", $this->filtro["preco_compra"]);
            $this->filtro["preco_compra"] = str_replace("$", "", $this->filtro["preco_compra"]);

            $this->filtro["preco_venda"] = str_replace(".", "", $this->filtro["preco_venda"]);
            $this->filtro["preco_venda"] = str_replace(",", "", $this->filtro["preco_venda"]);
            $this->filtro["preco_venda"] = str_replace("R", "", $this->filtro["preco_venda"]);
            $this->filtro["preco_venda"] = str_replace("$", "", $this->filtro["preco_venda"]);

            $Dados = [
                "user_id" => $_SESSION["user_id"],
                "loja" => $this->filtro["loja"],
                "categoria" => $this->filtro["categoria"],
                "imagem" => $imagem,
                "produto" => $this->filtro["produto"],
                "preco_compra" => $this->filtro["preco_compra"],
                "preco_venda" => $this->filtro["preco_venda"],
                "qtd" => $this->filtro["qtd"]
            ];
            
           // var_dump($Dados);

            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_estoque", $Dados);
            $cad->getResult();
            if ($cad->getResult()) {
                echo "<div class='alert alert-success'> Produto cadastrado com sucesso</div>";
            } else {
                echo "<div class='alert alert-danger'> Erro ao cadastrar produto</div>";
            }
            // var_dump($this->filtro, $Image , $Dados);
        }
    }

    public function editar() {

        if (!empty($this->filtro)) {

            if (!empty($_FILES["image"])) {
                $Image = $_FILES["image"];

                $upload = new \Source\Support\Upload("./uploads/");
                $upload->Image($Image);
                $upload->getResult();
                if ($upload->getResult()) {
                    $imagem = $upload->getResult();
                    echo "<div class='alert alert-success'> Arquivo enviado com Sucesso </div>";
                } else {
                    $viewImg = new \Source\Models\Read();
                    $viewImg->ExeRead("app_estoque", "WHERE id = :a", "a={$_GET["editar"]}");
                    $viewImg->getResult();

                    $imagem = $viewImg->getResult()[0]["imagem"];
                    echo "<div class='alert alert-danger'> Erro </div>";
                }
            }

            $this->filtro["categoria"] = trim($this->filtro["categoria"]);
            $this->filtro["preco_compra"] = str_replace(".", "", $this->filtro["preco_compra"]);
            $this->filtro["preco_compra"] = str_replace(",", "", $this->filtro["preco_compra"]);
            $this->filtro["preco_compra"] = str_replace("R", "", $this->filtro["preco_compra"]);
            $this->filtro["preco_compra"] = str_replace("$", "", $this->filtro["preco_compra"]);

            $this->filtro["preco_venda"] = str_replace(".", "", $this->filtro["preco_venda"]);
            $this->filtro["preco_venda"] = str_replace(",", "", $this->filtro["preco_venda"]);
            $this->filtro["preco_venda"] = str_replace("R", "", $this->filtro["preco_venda"]);
            $this->filtro["preco_venda"] = str_replace("$", "", $this->filtro["preco_venda"]);

            $Dados = [
                "user_id" => $_SESSION["user_id"],
                "loja" => $this->filtro["loja"],
                "categoria" => $this->filtro["categoria"],
                "imagem" => $imagem,
                "produto" => $this->filtro["produto"],
                "preco_compra" => $this->filtro["preco_compra"],
                "preco_venda" => $this->filtro["preco_venda"],
                "qtd" => $this->filtro["qtd"]
            ];

            $up = new \Source\Models\Update();
            $up->ExeUpdate("app_estoque", $Dados, "WHERE id = :a", "a={$_GET["editar"]}");
            $up->getResult();
            if ($up->getResult()) {
                echo "<div class='alert alert-success'> Produto atualizado com sucesso </div>";
            } else {
                echo "<div class='alert alert-danger'> Erro ao editar produto </div>";
            }


           // var_dump($this->filtro);
        }
    }
    
    public function deletar() {
        
        //verifica se tem imagem e deleta do servidor
        $ver = new \Source\Models\Read();
        $ver->ExeRead("app_estoque", "WHERE id = :a", "a={$_GET["deletar"]}");
        $ver->getResult();
        
        if(!empty($ver->getResult()[0]["imagem"])){
            $filename = "./uploads/" . $ver->getResult()[0]["imagem"];
            unlink($filename);
        }
        
        $del = new \Source\Models\Delete();
        $del->ExeDelete("app_estoque", "WHERE id = :a", "a={$_GET["deletar"]}");
        $del->getResult();
        if($del->getResult()){
            echo "<div class='alert alert-success'> Produto deletado com sucesso </div>";
        }else{
            echo "<div class='alert alert-danger'> erro ao deldetar </div>"; 
        }
        
      //  var_dump($_GET["deletar"]);
        
    }

}
