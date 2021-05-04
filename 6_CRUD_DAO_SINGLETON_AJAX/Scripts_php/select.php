<?php

    require_once("vendor/autoload.php");
    use Classes\Pessoa_DAO;

    header('Content-Type: application/json');

    //Recebe os registros
    $load_return = Pessoa_DAO::loadAll();

    if(count($load_return) > 0){

        //Resposta para o script Ajax
        echo json_encode($load_return);
        
    }else{

        //Resposta para o script Ajax
         echo json_encode(false);
        
    }



?>