<?php

    class Usuario{

        private $pdo;

        public function __construct(){

            $this->pdo = new PDO("mysql:host=localhost;dbname=database_tarefa", "root", "root"); 

        }

        //MÉTODO PARA REALIZAR INSERT
        public function setUsuario($nome, $email, $login, $senha){

            //Senha deve ser inserida no banco criptografada
            //Uso a função password_hash ao invés da md5()
            $senha_cript = password_hash($senha, PASSWORD_BCRYPT); 

            //O comando SQL de inserção a ser executado
            $query = "INSERT INTO usuario(cd_usuario, nome_usuario, email_usuario, login_usuario, senha_usuario) VALUES (DEFAULT, :nome, :email, :username, :senha)";

            //Variável recebe o StatmentObject
            $stmt = $this->pdo->prepare($query); 

            //Execução dos métodos do StatmentObject
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":username", $login);
            $stmt->bindParam(":senha", $senha_cript);

            //Se a execução do Statment retornar true
            if($stmt->execute()){

                //Com o INSERT realizado com sucesso, retornamos true
                return true;

            }else{

                //Se o INSERT falhar, retornamos false
                return false;

            }
        }
        
        //MÉTODO PARA REALIZAR SELECT
        public function getUsuarios(){

            //O comando SQL de inserção a ser executado 
            $query = "SELECT cd_usuario, nome_usuario, email_usuario, login_usuario FROM usuario";

            //Variável recebe o StatmentObject
            $stmt = $this->pdo->prepare($query); 
            $stmt->execute();

            //rowCount retorna o número de linhas afetadas pela instrução SQL
            if($stmt->rowCount() > 0){

                //Neste caso o rowCount é superior a 0
                //Significa que existem registros no banco de dados

                //Retorna uma matriz contendo todas as linhas do conjunto de resultados
                //O parâmetro é o modo, que faz da matriz um array associativo
                //https://www.php.net/manual/pt_BR/pdostatement.fetchall.php
                $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);


                return $registros;

            }else{
                
                //Retornamos false caso não existam registros afetados
                return false;
            }
        }

        //MÉTODO PARA REALIZAR UPDATE
        public function Update_registro($id, $nome, $email, $login){

            //O comando SQL de inserção a ser executado 
            $query = "UPDATE usuario SET nome_usuario = :nome, email_usuario = :email, login_usuario = :username WHERE cd_usuario = :id";

            //Variável recebe o StatmentObject
            $stmt = $this->pdo->prepare($query); 

            //Execução dos métodos do StatmentObject
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":username", $login);

            $stmt->execute();

            if($stmt->rowCount() > 0){

                //Neste caso o rowCount é superior a 0
                //Significa que um registro foi atualizado

                return true;

            }else{
                
                //Retornamos false caso não existam registros afetados
                return false;
            }
        }

        //MÉTODO PARA REALIZAR DELETE
        public function Delete_registro($id){

            //O comando SQL de inserção a ser executado 
            $query = "DELETE FROM usuario WHERE cd_usuario = :id";

            //Variável recebe o StatmentObject
            $stmt = $this->pdo->prepare($query); 

            //Execução dos métodos do StatmentObject
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            //rowCount retorna o número de linhas afetadas pela instrução SQL
            if($stmt->rowCount() > 0){

                //Neste caso o rowCount é superior a 0
                //Significa que um registro foi deletado
                return true;

            }else{
                
                //Retornamos false caso não existam registros afetados
                return false;
            }
        }
     
    }

?>