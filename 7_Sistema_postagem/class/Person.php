<?php

    namespace Classes;
    use PDO;
    use Instances\instance_person;

    class Person {

        private $pdo;

        //Ver a classe instance_person
        //O objeto PDO é recebido via SINGLETON
        public function __construct($pdo){

            $this->pdo = $pdo;

        }

        public function getUser($username = null, $senha = null, $email = null, $where, $op){

            $sql = "SELECT `id`,`username`, `pass`, `user_photo` FROM usuarios $where";

            $stmt = $this->pdo->prepare($sql);

            if($op == "LOGIN"){

                $stmt->bindParam(":username", $username);

            }else if($op == "CHECK_EMAIL"){

                $stmt->bindParam(":email", $email);

            }

            $stmt->execute();
            
            //rowCount retorna o número de linhas afetadas pela instrução SQL
            if($stmt->rowCount() == 1){

                //Se a operação for de login, retorna o StatmentObject, se não retorna true
                return $op = "LOGIN" ? $stmt: true;

            }else{

                //Retornamos false para indicar que o usuário e senha digitados não foram encontrados em um mesmo registro do BD
                return false;

            }

        }

        //Por padrão o $file_data é igual a null, pois no cadastro a foto é opcional
        public function setUser($username, $password, $email, $file_data = null){

            //echo $file_data; die();

            //Senha deve ser inserida no banco criptografada
            $pass = password_hash($password, PASSWORD_BCRYPT); 

            $sql = "INSERT INTO usuarios (`username`, `pass`, `user_email`) VALUES (:username, :senha, :email)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":senha", $pass);
            $stmt->bindParam(":email", $email);
            if($stmt->execute()){

                //Com o INSERT realizado com sucesso, retornamos true caso $file_data for null
                if($file_data == null){
                    
                    return true;
                
                //Se não for null, uma foto foi enviada no cadastro
                //Nesse caso, até aqui, o registro tem um username, uma senha, e a foto padrão que deve ser substituída pela enviada
                }else{

                    //É retornado o retorno do método de atualização da foto
                    //Uma melhoria de segurança seria, acho, recuperar o id do registro inserido, via SELECT, e utiliza-lo para o UPDATE
                    return $this->updateUserPhoto($username, $file_data);

                }

            }else{

                return false;

            }

        }

        public function updateUserPhoto($username, $file_data){

            $sql = "UPDATE usuarios SET `user_photo` = :file_data WHERE `username` = :username";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":file_data", $file_data);
            if($stmt->execute()){

                return true;  

            }else{

                return false;

            }

        }

        public function keyGeneration($email, $code){

            $sql = "UPDATE usuarios SET `reco_pass_key` = :code WHERE `user_email` = :email";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":code", $code);
            $stmt->bindParam(":email", $email);
            if($stmt->execute()){

                return $arrData = array("code" => $code, "operation"=>true);  

            }else{

                return false;

            }

        }

        public function sendCodeEmail($code){
    
        }

    }


?>