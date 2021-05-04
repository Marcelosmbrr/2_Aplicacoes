<?php

    require_once("../Classes/Usuario.php");

    //PRIMEIRO FILTRO //https://www.php.net/manual/pt_BR/function.filter-input.php
    $id = filter_input(INPUT_POST, "ID", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)){

        $obj = new Usuario();
        $retorno = $obj->Delete_registro($id);

        if($retorno){
            //Retorno da resposta (true ou false) para o Script Ajax
            echo true;
        }else{
            echo false;
        }
    }

?>