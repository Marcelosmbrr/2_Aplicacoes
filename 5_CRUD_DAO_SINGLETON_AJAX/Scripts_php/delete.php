<?php

    require_once("vendor/autoload.php");
    use Classes\Pessoa_instance;
    use Classes\Pessoa_DAO;

    header('Content-Type: application/json');

    //PRIMEIRO FILTRO
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);

    //SEGUNDO FILTRO //PARA IMPEDIR XSS
    //O "f" no final denota que foram "filtrados"
    $idf = strip_tags($id);

    if(!empty($idf)){

        $obj_pessoa = Pessoa_instance::getInstance();

        $delete_return = $obj_pessoa->deletebyID($idf);

        //True ou false
        echo $delete_return;

    }

?>

