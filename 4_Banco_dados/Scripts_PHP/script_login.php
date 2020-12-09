<?php

    if(isset($_GET["username"]) && !empty($_GET["username"]) && isset($_GET["senha"]) && !empty($_GET["senha"])){
        //Se as variáveis forem diferentes de null e de vazio

        require "conexao.php";
        require "UsuarioClass.php";

        //Instancia da classe Usuario
        $u = new Usuario();

        $usuario = $_GET["username"];
        $senha = $_GET["senha"];

        //Chamada do método da classe
        //Para consultar se o usuário e senha existem no banco
        if($u->get_funcionarios($usuario, $senha)){
            //Se o retorno for true (rowCount > 0)
            if(isset($_SESSION['nome_usuario'])){
                //E se existir a Sessão com o nome do usuário (que é criada após a validação do login)
                //Somos redirecionados para a página do sistema
                header("location: http://localhost/1_Projetos/4_Banco_dados/sistema.php");
            }
        } else {
            //Se não existir a Sessão, somos redirecionados para a página de login
            header("location: http://localhost/1_Projetos/4_Banco_dados/Login.php");
        }

    } else {
        //Se as duas variáveis não forem diferentes de null ou de vazio
        //Somos redirecionados para a tela de login
        header("location: http://localhost/1_Projetos/4_Banco_dados/Login.php");  
    }


?>
    
     
        
        
        
    
    
   
    
   
    
    
    