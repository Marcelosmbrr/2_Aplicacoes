<?php

    session_start();


    //Classe Usuário para consultar a tabela de funcionarios
    class Usuario{

        public function get_funcionarios($username, $senha){

            global $pdo;

            //SQL default para login
            $sql = "SELECT * FROM funcionarios WHERE username = :username AND senha = :senha";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":senha", $senha);
            $stmt->execute();
            
            //rowCount retorna o número de linhas afetadas pela instrução SQL
            if($stmt->rowCount() > 0){
                //Se o número de linhas for superior a 0

                //Fetch() transforma a linha afetada em um array //Ideal para aplicações de login
                //Seu alternativo, Fetch_all(), serve para quando o retorno da instrução é de mais de uma linha
                $dado = $stmt->fetch();

                $_SESSION['nome_usuario'] = $dado['username'];
                return true;

            } else {
                return false;
            }

    }

}





