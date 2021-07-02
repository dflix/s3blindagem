<?php

namespace Source\Core;

use Source\Core\SessaoCarteiras;

class SessionUser {
    
    public function __construct() {
        if (!session_id()) {
            session_start();
        }
       
    }
    
    public function start(int $data) {
        
        $read = new \Source\Models\Read();
        $read->ExeRead("usuarios", "WHERE id = :id", "id={$data}");
        $read->getResult();
        
        $_SESSION['user_id'] = $read->getResult()[0]['id'];
        $_SESSION['email_user'] = $read->getResult()[0]['email'];
        $_SESSION['nome'] = $read->getResult()[0]['responsavel'];
        $_SESSION['nivel'] = $read->getResult()[0]['nivel'];
        
        //verifica sessao carteira
        $carteira = new \Source\Models\Read();
        $carteira->ExeRead("app_carterias", "WHERE user_id = :a ORDER BY id DESC", "a={$read->getResult()[0]['id']}");
        $carteira->getResult();
       $_SESSION['carteira'] = $carteira->getResult()[0]["wallet"];
       $_SESSION['nome_carteira'] = $carteira->getResult()[0]["wallet"];
               
        
        
        
    }
    
    
}
