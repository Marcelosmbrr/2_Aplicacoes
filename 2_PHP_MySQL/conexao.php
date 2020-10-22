<?php

    //Este é o arquivo utilizado para estebelecer uma conexão com o banco de dados
    

    $server = "localhost";
    $user = "root";
    $pass = null; /* se o banco não tiver senha*/
    $base_dados = "empresa_cadastro";
    
    //A variável $conn recebe o retorno da função que conecta ao banco de dados
    //O retorno desta função é a própria conexão ao banco
    if($conn = mysqli_connect($server, $user, $pass, $base_dados)){
        // echo "<p> Conectado! </p>";
    }
    else{
        echo "<p> Erro!Falha na conexão com a base de dados! </p>";
    }
    
    // Esta função será chamada no caso TRUE da função mysqli_query, do arquivo cadastro_script
    function mensagem($texto, $alert){
        
        echo "<div class='alert alert-$alert' role='alert'> $texto </div>";
        // Código do bootstrap alerts //Cada alert tem uma classe pre-definida
        // Repare no nome da classe. No boostrap, cada alert se diferencia apenas pelo termo após o alert-
        /* Por isso usaremos uma variável, que irá conter um entre dois termos, que dão acesso a um outro alert do boostrap*/
        //Veja: https://getbootstrap.com/docs/4.5/components/alerts/
        

    }