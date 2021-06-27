<?php

    session_start();
    require_once("conection.php");
    require_once("../../vendor/autoload.php");
    use Instances\instance_person;

    if(isset($_POST['reg_btn'])){

        //PRIMEIRO FILTRO //Recuperação filtrada do nome de usuário e senha enviados
        $username = filter_input(INPUT_POST, "username_reg", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email_reg", FILTER_SANITIZE_EMAIL);
        $pass = filter_input(INPUT_POST, "password_reg", FILTER_SANITIZE_STRING);

        //SEGUNDO FILTRO //RETIRAR ESPAÇOS E CARACTERES DE TAGS, PARA IMPEDIR XSS
        $usernamef = strip_tags(trim($username));
        $passf = strip_tags(trim($pass));

        //Recuperar extensão do arquivo
        //$_FILES serve para recuperar arquivos e seus dados em um array //https://www.php.net/manual/pt_BR/features.file-upload.post-method.php
        //pathinfo() retorna informações sobre um caminho de arquivo, e o modo que passei retorna a extensão do arquivo  //https://www.php.net/manual/pt_BR/function.pathinfo.php
        $extension = strtolower(pathinfo($_FILES['file_reg']['name'], PATHINFO_EXTENSION));

        if(!empty($usernamef) && !empty($passf)){

            //Se o usuário enviou uma foto para cadastro, e se for uma das extensões permitidas, o dado é preparado para inserção no banco
            if(isset($_FILES['file_reg']) && ($extension == "png" || $extension == "jpg" || $extension == "jpeg")){

                //Renomear o arquivo
                //Será: username.extensão, sendo "username" o correspondente de "login"
                $newName = strtolower($usernamef) . ".$extension";

                //Caminho relativo para o local onde estará o arquivo
                $file_path = "../../users/img/";

                //Mover o arquivo para o endereço $diretorio.$newName, ou seja, "../../users/img/username.extensão"
                move_uploaded_file($_FILES['file_reg']['tmp_name'], $file_path.$newName);

                $file_data = $newName;

            }

            //Instância da classe Person
            $object = instance_person::getInstance();

            $ret = $object->setUser($usernamef, $passf, $email, $file_data);

            if($ret){

                $_SESSION['success_msg'] = "Cadastro realizado com sucesso!";

                header("location: ../../register.php");

            }else{

                $_SESSION['error_msg'] = "Erro no cadastro! Tente novamente!";

                header("location: ../../register.php");

            }

        }else{

            $_SESSION['error_msg'] = "Preencha todos os campos! Tente novamente!";

            header("location: ../../register.php");

        }

    }else{

        $_SESSION['error_msg'] = "Área restrita!";

        header("location: ../../register.php");

    }
    

?>