<?php

        $user = "root";
        $pass = "";
        $dsn = "mysql:host=localhost;dbname=db_sistema";

        global $pdo;

        try {

            //Instância da classe PDO
            $pdo = new PDO($dsn, $user, $pass);
            
            } catch (PDOException $e) {
                echo "Erro na conexão com o banco de dados: {$e}";
                exit();
            } catch (Exception $e){
                echo "Erro genérico: {$e}";
                exit();
            }  

?>