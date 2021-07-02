<?php



namespace Source\Core;


class Saidas {
    

    
    public function __construct() {
        
        
        
    }
    
    public function Agora() {
        
        $this->agora = date("m-Y");
        $mparam = date("m");
        $aparam = date("Y");
        
        if($_SESSION['carteira'] == "geral"){
            $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v",
                "id={$_SESSION['user_id']}&s=paid&m={$mparam}&y={$aparam}&v=saida");
            
        }else{
        $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v AND carteira_id = :c",
                "id={$_SESSION['user_id']}&s=paid&m={$mparam}&y={$aparam}&v=saida&c={$_SESSION['carteira']}");
        }     
                $read->getResult();
                $agora = 0;
                foreach ($read->getResult() as $value) {
                    $agora += $value['valor'] ;
                }
                
                return number_format($agora / 100, 2 , "." , "" );
        
    }
    
    public function Total() {
        
        $this->agora = date("m-Y");
        $mparam = date("m");
        $aparam = date("Y");
        
        if($_SESSION['carteira'] == "geral"){
            $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s  AND modo = :v",
                "id={$_SESSION['user_id']}&s=paid&v=saida");
            
        }else{
        $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s  AND modo = :v AND carteira_id = :c",
                "id={$_SESSION['user_id']}&s=paid&v=saida&c={$_SESSION['carteira']}");
        }     
                $read->getResult();
                $agora = 0;
                foreach ($read->getResult() as $value) {
                    $agora += $value['valor'] ;
                }
                
                return number_format($agora / 100, 2 , "." , "" );
        
    }
    

    
    public function MenosUm() {
        

        $data = date("m-Y");
        $data  = date("m-Y", strtotime("-1 month"));
        
        $tratar = explode("-", $data);
        
        $param1 = $tratar['0'];
        $param2 = $tratar['1'];
        
        if($_SESSION['carteira'] == "geral"){
            $read = new \Source\Models\Read();
                    $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida");
        }else{
        
        $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v AND carteira_id = :c",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida&c={$_SESSION['carteira']}");
        }   
                $read->getResult();
                $agora = 0;
                foreach ($read->getResult() as $value) {
                    $agora += $value['valor'] ;
                }
                
                return number_format($agora / 100, 2 , "." , "" );
        
    }
    
    public function MenosDois() {
        

        $data = date("m-Y");
        $data  = date("m-Y", strtotime("-2 month"));
        
        $tratar = explode("-", $data);
        
        $param1 = $tratar['0'];
        $param2 = $tratar['1'];
        
        if($_SESSION['carteira'] == "geral"){
         $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida");           
        }else{
        $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v AND carteira_id = :c",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida&c={$_SESSION['carteira']}");
        } 
                $read->getResult();
                $agora = 0;
                foreach ($read->getResult() as $value) {
                    $agora += $value['valor'] ;
                }
                
                return number_format($agora / 100, 2 , "." , "" );
        
    }
    
    public function MenosTres() {
        

        $data = date("m-Y");
        $data  = date("m-Y", strtotime("-3 month"));
        
        $tratar = explode("-", $data);
        
        $param1 = $tratar['0'];
        $param2 = $tratar['1'];
        
        if($_SESSION['carteira'] == "geral"){
         $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida");           
        }else{
        $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v AND carteira_id = :c",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida&c={$_SESSION['carteira']}");
        }    
                $read->getResult();
                $agora = 0;
                foreach ($read->getResult() as $value) {
                    $agora += $value['valor'] ;
                }
                
                return number_format($agora / 100, 2 , "." , "" );
        
    }
    
    public function MenosQuatro() {
        

        $data = date("m-Y");
        $data  = date("m-Y", strtotime("-4 month"));
        
        $tratar = explode("-", $data);
        
        $param1 = $tratar['0'];
        $param2 = $tratar['1'];
        
        if($_SESSION['carteira'] == "geral"){
                    $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida");
        }else{
        $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v AND carteira_id = :c",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida&c={$_SESSION['carteira']}");
        }    
                $read->getResult();
                $agora = 0;
                foreach ($read->getResult() as $value) {
                    $agora += $value['valor'] ;
                }
                
                return number_format($agora / 100, 2 , "." , "" );
        
    }
    
    public function MenosCinco() {
        

        $data = date("m-Y");
        $data  = date("m-Y", strtotime("-5 month"));
        
        $tratar = explode("-", $data);
        
        $param1 = $tratar['0'];
        $param2 = $tratar['1'];
        
        if($_SESSION['carteira'] == "geral"){
         $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida");           
        }else{
        $read = new \Source\Models\Read();
        $read->ExeRead("app_faturas", "WHERE user_id = :id AND status = :s AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y AND modo = :v AND carteira_id = :c",
                "id={$_SESSION['user_id']}&s=paid&m={$param1}&y={$param2}&v=saida&c={$_SESSION['carteira']}");
        }   
                $read->getResult();
                $agora = 0;
                foreach ($read->getResult() as $value) {
                    $agora += $value['valor'] ;
                }
                
                return number_format($agora / 100, 2 , "." , "" );
        
    }
    
    public function rodapegrafico() {
        
        $agora = date("m-Y");
        $menosum  = date("m-Y", strtotime("-1 month"));
        $menosdois  = date("m-Y", strtotime("-2 month"));
        $menostres  = date("m-Y", strtotime("-3 month"));
        $menosquatro  = date("m-Y", strtotime("-4 month"));
        $menoscinco  = date("m-Y", strtotime("-5 month"));
        
       // var_dump($agora, $menosum, $menosdois, $menostres , $menosquatro , $menoscinco);
        
        $rodape = "['" . $menoscinco . "' , '". $menosquatro . "' , '" . $menostres ."' , '".  $menosdois ."' , '". $menosum . "' , '". $agora . "']";

        $rodape = substr($rodape,1 , -1);
        
        
        return $rodape;
        
    }
    
    public function chartSaida() {
        
      return  $chart = $this->MenosCinco() . " , " . $this->MenosQuatro() . " , " . $this->MenosTres() . " , " . $this->MenosDois() . " , " . $this->MenosUm() . " , " . $this->agora() ;
        

        
    }
    
    public function update() {

        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($filtro["editar"])) {

            $filtro["valor"] = str_replace(".", "", $filtro["valor"]);
            $filtro["valor"] = str_replace(",", "", $filtro["valor"]);
            unset($filtro["editar"]);
            
           // var_dump($filtro);

            $update = new \Source\Models\Update();
            $update->ExeUpdate("app_faturas", $filtro, "WHERE id = :id", "id={$filtro["id"]}");
            $update->getResult();

            if ($update->getResult()) {
                echo "<div class=\"alert alert-success\" role=\"alert\">
               <h5>  Editado com sucesso</h5> </div>";
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
               <h5>  Erro ao editar</h5> </div>";
            }
        }
    }

    public function buscar() {
        $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($filtro["buscar"])) {
           //var_dump($filtro);
            if ($filtro["periodo"] == "todas") {
                $prepPeriodo = null;
                $paramPeriodo = null;
            } else {

                $trata = explode("/", $filtro["periodo"]);
                $varmonth = $trata[0];
                $varyear = $trata[1];

                // var_dump($trata);

                $prepPeriodo = " AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y ";
                $paramPeriodo = "&m={$varmonth}&y={$varyear}";
            }

            if ($filtro["carteira"] == "geral") {

                $prepCarteira = null;
                $paramCarteira = null;
            } else {

                $prepCarteira = " AND carteira_id = :cartid ";
                $paramCarteira = "&cartid={$filtro['carteira']}";
            }

            if ($filtro["categoria"] == "geral") {
                $prepCategoria = null;
                $paramCategoria = null;
            } else {
                $prepCategoria = " AND categoria_id = :cat ";
                $paramCategoria = "&cat={$filtro["categoria"]}";
            }

            if ($filtro["status"] == "todas") {
                $prepStatus = null;
                $paramStatus = null;
            } else {
                $prepStatus = " AND status = :status ";
                $paramStatus = "&status={$filtro["status"]}";
            }
        }

        $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
        $pager = new \Source\Support\Pager("" . CONF_URL_APP . "/saida&atual=", 'Primeira', 'Ultima', '1');

        $pager->ExePager($atual, 10);

        if (!empty($filtro["buscar"])) {

            $read = new \Source\Models\Read();
            $read->ExeRead("app_faturas", "WHERE user_id = :i AND modo = :a {$prepPeriodo} {$prepCarteira} {$prepCategoria} {$prepStatus} LIMIT :limit OFFSET :offset",
                    "i={$_SESSION['user_id']}&a=saida{$paramPeriodo}{$paramCarteira}{$paramCategoria}{$paramStatus}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
           return $read->getResult();
        } else {
            
            $m = date("m");
            $y = date("Y");

            $read = new \Source\Models\Read();
            $read->ExeRead("app_faturas", "WHERE user_id = :i AND modo = :a AND MONTH(vencimento_em) = :m AND YEAR(vencimento_em) = :y  LIMIT :limit OFFSET :offset",
      "i={$_SESSION['user_id']}&a=saida&m={$m}&y={$y}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");
           return $read->getResult();
        }
        
    }
        
        public  function paginacao() {
         
           
            
            $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
           
           $pager = new \Source\Support\Pager('saida&atual=', 'Primeira', 'Ultima', '1');
             $pager->ExePager($atual, 5);
            
             $pager->ExePaginator("app_faturas");

           return  $pager->getPaginator();
            
        }
}
