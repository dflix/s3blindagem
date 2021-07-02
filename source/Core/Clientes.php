<?php


namespace Source\Core;

class Clientes {
   
    private $filtro;
    
    public function __construct() {
        
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $this->filtro = $filtro;
        
    }
    
    public function cadastra() {
        $this->sessaoCliente();
       
        if($this->filtro){

          $this->filtro["user_id"] = intval($_SESSION["user_id"]);
            $this->filtro["cliente_id"] = $_SESSION["cliente_id"];
            $tipo = intval($this->filtro["tipo"]);
           
           
            $Dados = [
                "user_id" => intval($_SESSION["user_id"]) ,
                "tipo" => $tipo,
                "cliente_id" =>  $_SESSION["cliente_id"],
                "nome" => $this->filtro["nome_razao"],
                "cpf" => $this->filtro["cpf"],
                "rg" => $this->filtro["rg"],
                "cnpj" => $this->filtro["cnpj"],
                "ie" => $this->filtro["ie"],
                "responsavel" => $this->filtro["responsavel"],
                "data_nascimento" => $this->filtro["data_nascimento"],
                
     
            ];
            
          //  var_dump($Dados);
            
            $cadastra = new \Source\Models\Create();
            $cadastra->ExeCreate("app_clientes", $Dados);
            $cadastra->getResult();
            
            if($cadastra->getResult()){
                 echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5> Sucesso  </h5>  </div>";
                 
                 echo "<meta http-equiv=\"refresh\" content=\"3; URL='./?p=cliente_endereco'\"/>";
                // header("location:./endereco");
            }else{
                echo "<div class=\"alert alert-danger col-md-12\" role=\"alert\">
               <h5> Erro  </h5>  </div>";
            }

        }
        
    }
    
    public function atualiza() {
        
        unset($this->filtro["editar"]);
        
        if($this->filtro){
            
            $this->filtro["nome"] = $this->filtro["nome_razao"];
            
            unset($this->filtro["nome_razao"]);
            
            $update = new \Source\Models\Update();
            $update->ExeUpdate("app_clientes", $this->filtro, "WHERE cliente_id = :id AND user_id = :user ", 
                    "id={$this->filtro["id"]}&user={$_SESSION["user_id"]}");
            $update->getResult();
            if($update->getResult()){
                echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5> Sucesso  </h5>  </div>"; 
                 header("location:./endereco&edit={$this->filtro["id"]}");
            }else{
                echo "<div class=\"alert alert-danger col-md-12\" role=\"alert\">
               <h5> Erro  </h5>  </div>"; 
            }
          // var_dump($this->filtro);
        }
        
    }
    
    public function atualizaEndereco() {
        
        if($this->filtro){
            $update = new \Source\Models\Update();
            $update->ExeUpdate("app_enderecos", $this->filtro , "WHERE id = :id", "id={$this->filtro["id"]}");
            $update->getResult();
            if($update->getResult()){
                  echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5> Atualizado com sucesso  </h5>  </div>"; 
            }else{
                 echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5> Erro ao atualizar  </h5>  </div>";  
            }
           // var_dump($this->filtro);
        }
        
    }
    
    public function sessaoCliente() {
        //cria a sessão cliente
            $cli = new \Source\Models\Read();
            $cli->ExeRead("app_clientes", "WHERE user_id = :id ORDER BY id DESC", "id={$_SESSION["user_id"]}");
            $cli->getResult();

            if($cli->getResult()){
                $id = $cli->getResult()[0]["cliente_id"];
            }else{
                $id = 0;
            }
            
            return $_SESSION["cliente_id"] = $id + 1;
            
        //  var_dump($_SESSION["cliente_id"]);
        
    }
    
    public function endereco() {
        
        if($this->filtro){
            
            $Dados = [
               "user_id" => intval($this->filtro["user_id"]),
                "cliente_id" => intval($this->filtro["cliente_id"]),              
                "cep" => $this->filtro["cep"],
                "logradouro" => $this->filtro["logradouro"],
                "cliente_id" => $this->filtro["cliente_id"],
                "complemento" => $this->filtro["complemento"],
                "bairro" => $this->filtro["bairro"],
                "cidade" => $this->filtro["cidade"],
                "uf" => $this->filtro["uf"],
                "tipo" => intval($this->filtro["tipo"]),
            ];
            
            $registra = new \Source\Models\Create();
            $registra->ExeCreate("app_enderecos", $Dados);
            $registra->getResult();
            if($registra->getResult()){
                echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5> Endereço Cadastrado com sucesso  </h5>  </div>";
            }else{
               echo "<div class=\"alert alert-danger col-md-12\" role=\"alert\">
               <h5> Erro ao cadastrar  </h5>  </div>";  
            }
            

           // var_dump( $Dados);
        }
        
    }
    
    public function contatos() {
        
        if($this->filtro){
            $this->filtro["user_id"] = $_SESSION["user_id"];
            $this->filtro["cliente_id"] = $_SESSION["cliente_id"];
            
            $reg = new \Source\Models\Create();
            $reg->ExeCreate("app_contatos", $this->filtro);
            $reg->getResult();
            if($reg->getResult()){
                   echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
               <h5> <b>{$this->filtro["tipo"]}</b> Cadastrado com sucesso  </h5>  </div>";
            }else{
                  echo "<div class=\"alert alert-danger col-md-12\" role=\"alert\">
               <h5> Erro ao cadastrar  </h5>  </div>";  
            }
            
          //  var_dump($this->filtro);
        }
        
    }
}
