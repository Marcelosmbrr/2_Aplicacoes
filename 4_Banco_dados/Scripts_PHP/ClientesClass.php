<?php

    session_start();


    //Classe Usuário para consultar a tabela de funcionarios
    class Clientes{

        public function get_clientes($sql){

            global $pdo;

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            //rowCount retorna o número de linhas afetadas pela instrução SQL
            if($stmt->rowCount() > 0){
                //Se o número de linhas for superior a 0

                //FetchAll() retorna, em forma de array, todas as linhas encontradas
                $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $clientes;

            } else {
                return false;
            }

    }

}





