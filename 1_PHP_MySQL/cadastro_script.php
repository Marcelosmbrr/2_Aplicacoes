<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Cadastro</title>
  </head>
  <body>
      <div class = "container">
          <div class = "linha">
              <?php
              
                include "conexao.php";
                
                /* Recuperação dos dados do formulário do arquivo index*/
                $nome = isset($_POST["nome"]) ? $_POST["nome"] : null;
                $endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : null;
                $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : null;
                $email = isset($_POST["email"]) ? $_POST["email"] : null;
                $data_nascimento = isset($_POST["data_nascimento"]) ? $_POST["data_nascimento"] : null;
                
                //Esta variável contém o comando INSERT da base de dados 'pessoas' do banco de dados
                //Significa "inserir na base de dados 'pessoas', que contém os seguintes campos ( ), estes valores ( ), respectivamente
                $sql = "INSERT INTO `pessoas`" . "(`nome`, `endereco`, `telefone`, `email`, `data_nascimento`) VALUES " . "('$nome','$endereco','$telefone','$email','$data_nascimento')";
                
                //Usamos o comando mysqli_query que realiza uma requisição/consulta no banco, considerando os parâmetros
                //Neste caso, a var conn contém a função mysqli_connect, que é uma função que requisita uma consulta ao banco de dados
                //E a var sql contém, como visto acima, o comando de INSERT, de inserção de dados no banco, ou especificamente, no seu caso, na base de dados 'pessoas' do banco
                //Se a requisição retornar TRUE (mysqli_result), significa que (i) a conexão fora estabelecida, e (ii) fora realizado o comando contido na variável $sql
                if (mysqli_query($conn, $sql)){
                    mensagem("$nome cadastrado com sucesso!", 'success');
                    //Se der certo, a função 'mensagem' será chamada //Está implementada no arquivo conexao.php
                }else{
                    mensagem("ERRO!$nome não foi cadastrado!", 'danger');
                    //Se der errado, a mesma função 'mensagem' será chamada, mas parâmetros diferentes
                }
                
              ?>
              <a href="Index.php" class = "btn btn-primary">VOLTAR
              </a>
          </div> 
      </div>
      
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>