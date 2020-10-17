<?php

    //Dados de conexão com o banco
    //$username = "root"; $pass = ""; $dsn = "mysql:host=localhost;dbname=first_crud";
    
    require_once 'Classe_pessoa.php';
    
    //Instanciado um objeto da classe pessoa e chamando os métodos
    $pessoa_obj = new Classe_pessoa();
    $pessoa_obj->conexao("mysql:host=localhost;dbname=first_crud", "root", "");
    
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Cadastro</title>
    <style>
        body{
            background-color: whitesmoke;
        }
        .container{
            margin-top: 30px;
        }
        nav{
            box-shadow: 0px 3px 14px 0px rgba(0,0,0,0.75);
        }
        #pesquisar{
            box-shadow: none;
            padding-left: 0;
        }
        button{
            margin-left: 3px;
        }
       
    </style>
  </head>
  <body>
      
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <h1><img src="crud_material/banco-dados.png" width="150px" alt="alt"/></h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="">Atualizações<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="Cadastro_home.html">Deslogar<span class="sr-only">(current)</span></a>
            </li> 
          </ul>
        </div>
    </nav>
    
      <div class = "container">
          <div class = "linha">
              <div class = "coluna">
                 <h1>Pesquisar</h1>
                 <nav class="navbar navbar-light bg-light" id = "pesquisar">
                     <form class="form-inline" action="interface_adm.php" method="POST"> <!-- Dados serão enviados para o próprio arquivo pesquisa.php -->
                         <input class="form-control mr-sm-2" type="search" placeholder="Nome" aria-label="Search" name = "nome_busca" autofocus> 
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                    </form>
                 </nav>
                 
                 <table class="table table-hover">
                    <thead>
                      <tr>
                          
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Data de nascimento</th>
                        <th scope="col">Email</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">estado</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                                
                                //Chamando método buscarDados
                                //Array_registros recebe o retorno do método //Que é o retorno da função count()
                                $array_registros = $pessoa_obj->buscarDados("SELECT codigo, nome, cpf, sexo, data_nasc, email, cidade, estado FROM cadastros");
                                
                                //Variável recebe número de linhas do array_registros
                                $num_registros = count($array_registros);
                                
                                //Inserção dos dados em uma tabela HTML //Explicação
                                if($num_registros > 0){ 
                                     //No for, criamos o laço que percorre as linhas da matriz
                                    //Número de linhas da matriz é igual ao retorno da função count
                                    for($linha = 0; $linha < $num_registros; $linha ++ ){
                                        //O echo abaixo abre a tag de linha da tabela //Tr = table row
                                        echo "<tr>";
                                        //No foreach percorremos as colunas da matriz
                                        foreach($array_registros[$linha] as $coluna => $valor){
                                            //No echo abaixo usamos o valor de cada coluna lida para preencher um td //Td = table data
                                            //A cada laço do foreach, (1) o valor da coluna da linha da matriz é lida, (2) um td é criado, e (3) seu valor é o da coluna lida
                                           echo "<td scope='row'>$valor</td>";
                                        }
                                        //O laço do foreach acaba quando forem percorridas todas as colunas da linha da matriz
                                        //Neste ponto, a linha da matriz, com suas colunas e valores, já foram inseridos na linha da tabela //Todos os TD foram criados na TR
                                        //Mas ainda faltam os botões de "editar" e "excluir" que devem existir ao final de todas as linhas
                                     
                            ?>
                            <!-- Apesar da tag php ter sido fechada, logo acima, o bloco de código For, que percorre as linhas, não foi -->
                            <!-- Desta forma, esta tag abaixo, de TD com botões é, ainda, outro Table Data da atual Table Row -->
                            <!-- Agora haverá um Table Data a mais, em cada linha, que terá dois botões como conteúdo -->
                            <td>
                                <a href=""><button type='button' class='btn btn-primary btn-sm'>Editar</button></a>
                                <!-- Fizemos um GET artificial no link do botão excluir, abaixo -->
                                <a href="Interface_adm.php?codigo=<?php echo $array_registros[$linha]['codigo']; ?>"><button type='button' class='btn btn-primary btn-sm'>Excluir</button></a>
                            </td>
                            <?php
                                //Dentro desta tag php, reaberta, iremos fechar a atual Table Row
                                echo "<tr>";
                                //Abaixo está o fechamento do laço de leitura da atual linha da matriz
                                //Se não for a última, o processo irá reiniciar, e se for, será terminado
                                    }
                                //Neste ponto toda matriz, com suas linhas e colunas, foi transposta para uma tabela HTML
                                //Abaixo fechamos o If
                                }
                            ?>
                 
                    </tbody>
                 </table>
              </div>
          </div> 
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>


<?php
    
    //Recuperação do GET artificial do botão de Excluir
    
    if(isset($_GET['codigo'])){
        $codigo = addslashes($_GET['codigo']);
        $pessoa_obj->excluirPessoa($codigo);
        echo "<script language='javascript'>window.location.href='Interface_adm.php';</script>";
                    
    }
 
?>