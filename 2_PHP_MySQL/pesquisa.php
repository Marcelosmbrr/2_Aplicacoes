<!doctype html>
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
       
    </style>
  </head>
  <body>
      
      <?php
      
          
          $pesquisa = isset($_POST["nome_busca"]) ? $_POST["nome_busca"] : '';
 
          
          include 'conexao.php';
          
          // SELECIONE tudo DE pessoas ONDE nome FOR IGUAL A $pesquisa // Sendo: pessoas = base de dados 'pessoas', nome = um dos campos desta base
          //OBS: Se var for string, %var% = primeiro e último caractere desta string
          $sql = "SELECT * FROM pessoas WHERE nome LIKE '%$pesquisa%'"; 
          
          //A variável $dados irá receber ou "False" se a query falhar, ou "mysqli_result" se der certo
          $dados = mysqli_query($conn, $sql);
          
           ?>
      
      
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1>PHP-DB</h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>          
          </ul>
        </div>
    </nav>
      
      
      <div class = "container">
          <div class = "linha">
              <div class = "coluna">
                 <h1>Pesquisar</h1>
                 <nav class="navbar navbar-light bg-light" id = "pesquisar">
                     <form class="form-inline" action="pesquisa.php" method="POST"> <!-- Dados serão enviados para o próprio arquivo pesquisa.php -->
                         <input class="form-control mr-sm-2" type="search" placeholder="Nome" aria-label="Search" name = "nome_busca" autofocus> 
                      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                    </form>
                 </nav>
                 
                 <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Data de nascimento</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        
                        
                            //AQUI ESTAMOS INSERINDO A BUSCA EM UMA TABELA HTML, DINAMICAMENTE*/
                            //
                            //"mysqli_fetch_assoc" é usado com o resultado de mysqli_query
                            //O que esta função faz é criar um array que representa a linha do dado retornado do "mysqli_query"
                            
                            while($linha = mysqli_fetch_assoc($dados)){
                                //Se $dados recebeu do Banco a linha referente ao nome X procurado por SELECT no mysqli_query 
                                //$linha irá receber esta mesma linha, mas em forma de um array estruturado //$linha = {cod_pessoa: de X , nome: X, endereco: de X, ...}
                                $cod_pessoa = $linha['cod_pessoa'];
                                $nome = $linha['nome'];
                                $endereco = $linha['endereco'];
                                $telefone = $linha['telefone'];
                                $email = $linha['email'];
                                $data_nascimento = $linha['data_nascimento'];
                                
                                
                                //Os dados de cada campo foram recuperados acima, e postos em variáveis adequadas
                                //Utilizamos essas variáveis para criar dinamicamente a tabela HTML
                                //Cada variável será um Table Data, ou "<td></td>, que é o conteúdo de uma linha (Table Row, <tr></tr>)
                                
                                 echo "<tr>
                                    <th scope='row'>$nome</th>
                                    <td>$endereco</td>
                                    <td>$telefone</td>
                                    <td>$data_nascimento</td>
                                    <td>$email</td>
                                  </tr>";
                      
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