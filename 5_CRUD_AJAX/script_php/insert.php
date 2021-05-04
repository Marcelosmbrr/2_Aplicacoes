<?php

    require_once("../Classes/Usuario.php");

    //PRIMEIRO FILTRO //https://www.php.net/manual/pt_BR/function.filter-input.php
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    //SEGUNDO FILTRO //PARA IMPEDIR XSS
    //O "f" no final quer dizer que foram "filtrados"
    $nomef = strip_tags($nome);
    $emailf = strip_tags($email);
    $loginf = strip_tags($login);
    $senhaf = strip_tags($senha);

    //TERCEIRO FILTRO //VERIFICAR SE EXISTEM VALORES VAZIOS
    //Poderia ser aplicado antes, mas depois dos outros, e dos já existentes no próprio formulário HTML, acho que sequer precisaria
    if(!empty($nomef) && !empty($emailf) && !empty($loginf) && !empty($senhaf)){

        $obj = new Usuario();
        $retorno = $obj->setUsuario($nomef, $emailf, $loginf, $senhaf);

        if($retorno){
            //Retorno da resposta (true ou false) para o Script Ajax
            echo true;
        }else{
            echo false;
        }
    }

?>