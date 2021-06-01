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
            //echo "$title, $author, $area"; die();

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

        //REGISTRO ÁREA
        public function setArea($area){

            $sql = "INSERT INTO tb_area VALUES (DEFAULT, :nome_area)";
            $params = array(":nome_area"=>$area); 

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

        //EDIÇÃO DE LIVRO
        public function updateArea($area,$area_name){

            $sql = "UPDATE tb_area SET nome_area = :nome_area WHERE id = :area_id";
            $params = array(":nome_area"=>$area_name,":area_id"=>$area); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->update($sql,$params);

            return $data;

        }

        //REALIZAR EMPRÉSTIMO
        public function setLoan($book,$student,$date){
            //echo "$book,$student,$date"; die();

            $sql = "INSERT INTO tb_reserva (id, `status`, data_retirada, data_entrega, matricula_aluno, id_livro) VALUES (DEFAULT, :stat, CURDATE(), :date_f, :student, :book);";
            $params = array(":stat"=>true, ":date_f"=>$date, ":student"=>$student,":book"=>$book); 

            $sql_obj = instance_sql::getInstance();

            $retloan = $sql_obj->insert($sql,$params);

            //Se o empréstimo for realizado
            if($retloan){

                //O livro que foi emprestado deve ter seu status alterado para TRUE
                $sql = "UPDATE tb_livro SET `status` = :borrowed WHERE id = :borrowed_book";
                $params = array(":borrowed"=>true, ":borrowed_book"=>$book);

                $change_status = $sql_obj->update($sql,$params);

                if($change_status){

                    return $change_status;

                }else{

                    return "Empréstimo: true, change status: false";
                }

            }else{

                return "Empréstimo: false";
            }

        }

        //EXCLUIR LIVRO
        public function deleteBook($id_book){

            $sql = "DELETE FROM tb_livro WHERE id = :id_book";
            $params = array(":id_book"=>$id_book); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->delete($sql,$params);

            return $data;

        }

        //EXCLUIR ALUNO
        public function deleteStudent($id_student){

            $sql = "DELETE FROM tb_aluno WHERE matricula = :matricula_aluno";
            $params = array(":matricula_aluno"=>$id_student); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->delete($sql,$params);

            return $data;

        }

        //EXCLUIR ÁREA
        public function deleteArea($id_area){

            $sql = "DELETE FROM tb_area WHERE id = :id_area";
            $params = array(":id_area"=>$id_area); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->delete($sql,$params);

            return $data;

        }

        //EXCLUIR EMPRÉSTIMO/FAZER DEVOLUÇÃO
        public function deleteLoan($loan_id, $book_id){

            //Deletar registro do empréstimo
            $sql = "DELETE FROM tb_reserva WHERE id = :id_loan";
            $params = array(":id_loan"=>$loan_id); 

            $sql_obj = instance_sql::getInstance();

            $data = $sql_obj->delete($sql,$params);

            if($data){

                //A devolução foi realizada e o status do livro deve mudar para false
                $sql = "UPDATE tb_livro SET `status` = :returned WHERE titulo = :returned_book";
                $params = array(":returned"=>false, ":returned_book"=>$book_id); 

                $change_status = $sql_obj->update($sql,$params);

                if($change_status){

                    return true;

                }else{

                    return "Devolução: true, change status: false";
                }


            }else{

                return "Devolução: false";
            }

        }





        //métodos = chamar os métodos do sql_model
        //Vão realizar a execução do Statment Object

    }