<!doctype html>
<html lang="pt-br">
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
        
    </style>
  </head>
  <body>
      
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
                 <h1>Cadastro</h1>
                 <form action="cadastro_script.php" method="POST">
                     <div class="form-group">
                         <label for="nome">Nome Completo</label>
                         <input type="text" class="form-control" name = "nome" required>
                     </div>
                     <div class="form-group">
                         <label for="endereco">Endereço</label>
                         <input type="text" class="form-control" name = "endereco">
                     </div>
                     <div class="form-group">
                         <label for="telefone">Telefone</label>
                         <input type="text" class="form-control" name = "telefone">
                     </div>
                     <div class="form-group">
                         <label for="email">Email</label>
                         <input type="email" class="form-control" name = "email">
                     </div>
                     <div class="form-group">
                         <label for="email">Data de Nascimento</label>
                         <input type="date" class="form-control" name = "data_nascimento" placeholder="dd/mm/aaaa">
                     </div>
                     <div class="form-group">
                         <input type="submit" class="btn btn-success">
                     </div>
                 </form>
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