<?php

namespace Source\Core;

class Contratos {

    private $filtro;

    public function __construct() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->filtro = $filtro;
    }

    public function cadastra() {

        if ($this->filtro["metodo"] == "cadastrar") {

            $Dados = [
            "user_id" => $_SESSION["user_id"],
            "nome" => $this->filtro["nome"],
            "termos" => $this->filtro["termos"]
            ];
            
            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_contratos", $Dados);
            $cad->getResult();
            if($cad->getResult()){
                echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Contrato cadastrado com sucesso  </h5>  </div>";
            }else{
                echo "<div class=\"alert alert-danger col-md-12\" role=\"alert\">
                <h5>Erro ao cadastrar Contrato </h5>  </div>";
            }
            
           // var_dump($this->filtro , $Dados);
        }
    }
    
    public function editar() {
        
        if($this->filtro["metodo"] == "editar"){
            
            $Dados = [
                "nome" => $this->filtro["nome"],
                "termos" => $this->filtro["termos"]
            ];
            $update = new \Source\Models\Update();
            $update->ExeUpdate("app_contratos", $Dados, "WHERE id = :id", "id={$this->filtro["id"]}");
            $update->getResult();
            if($update->getResult()){
                 echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Contrato editado com sucesso  </h5>  </div>";
            }else{
                 echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Erro ao atualizar contrato  </h5>  </div>";
            }

        }
        
    }
    
    public function delete() {
        if(!empty($_GET["deletar"])){
            
            $delete = new \Source\Models\Delete();
            $delete->ExeDelete("app_contratos", "WHERE id = :id", "id={$_GET["deletar"]}");
            $delete->getResult();
            if($delete->getResult()){
                 echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Contrato deletado com sucesso  </h5>  </div>";
            }else{
                 echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Erro ao deletar contrato  </h5>  </div>";
            }
        }
    }

}
