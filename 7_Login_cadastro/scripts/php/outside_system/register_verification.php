<?php

    session_start();
    require_once("../../../vendor/autoload.php");
    use Instances\InstanceController;

    if(isset($_POST['reg_btn'])){

        //FIRST SECURITY LAYER //Sanitize filters
        $username = filter_input(INPUT_POST, "username_reg", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email_reg", FILTER_SANITIZE_EMAIL);
        $pass = filter_input(INPUT_POST, "password_reg", FILTER_SANITIZE_STRING);

        //SECOND SECURITY LAYER //Remove, if exists, spaces from strings, and other symbols to prevent injections, like XSS
        $usernamef = strip_tags(trim($username));
        $passf = strip_tags(trim($pass));

        //Retrieve file extension
        //$_FILES allow to retrieve files and their data in an array //https://www.php.net/manual/pt_BR/features.file-upload.post-method.php
        //pathinfo() return informations about a file path, and that mode wich was passed returns the file extension //https://www.php.net/manual/pt_BR/function.pathinfo.php
        $extension = strtolower(pathinfo($_FILES['file_reg']['name'], PATHINFO_EXTENSION));

        if(!empty($usernamef) && !empty($passf)){

            //If the user has sent a photo for the record, and if it is one of the allowed extension, the data is prepared for the insertion on the database
            if(isset($_FILES['file_reg']) && ($extension == "png" || $extension == "jpg" || $extension == "jpeg")){

                //Rename the file
                //Will be: username.extension, being "username" the same as "login"
                $newName = strtolower($usernamef) . ".$extension";

                //Relative path for the local where will be the file
                $file_path = "../../users/img/";

                //Move the file for the address $diretorio.newname, or, in other words, "../../users/img/username.extensão"
                move_uploaded_file($_FILES['file_reg']['tmp_name'], $file_path.$newName);

                $file_data = $newName;

            }else{

                $file_data = null;

            }

            //Instância da classe Controller
            $object_controller = InstanceController::getInstance();

            $arrData = array("username"=>$usernamef, "password"=>$passf, "email"=>$email, "image"=>$file_data);
            $ret = $object_controller->setUser($arrData);

            if($ret){

                $_SESSION['success_msg'] = "Cadastro realizado com sucesso!";

                header("location: ../../../index.php");

            }else{

                $_SESSION['error_msg'] = "Erro no cadastro! Tente novamente!";

                header("location: ../../../index.php");

            }

        }else{

            $_SESSION['error_msg'] = "Preencha todos os campos! Tente novamente!";

            header("location: ../../../register.php");

        }

    }else{

        $_SESSION['error_msg'] = "Área restrita!";

        header("location: ../../../index.php");

    }
    

?>