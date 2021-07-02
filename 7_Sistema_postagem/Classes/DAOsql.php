<?php

    //require autoload
    namespace Classes;
    use Instances\InstanceConnection;
    use PDO;

    class DAOsql{

        ////////////////////////////////////////////EXECUÇÃO AUTOMÁTICA DO SQL////////////////////////////////////////////////////////////////////////

        private function queryInit($query_type, $query, $params = array()){

            //InstanceConnection::getInstance() retorna a instância da classe PDO
            $pdo = InstanceConnection::getInstance();

            $statment = $pdo->prepare($query);

            //Se o array de parâmetros não estiver vazio
            if(!empty($params)){

                foreach($params as $chave => $valor){
                    
                    //O bindParam é realizado por meio da chamada deste método, a cada loop
                    $this->setParams($chave, $valor, $statment);
                    
                    }
            }

            //Se a execução da query for um sucesso
            if($statment->execute()){

                //Se o tipo de query for "select"
                if($query_type == "select"){

                    //Retorna um array associativo dos dados, em todos os casos
                    $data = $statment->fetchAll(PDO::FETCH_ASSOC);
                    return array("operation"=>true, "data"=>$data);
                
                //Se não for um "select" irá retornar apenas "true"
                }else if($query_type == "insert" || $query_type == "create" || $query_type == "delete" || $query_type == "update") {

                    return array("operation"=>true, "data"=>'');

                }
            
            //Se não for um sucesso, retornará false
            }else{

                return array("operation"=>false, "data"=>'');

            }

        }

        //Este método realiza o bindParam()
        private function setParams($chave, $valor, $statment){

            $statment->bindParam($chave, $valor);
            
        }

        ////////////////////////////////////////////MÉTODOS PÚBLICOS//////////////////////////////////////////////////////////////////////////////////////

        //Este método executa qualquer SELECT
        public function select($query, $params=NULL){
            
            //Recebe um array associativo dos dados, em todos os casos
            $exec_return = $this->queryInit("select", $query, $params);

            //Um array associativo
            return $exec_return;

        }

        //Este método executa qualquer INSERT
        public function insert($query, $params = array()){
            
            //Recebe true, ou false
            $exec_return = $this->queryInit("insert", $query, $params);

            //True ou false
            return $exec_return;

        }

        //Este método executa qualquer DELETE
        public function delete($query, $params = array()){
            
            //Recebe true, ou false
            $exec_return = $this->queryInit("delete", $query, $params);

            //True ou false
            return $exec_return;

        }

        //Este método executa qualquer UPDATE
        public function update($query, $params = array()){

            //Recebe true, ou false
            $exec_return = $this->queryInit("update", $query, $params);

            //True ou false
            return $exec_return;

        }
    }
            
    