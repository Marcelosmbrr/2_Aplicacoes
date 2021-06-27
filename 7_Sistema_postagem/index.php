<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="display/css/display.css">
    <script src="https://kit.fontawesome.com/49b7b83709.js" crossorigin="anonymous"></script>
    <title>Logar</title>
</head>
<body>
    
    <div class = "actual-form">
        <h2><i class="fas fa-sign-in-alt" style = "color: #FDB813;"></i> Logar </h2>
    </div>
    
    <class class = "form-container">
        <form method = "POST" action = "scripts/php/login_verification.php">
            <div class="mb-3">
              <label for="username_login" class="form-label">Nome de usuário</label>
              <input type="text" class="form-control" id="username_login" name = "username_login" placeholder="Digite seu nome de usuário" required>
            </div>
            <div class="mb-3">
              <label for="password_login" class="form-label">Senha</label>
              <input type="password" class="form-control" id="password_login" name = "password_login" placeholder="Digite a sua senha" required>
            </div>
            <button type="submit" class="btn btn-warning" name = "login_btn">Logar</button>
            <a href="register.php"><button type = "button" class="btn btn-warning">Sign-up</button></a>
            <a href="password_recovery.php" class = "link_pass_recovery">Esqueceu a senha?</a>
          </form>
    </div>

    <div class = "msg-container" style = "margin-top: 15px;">
      <?php
        if(isset($_SESSION['error_msg'])){

          echo "<div class='alert alert-danger' role='alert'>
            {$_SESSION['error_msg']}
          </div>";

          unset($_SESSION['error_msg']);

        }else if(isset($_SESSION['success_msg'])){

          echo "<div class='alert alert-success' role='alert'>
            {$_SESSION['success_msg']}
          </div>";

          unset($_SESSION['success_msg']);

        }
      ?>
    </div>

</body>
</html>