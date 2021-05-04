<?php

    require_once("../Classes/Usuario.php");
    header('Content-Type: application/json');

        $obj = new Usuario();
        $retorno = $obj->getUsuarios();

        if($retorno){

            //Caso o retorno não for false, a variável de retorno terá uma matriz associativa
            //A convertemos em JSON e enviamos para o script Ajax 
            echo json_encode($retorno);

        }else{

            //Caso for false, retornamos false //Ocorrerá caso nenhum registro exista no banco
            echo false;
        }

?>