<?php

    //Esta classe contém os métodos propriamente ditos do que seria a idealizada classe "SQL", que processaria as queries
    //A Classe SQL_instance serve para retornar instâncias desta, seguindo o padrão SINGLETON

    namespace Classes;
    use Classes\Conexao_instance;
    use PDO;

    class Sql_DAO{

        //Para diferenciar os retornos a variável "query_type" será usada
        //Isso é necessário porque esse algoritmo trabalha de forma igual todas as queries
        private function queryInit($query_type, $query, $params = array()){

            //Conexao_instance::getConn() retorna a instância da classe PDO gerada pela classe Conexao_instance
            $obj_pdo = Conexao_instance::getInstance();

            $statment = $obj_pdo->prepare($query);

            if(!empty($params)){

                foreach($params as $chave => $valor){
                    
                    $this->setParams($chave, $valor, $statment);
                    
                    }

            }
                
            //Se for um select, irá retornar um array associativo, se não, apenas irá retornar true
            //Surge a necessidade da variável "query type" aqui, como um outro referencial para o tratamento do retorno
            if($statment->execute()){

                if($query_type == "select"){

                    //Retorna um array associativo dos dados
                    $data = $statment->fetchAll(PDO::FETCH_ASSOC);
                    return $data;

                }else if($query_type == "insert" || $query_type == "create" || $query_type == "delete" || $query_type == "update") {

                    return true;

                }

            }else{

                return false;

            }
              
        }

        private function setParams($chave, $valor, $statment){

            $statment->bindParam($chave, $valor);
            
        }

        /////////////////////////////////////////////MÉTODOS CHAMADOS PELA CLASSE PESSOA//////////////////////////////////////////////////////////////////////////////////////

        public function select($query, $params = array()){

            $query_type = "select";
            
            //Recebe um array associativo dos dados, em todos os casos
            $exec_return = $this->queryInit($query_type, $query, $params);

            //Retorna o array associativo dos dados, ou false
            return $exec_return;

        }

        public function insert($query, $params = array()){

            $query_type = "insert";
            
            //Recebe true, ou false
            $exec_return = $this->queryInit($query_type, $query, $params);

            //True ou false
            return $exec_return;

        }

        public function delete($query, $params = array()){

            $query_type = "delete";
            
            //Recebe true, ou false
            $exec_return = $this->queryInit($query_type, $query, $params);

            //True ou false
            return $exec_return;

        }
        
        
    }

?>