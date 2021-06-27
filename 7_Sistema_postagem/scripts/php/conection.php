<?php

    try{
        $pdo = new PDO("mysql:host=localhost;dbname=login_cadastro", "root", "");
    }
    catch(PDOException $e){
        echo "Erro com o banco de dados:" .$e->getMessage();
        echo "Código de erro: " .$e->getCode();
    }
    catch(PDOException $e){
        echo "Erro genérico:" .$e->getMessage();
        echo "Código de erro: " .$e->getCode();
    }

?>