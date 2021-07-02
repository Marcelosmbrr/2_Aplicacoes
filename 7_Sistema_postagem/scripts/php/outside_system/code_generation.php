<?php

session_start();
require_once("../../../vendor/autoload.php");
use Instances\InstanceController;

if(isset($_POST['key_generation_btn'])){

    //PRIMEIRO FILTRO //Recuperação filtrada do nome de usuário e senha enviados
    $email = filter_input(INPUT_POST, "email_input_pr", FILTER_SANITIZE_EMAIL);

    if(!empty($email)){

        $object_controller = InstanceController::getInstance();

        $where = "WHERE `user_email` = :email";

        $arrData = array("email"=>$email);

        $record = $object_controller->getUser($arrData, $where, "CHECK_EMAIL");

        if($record){

            $code = $object_controller->keyGeneration();

            $update_key = $object_controller->updatekeyField($email, $code);

            if($update_key){

                //Use TRIM() and strip_tags() to prevent malicious data
                $emailData = array("code"=>strip_tags(TRIM($code)), "username"=>strip_tags(TRIM($record[0]['username'])), 
                "email"=>strip_tags(TRIM($record[0]['user_email'])));

                $code_send = $object_controller->prepareEmail($emailData);

                if($code_send){

                    $_SESSION['success_msg'] = "Sucesso! O código de recuperação foi enviado para o seu e-mail!";
                    echo "<script>window.location.assign('../../../index.php')</script>";
    

                }else{

                    $_SESSION['error_msg'] = "Ops! Houve um erro no envio do email! Tente novamente!";
                    header("location: ../../../password_recovery.php");

                }
    
            }else{
    
                $_SESSION['error_msg'] = "Ops! Houve um erro na geração do código! Tente novamente!";
    
                header("location: ../../../password_recovery.php");
    
            }

        }else{

            $_SESSION['error_msg'] = "Este e-mail não foi cadastrado!";

            header("location: ../../../password_recovery.php");

        }

    }else{

        $_SESSION['error_msg'] = "Preencha todos os campos! Tente novamente!";

        header("location: ../../../password_recovery.php");

    }

}else{

    $_SESSION['error_msg'] = "Área restrita!";

    header("location: ../../../index.php");

}

    



?>