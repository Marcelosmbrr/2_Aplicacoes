<?php

  session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS_login/css.css">
    <script src="https://kit.fontawesome.com/49b7b83709.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS_sistema/icons-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <title>Banco de Dados - Login</title>
</head>
<body>

     <div class = "container-flex">

        <div class = "container-login">

            <h2> <i class="fas fa-database"></i> Login do sistema</h2>

            <div class = "container-formulario">
                <form action="http://localhost/1_Projetos/4_Banco_dados/Scripts_PHP/script_login.php" method="GET">
                    <div class="form-group">
                      <label for="username_input">Nome de usuário</label>
                      <input type="text" class="form-control" id="username_input" name="username">
                      <small id="emailHelp" class="form-text text-muted"> <p>Digite seu nome de usuário do sistema</p> </small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="senha">
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                      <label class="form-check-label" for="exampleCheck1">Confirmo meus dados</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Logar</button>
                  </form>
            </div>

            <div class =  "erro-acesso">
              <a href="#">Não consigo acessar</a>
            </div>
              
        </div>
     </div>

</body>
</html>