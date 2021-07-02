<?php


namespace Source\Core;

class Orcamento {

    private $filtro;

    public function __construct() {

        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->filtro = $filtro;
    }

    public function cadastra() {

        if (!empty($this->filtro["telefone"])) {
            
           // var_dump($this->filtro);

            $this->filtro["telefone"] = str_replace("(", "", $this->filtro["telefone"]);
            $this->filtro["telefone"] = str_replace(")", "", $this->filtro["telefone"]);
            $this->filtro["telefone"] = str_replace("-", "", $this->filtro["telefone"]);
            $this->filtro["telefone"] = str_replace(" ", "", $this->filtro["telefone"]);

            $this->filtro["marca1"] = explode("|", $this->filtro["marca1"]);
            $this->filtro["modelo1"] = explode("|", $this->filtro["modelo1"]);
            $this->filtro["ano1"] = explode("|", $this->filtro["ano1"]);
//            
            //verifica a ordem de serviços
            $read = new \Source\Models\Read();
            $read->ExeRead("app_orcamento", "ORDER BY id DESC" );
            $read->getResult();
            if($read->getResult()){
                $orcamento_id = $read->getResult()[0]["orcamento_id"] + 1 ;
            }else{
                $orcamento_id = 1;
            }

            $Dados = [
                "user_id" => $_SESSION["user_id"],
                "cliente" => $this->filtro["cliente"],
                "telefone" => $this->filtro["telefone"],
                "orcamento_id" => $orcamento_id,
                "tipo" => $this->filtro["veiculo"],
                "marca" => $this->filtro["marca1"][0],
                "modelo" => $this->filtro["modelo1"][3],
                "ano" => $this->filtro["ano1"][4],
                "valor" => $this->filtro["valor"],
                "cor" => $this->filtro["cor"],
                "placa" => $this->filtro["placa"],
               // "modo" => $this->filtro["modo"],
                //"orcamento" => $this->filtro["orcamento"],
                "data" => date("Y-m-d H:i:s")
            ];

            $cad = new \Source\Models\Create();
            $cad->ExeCreate("app_orcamento", $Dados);
            $cad->getResult();
            if ($cad->getResult()) {
                echo "<div class='alert alert-success'>Orçamento cadastrado com sucesso </div>";
                 echo "<meta http-equiv=\"refresh\" content=\"3; URL='./?p=orcamento-itens&editar={$orcamento_id}'\"/>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao cadastrar Orçamento </div>";
            }
            
             //var_dump($this->filtro , $Dados);
        }

        
    }

}
