<?php

    //Esta classe contém os métodos que serão chamados no index que caracterizam um CRUD
    //Além disso, ao invés de instanciar, com "new", em cada método um objeto da classe SQL_DAO, chamaremos o método estático da classe SQL_instance

    namespace Classes;
    use Classes\Sql_instance;
    use Classes\Sql_DAO;
    use DateTime;

    class Pessoa_DAO {

        private $id;
        private $nome;
        private $telefone;
        private $email;

    
        public function getId()
        {
            return $this->id;
        }
 
        public function setId($id)
        {
            $this->id = $id;

        }

        public function getNome()
        {
            return $this->nome;
        }

        public function setNome($nome)
        {
            $this->nome = $nome;

        }

        public function getTelefone()
        {
            return $this->telefone;
        }

        public function setTelefone($telefone)
        {
            $this->telefone = $telefone;          
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($dtcadastro)
        {
            $this->dtcadastro = $dtcadastro;

        }

        //Poderia ser uma função estática..
        public static function loadAll(){

            //Query SQL
            $query = "SELECT * FROM pessoas"; 

            //Especificações/parâmetros da Query
            $params = array(); 

            $obj_sql = Sql_instance::getInstance();
            
            //Recebe um array associativo de todos os registros
            $return_select = $obj_sql->select($query, $params);

            //Enviaremos o array associativo retornado do método SELECT, da classe Sql_instance, direto
            return $return_select;

        }

        public function cadastrarPessoa($nome, $telefone, $email){

            //Query SQL
            $query = "INSERT INTO pessoas (id, nome, telefone, email) VALUES (DEFAULT, :nome, :telefone, :email)"; 

            //Especificações/parâmetros da Query
            $params = array(":nome"=>$nome, ":telefone"=>$telefone, ":email"=>$email); 

            $obj_sql = Sql_instance::getInstance();

            //Recebe true, ou false
            $return_insert = $obj_sql->insert($query, $params);

            //True ou false
            return $return_insert;


        }

        public function deletebyID($id){

            //Query SQL
            $query = "DELETE FROM pessoas WHERE id = :ID"; 

            //Especificações/parâmetros da Query
            $params = array(":ID"=>$id); 

            $obj_sql = Sql_instance::getInstance();

            //Recebe true, ou false
            $return_delete = $obj_sql->delete($query, $params);

            //True ou false
            return $return_delete;


        }

    }


?>