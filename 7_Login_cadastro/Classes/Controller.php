<?php

    namespace Classes;
    use PDO;
    use Instances\InstanceDAOsql;
    use Classes\PHPMail;

    class Controller {

        private $pdo;
        private $dao;

        public function __construct($pdo){

            $this->pdo = $pdo;
            $this->dao = InstanceDAOsql::getInstance();

        }

        public function getUser($arrData = array(), $where, $operation){
            //print_r($arrData); echo $where, $operation; die();

            $sql = "SELECT `id`,`username`, `pass`, `user_photo`, `user_email` FROM usuarios $where";

            if($operation == "LOGIN"){

                $params = array(":username"=>$arrData['username']);

            }else if($operation == "CHECK_EMAIL"){

                $params = array(":email"=>$arrData['email']);

            }else if($operation == "CHECK_CODE"){

                $params = array(":code"=>$arrData['code']);

            }

            $ret = $this->dao->select($sql, $params);
            
            //rowCount retorna o número de linhas afetadas pela instrução SQL
            if($ret['operation']){

                return $ret['data'];

            }else{

                //Retornamos false para indicar que o usuário e senha digitados não foram encontrados em um mesmo registro do BD
                return false;

            }

        }

        //Por padrão o $file_data é igual a null, pois no cadastro a foto é opcional
        public function setUser($arrData = array()){
            //print_r($arrData); die();

            //Senha deve ser inserida no banco criptografada
            $pass = password_hash($arrData['password'], PASSWORD_BCRYPT); 

            $sql = "INSERT INTO usuarios (`username`, `pass`, `user_email`) VALUES (:username, :senha, :email)";

            $params = array(":username"=>$arrData['username'], ":senha"=>$pass, ":email"=>$arrData['email']);

            $ret = $this->dao->insert($sql, $params);

            if($ret['operation']){

                //Com o INSERT realizado com sucesso, retornamos true caso $file_data for null
                if(empty($file_data)){
                    
                    return true;
                
                //Se não for null, uma foto foi enviada no cadastro
                //Nesse caso, até aqui, o registro tem um username, uma senha, e a foto padrão que deve ser substituída pela enviada
                }else{

                    //É retornado o retorno do método de atualização da foto
                    //Uma melhoria de segurança seria, acho, recuperar o id do registro inserido, via SELECT, e utiliza-lo para o UPDATE
                    return $this->updateUserPhoto($arrData['username'], $arrData['image']);

                }

            }else{

                return false;

            }

        }

        public function updatePass($new_password, $code, $id){

            $pass_crypt = password_hash($new_password, PASSWORD_BCRYPT); 

            $sql = "UPDATE usuarios SET `pass` = :pass WHERE `reco_pass_key` = :code";

            $params = array(":pass"=>$new_password,":code"=>$code);

            $ret = $this->dao->update($sql, $params);

            if($ret['operation']){

                return $this->keyGeneration(null, "temp", $id);

            }else{

                return false;

            }

        }

        //If the file data is null, the field of photo, on database, will have the default value, wich is a path for a default image
        public function updateUserPhoto($username, $file_data){

            $sql = "UPDATE usuarios SET `user_photo` = :file_data WHERE `username` = :username";

            $params = array(":file_data"=>$file_data,":username"=>$username);

            $ret = $this->dao->update($sql, $params);

            if($ret['operation']){

                return true;  

            }else{

                return false;

            }

        }

        public function updatekeyField($email, $code, $id = null){

            $sql = "UPDATE usuarios SET `reco_pass_key` = :code WHERE `user_email` = :email OR `id` = :id";

            $params = array(":code"=>$code,":email"=>$email, ":id"=>$id);

            $ret = $this->dao->update($sql, $params);

            if($ret['operation']){

                return array("code" => $code);  

            }else{

                return false;

            }

        }

        public function keyGeneration($length = 25){

            //Gera um código binário
            //Este código terá o dobro de caracteres passado como argumento para a função random_bytes()
            $gen_bytes = random_bytes($length); 

            //O código binário é convertido para hexadecimal
            //https://stackoverflow.com/questions/1846202/how-to-generate-a-random-unique-alphanumeric-string/13733588#13733588
            $code = bin2hex($gen_bytes); 

            return $code;

        }

        public function prepareEmail($emailData = array()){

            $message = $this->constructMessage($emailData);

            $mail_config = array(

                "message_data"=> $message,
                "host" => 'smtp.mailtrap.io',
                "username" => '1842467d27f9da',
                "password" => 'f1a3b95063e7e3',
                "port" => 2525,
                "email_sender" => "system@mail.com",
                "email_recipient" => $emailData['email']

            );

            $mail_object = new PHPMail($mail_config);
            $mail_object->mailsetConfig();
            $ret = $mail_object->sentEmail();

            if($ret){

                return true;

            }else{

                return false;

            }

        }

        public function constructMessage($emailData){

            $message = "<p>http://localhost/projetosphp/sistema_postagem/password_alter.php?code={$emailData['code']}</p>";

            return $message;


        }





    }


?>