<?php

    session_start();
    require_once("../../../vendor/autoload.php");
    use Instances\InstanceController;

    if(isset($_POST['login_btn'])){

        $username = filter_input(INPUT_POST, "username_login", FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, "password_login", FILTER_SANITIZE_STRING);

        $usernamef = strip_tags(trim($username));
        $passf = strip_tags(trim($pass));

        if(!empty($usernamef) && !empty($passf)){

            //Instância da classe Controller
            $object_controller = InstanceController::getInstance();

            $where = "WHERE `username` = :username";

            $arrData = array("username"=>$usernamef, "pass"=>$passf);

            $ret = $object_controller->getUser($arrData, $where, "LOGIN");

            if($ret){

                //Agora, se a senha digitada no login for compátivel com a senha criptografica do registro encontrado, o usuário-senha são válidos
                if(password_verify($passf, $ret[0]["pass"])){

                    //Criamos uma sessão para recuperar cada valor de cada campo do registro do BD, exceto a senha, claro
                    $_SESSION['iduser'] = $ret[0]['id'];
                    $_SESSION['user'] = $ret[0]['username'];
                    $_SESSION['user_img'] = $ret[0]['user_photo']; //username.extension

                    //Somos redirecionados para a página do sistema
                    header("location: ../../../sistema.php");
                    
                }else{

                    $_SESSION['error_msg'] = "Senha incorreta! Tente novamente!";
    
                    header("location: ../../../index.php");

                }

                }else{

                    $_SESSION['error_msg'] = "Usuário ou senha incorretos! Tente novamente!";
    
                    header("location: ../../../index.php");

            }

        }else{

            $_SESSION['error_msg'] = "Preencha todos os campos!";
    
            header("location: ../../../index.php");

        }

    }else{

        $_SESSION['error_msg'] = "Área restrita!";
    
        header("location: ../../../index.php");

    }





?>