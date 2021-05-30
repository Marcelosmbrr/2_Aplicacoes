<?php

    require_once("C:/xampp/htdocs/proj_biblioteca/vendor/autoload.php");
    use Instances\instance_controller;
    use Classes\controller;

    header('Content-Type: application/json');

    //PRIMEIRO CARREGAMENTO DA PÁGINA //LISTAGEM DOS LIVROS
    if(isset($_POST['load_table']) && ($_POST['load_table'] == "books" || $_POST['load_table'] == "students" || $_POST['load_table'] == "areas" || $_POST['load_table'] == "loans")){

        $obj = instance_controller::getInstance();

        //Recebe um array com a tabela string
        if($_POST['load_table'] == "books"){
            $str_tb = $obj->showBooks();
        }else if($_POST['load_table'] == "students"){
            $str_tb = $obj->showStudents();
        }else if($_POST['load_table'] == "areas"){
            $str_tb = $obj->showAreas();
        }else if($_POST['load_table'] == "loans"){
            $str_tb = $obj->showLoans();
        }

        //Sessão será de "livros"
        $_SESSION['actual_table'] = $_POST['load_table']; 

        //Retorna para o Ajax os dados, em formato Json
        echo json_encode($str_tb);

    }

    //LISTAGEM DE LIVROS A PARTIR DA SELEÇÃO NO MENU
    if(isset($_POST['all_books'])){

        $obj = instance_controller::getInstance();

        //Recebe um array com a tabela string
        $str_tb = $obj->showBooks();

        //Sessão será de "livros"
        $_SESSION['actual_table'] = "livros"; 

        //Retorna para o Ajax os dados, em formato Json
        echo json_encode($str_tb);


    }

    //LISTAGEM DE ÁREAS A PARTIR DA SELEÇÃO NO MENU
    if(isset($_POST['all_areas'])){

        $obj = instance_controller::getInstance();

        //Recebe um array com a tabela string
        $str_tb = $obj->showAreas();
        //echo $str_tb; die();

        //Sessão será de "livros"
        $_SESSION['actual_table'] = "areas"; 

        //Retorna para o Ajax os dados, em formato Json
        echo json_encode($str_tb);

    }

    //LISTAGEM DE ALUNOS A PARTIR DA SELEÇÃO NO MENU
    if(isset($_POST['all_students'])){

        $obj = instance_controller::getInstance();

        //Recebe um array com a tabela string
        $str_tb = $obj->showStudents();
        //echo $str_tb; die();

        //Sessão será de "livros"
        $_SESSION['actual_table'] = "alunos"; 

        //Retorna para o Ajax os dados, em formato Json
        echo json_encode($str_tb);


    }

    //LISTAGEM DE RESERVAS A PARTIR DA SELEÇÃO NO MENU
    if(isset($_POST['all_loans'])){

        $obj = instance_controller::getInstance();

        //Recebe um array com a tabela string
        $str_tb = $obj->showLoans(null,null);
        //echo $str_tb; die();

        //Sessão será de "livros"
        $_SESSION['actual_table'] = "reservas"; 

        //Retorna para o Ajax os dados, em formato Json
        echo json_encode($str_tb);


    }

    //CADASTRAR NOVO LIVRO 
    if(isset($_POST['new_book'])){

        if(!empty($_POST['new_book'])){
            print_r($_POST['new_book']); die();
            
             $title = $_POST['new_book']['s_tittle'];
             $author = $_POST['new_book']['s_author'];
             $area = $_POST['new_book']['s_area'];
 
             //Instanciação da classe controller
             $obj = instance_controller::getInstance();
 
             $register = $obj->newBook($title,$author,$area);
 
             echo json_encode($register);
 
         }


    }

    //EDITAR LIVRO
    if(isset($_POST['edit_book'])){

        if(!empty($_POST['edit_book'])){
           //print_r($_POST['new_student']); die();

            $id = $_POST['edit_book']['id'];
            $title = $_POST['edit_book']['title'];
            $author = $_POST['edit_book']['author'];
            $area = $_POST['edit_book']['area'];
            //echo "$id, $title, $author, $area"; die();

            //Instanciação da classe controller
            $obj = instance_controller::getInstance();

            $register = $obj->updateBook($id,$title,$author,$area);

            echo json_encode($register);

        }
        
    }

    //CADASTRAR NOVO ALUNO
    if(isset($_POST['new_student'])){

        if(!empty($_POST['new_student'])){
           //print_r($_POST['new_student']); die();

            $name = $_POST['new_student']['name'];
            $email = $_POST['new_student']['email'];
            $cpf = $_POST['new_student']['cpf'];
            $data = $_POST['new_student']['date'];
            //echo "$name, $email, $cpf, $data"; die();

            //Instanciação da classe controller
            $obj = instance_controller::getInstance();

            $register = $obj->newStudent($name,$email,$cpf,$data);

            echo json_encode($register);

        }
        
    }

    //EDITAR ALUNO
    if(isset($_POST['edit_student'])){

        if(!empty($_POST['edit_student'])){
           //print_r($_POST['edit_student']); die();

            $id = $_POST['edit_student']['matricula'];
            $name = $_POST['edit_student']['name'];
            $email = $_POST['edit_student']['email'];
            $cpf = $_POST['edit_student']['cpf'];
            $data = $_POST['edit_student']['date'];
            //echo "$name, $email, $cpf, $data"; die();

            //Instanciação da classe controller
            $obj = instance_controller::getInstance();

            $register = $obj->editStudent($id,$name,$email,$cpf,$data);

            echo json_encode($register);

        }
        
    }

    //EDITAR ÁREA
    if(isset($_POST['edit_area'])){

        if(!empty($_POST['new_student'])){
           //print_r($_POST['new_student']); die();

            $name = $_POST['new_student']['name'];
            $email = $_POST['new_student']['email'];
            $cpf = $_POST['new_student']['cpf'];
            $data = $_POST['new_student']['date'];
            //echo "$name, $email, $cpf, $data"; die();

            //Instanciação da classe controller
            $obj = instance_controller::getInstance();

            $register = $obj->newStudent($name,$email,$cpf,$data);

            echo json_encode($register);

        }
        
    }

    //REALIZAR EMPRÉSTIMO

    //REALIZAR DEVOLUÇÃO

    /*//PESQUISA NO INPUT DE PESQUISA //RECUPERA O VALOR DA SESSION
    if(isset($_POST['do_search']) && isset($_SESSION['actual_table'])){

        if(!empty($_POST['do_search'])){

            //Recuperação da sessão atual
            $search_table = $_SESSION['actual_table'];

            //Primeira filtragem dos dados, seja o que for
            $dsearch = filter_input(INPUT_POST, "do_search", FILTER_SANITIZE_STRING);
        
            //Segunda filtragem dos dados, seja o que for
            $dsearchf = strip_tags($dsearch);

            //Terceira filtragem dos dados, seja o que for
            $dsearchff = trim($dsearchf);

            //Instanciação da classe controller
            $obj = instance_controller::getInstance();

            //A depender do tipo da sessão, mudarão as circunstâncias da pesquisa
            switch($search_table){

                case "books": //Neste caso a pesquisa será por livros

                    //Especificação da pesquisa 
                    $where = "WHERE titulo LIKE '%:pesquisa%' OR autor LIKE '%:pesquisa%'";
                    $params = array(":pesquisa"=>$dsearchff);

                    //Recebe um array com a tabela e o input de pesquisa, ambos string
                    $str_tb = $obj->showBooks($where,$params);

                    echo json_encode($str_tb);
                
                break;

                case "areas": //Neste caso a pesquisa será por áreas

                    //Especificação da pesquisa 
                    $where = "WHERE nome_area LIKE '%:pesquisa%'";
                    $params = array(":pesquisa"=>$dsearchff);

                    //Recebe um array com a tabela e o input de pesquisa, ambos string
                    $str_tb = $obj->showAreas($where,$params);
                    //echo $str_tb; die();

                    echo json_encode($str_tb);

                break;

                case "students":

                    //Especificação da pesquisa //Por matrícula, nome exato ou aproximado
                    $where = "WHERE matricula LIKE '%:pesquisa%' OR nome LIKE '%:pesquisa%'";
                    $params = array(":pesquisa"=>$dsearchff);

                    //Recebe um array com a tabela e o input de pesquisa, ambos string
                    $str_tb = $obj->showStudents($where,$params);
                    //echo $str_tb; die();

                    echo json_encode($str_tb);

                break;
            }
        }

    }*/

?>