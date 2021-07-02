<?php

session_start();
require_once("../../../vendor/autoload.php");
use Instances\InstanceController;

if(isset($_POST['new_pass_btn'])){

    //Para impedir XSS
    $new_pass = strip_tags($_POST['pass_alter']);
    $code = strip_tags(TRIM($_POST['code_rec']));

    if(!empty($new_pass) && !empty($code)){

        $code_obj = InstanceController::getInstance();

        $where = "WHERE `reco_pass_key` = :code";

        $arrData = array("code"=>$code);

        $check_code = $code_obj->getUser($arrData, $where, "CHECK_CODE");

        //Se o código existir em um registro, o mesmo será retornado
        if($check_code){

            $pass_obj = InstanceController::getInstance();

            $up_pass = $pass_obj->updatePass($new_pass, $code, $check_code['id']);

            if($up_pass){

                $_SESSION['success_msg'] = "Sucesso! A senha foi alterada!";

                header("location: ../../index.php");

            }else{

                $_SESSION['error_msg'] = "Erro na alteração da senha! Tente novamente!";

                header("location: ../../password_recovery.php");

            }


        }else{

            $_SESSION['error_msg'] = "Erro! Tente novamente!";

            header("location: ../../password_recovery.php");

        }

    }else{

        $_SESSION['error_msg'] = "Preencha todos os campos! Tente novamente!";

        header("location: ../../password_recovery.php");

    }

}else{

    $_SESSION['error_msg'] = "Área restrita!";

    header("location: ../../index.php");

}

    



?>