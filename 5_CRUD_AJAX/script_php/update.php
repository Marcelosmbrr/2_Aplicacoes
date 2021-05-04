<?php

    require_once("../Classes/Usuario.php");

    //PRIMEIRO FILTRO //https://www.php.net/manual/pt_BR/function.filter-input.php
    $id = filter_input(INPUT_POST, "ID", FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $login = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);

    //SEGUNDO FILTRO //PARA IMPEDIR XSS
    //O "f" no final quer dizer que foram "filtrados"
    $nomef = strip_tags($nome);
    $emailf = strip_tags($email);
    $loginf = strip_tags($login);

    //TERCEIRO FILTRO //VERIFICAR SE EXISTEM VALORES VAZIOS
    //Poderia ser aplicado antes, mas depois dos outros, e dos já existentes no próprio formulário HTML, acho que sequer precisaria
    if(!empty($id) && !empty($nomef) && !empty($emailf) && !empty($loginf)){

        $obj = new Usuario();
        $retorno = $obj->Update_registro($id, $nomef, $emailf, $loginf);

        if($retorno){
            //Retorno da resposta (true ou false) para o Script Ajax
            echo true;
        }else{
            echo false;
        }
    }

?>