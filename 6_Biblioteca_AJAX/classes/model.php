<?php

    //require autoload
    namespace Classes;
    use Classes\controller;
    use Instances\instance_sql;
    use PDO;
    
    class model{

        //Pesquisa por livros: pode receber especificações e parâmetros, se não será uma pesquisa universal
        public function getBooks($where=NULL, $params=NULL){

            $sql = "SELECT a.id, a.titulo, a.autor, a.status, b.nome_area FROM tb_livro a LEFT OUTER JOIN tb_area b ON a.id_area = b.id $where";

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->select($sql,$params);

            return $data;

        }

        //Pesquisa por áreas: pode receber especificações e parâmetros, se não será uma pesquisa universal
        public function getAreas($where=NULL, $params=NULL){

            $sql = "SELECT * FROM tb_area $where";

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->select($sql,$params);

            return $data;

        }

        //Pesquisa por alunos: pode receber especificações e parâmetros, se não será uma pesquisa universal
        public function getStudents($where=NULL, $params=NULL){

            $sql = "SELECT * FROM tb_aluno $where";

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->select($sql,$params);

            return $data;

        }

        //Pesquisa por reservas realizadas: pode receber especificações e parâmetros, se não será uma pesquisa universal
        public function getLoans($where=NULL, $params=NULL){

            $sql = "SELECT a.id, c.titulo, b.nome, a.data_retirada, a.data_entrega
            FROM tb_reserva a LEFT OUTER JOIN tb_aluno b ON a.matricula_aluno = b.matricula LEFT JOIN tb_livro c ON a.id_livro = c.id $where";

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->select($sql,$params);

            return $data;

        }

        //REGISTRO LIVRO
        public function setBook($title, $author, $area){
            echo "$title, $author, $area"; die();

            $sql = "INSERT INTO tb_livro (id, titulo, autor, `status`, id_area) VALUES (DEFAULT, :titulo, :autor, DEFAULT, :area)";
            $params = array(":titulo"=>$title, ":autor"=>$author, ":area"=>$area); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->insert($sql,$params);

            return $data;

        }

        //REGISTRO ALUNO
        public function setStudent($name,$email,$cpf,$data){
            //echo "$name, $email, $cpf, $data"; die();

            $sql = "INSERT INTO tb_aluno VALUES (DEFAULT, :nome, :email, :cpf, :dt)";
            $params = array(":nome"=>$name, ":email"=>$email, ":cpf"=>$cpf,":dt"=>$data); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->insert($sql,$params);

            return $data;

        }

        //EDIÇÃO DE ALUNO
        public function updateStudent($id,$name,$email,$cpf,$data){
            //echo "$name, $email, $cpf, $data"; die();

            $sql = "UPDATE tb_aluno SET nome = :nome, email = :email, cpf = :cpf, data_nasc = :dt WHERE matricula = :matr";
            $params = array(":matr"=>$id, ":nome"=>$name, ":email"=>$email, ":cpf"=>$cpf,":dt"=>$data); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->update($sql,$params);

            return $data;

        }

        //EDIÇÃO DE LIVRO
        public function updateBook($id,$title,$author,$area){
            //echo "$id,$title,$author,$area"; die();

            $sql = "UPDATE tb_livro SET titulo = :title, autor = :author, `status` = DEFAULT, id_area = :area WHERE id = :id_book";
            $params = array(":id_book"=>$id, ":title"=>$title, ":author"=>$author, ":area"=>$area); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->update($sql,$params);

            return $data;

        }





        //métodos = chamar os métodos do sql_model
        //Vão realizar a execução do Statment Object

    }