<?php

    require_once("vendor/autoload.php");
    use Classes\Pessoa_instance;
    use Classes\Pessoa_DAO;

    header('Content-Type: application/json');

    //PRIMEIRO FILTRO
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

    //SEGUNDO FILTRO //PARA IMPEDIR XSS
    //O "f" no final denota que foram "filtrados"
    $nomef = strip_tags($nome);
    $telefonef = strip_tags($telefone);
    $emailf = strip_tags($email);

    if(!empty($nomef) && !empty($telefonef) && !empty($emailf)){

        //Para contar quantos caracteres tem o número de telefone informado
        //Essa variável será usada apenas para a condicional, pois receberá o número de caracteres da string
        $telefoneff = strlen($telefonef);

        //O número mínimo de caracteres de um telefone brasileiro é 10 
        if($telefoneff <= 12 && $telefoneff >=10){

            //Agora vamos filtrar o email 
            //Sobre a função usada: https://www.php.net/manual/en/function.filter-var.php
            if(filter_var($emailf, FILTER_VALIDATE_EMAIL)){

                $obj_pessoa = Pessoa_instance::getInstance();

                $cadastro_return = $obj_pessoa->cadastrarPessoa($nomef, $telefonef, $emailf);

                //True ou false
                echo $cadastro_return;

            }
        }
    }

?>

