<?php

    session_start();
    //require_once("conection.php");
    require_once("../../vendor/autoload.php");
    use Instances\instance_person;

    if(isset($_POST['login_btn'])){

        $username = filter_input(INPUT_POST, "username_login", FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, "password_login", FILTER_SANITIZE_STRING);

        //SEGUNDO FILTRO //RETIRAR ESPAÇOS E CARACTERES DE TAGS, PARA IMPEDIR XSS
        $usernamef = strip_tags(trim($username));
        $passf = strip_tags(trim($pass));

        if(!empty($usernamef) && !empty($passf)){

            //Instância da classe Person
            $object = instance_person::getInstance();

            $where = "WHERE `username` = :username";

            $stmt = $object->getUser($usernamef, $passf, null, $where, "LOGIN");

            //rowCount retorna o número de linhas afetadas pela instrução SQL
            if($stmt){

                //Fetch() transforma a linha afetada em um array, o que é ideal para aplicações de login //Seu alternativo é Fetch_all()
                $registro = $stmt->fetch();

                //Agora, se a senha digitada no login for compátivel com a senha criptografica do registro encontrado, o usuário-senha são válidos
                if(password_verify($passf, $registro["pass"])){

                    //Criamos uma sessão para recuperar cada valor de cada campo do registro do BD, exceto a senha, claro
                    $_SESSION['iduser'] = $registro['id'];
                    $_SESSION['user'] = $registro['username'];
                    $_SESSION['user_img'] = $registro['user_photo']; //username.extension

                    //Somos redirecionados para a página do sistema
                    header("location: ../../sistema.php");
                    
                }else{

                    $_SESSION['error_msg'] = "Senha incorreta! Tente novamente!";
    
                    header("location: ../../index.php");

                }

                }else{

                    $_SESSION['error_msg'] = "Usuário ou senha incorretos! Tente novamente!";
    
                    header("location: ../../index.php");

            }

        }else{

            $_SESSION['error_msg'] = "Preencha todos os campos!";
    
            header("location: ../../index.php");

        }

    }else{

        $_SESSION['error_msg'] = "Área restrita!";
    
        header("location: ../../index.php");

    }



?>