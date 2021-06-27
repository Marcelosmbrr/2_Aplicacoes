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
    <title>Registrar</title>
</head>
<body>
    
    <div class = "actual-form">
        <h2><i class="fas fa-user-plus" style = "color: #FDB813;"></i> Registrar </h2>
    </div>
    
    <class class = "form-container">
        <form method = "POST" action = "scripts/php/register_verification.php" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="username_reg" class="form-label">Nome de usuário</label>
              <input type="text" class="form-control" id="username_reg" name = "username_reg" placeholder="Escolha um nome de usuário" required>
            </div>
            <div class="mb-3">
              <label for="email_reg" class="form-label">E-mail</label>
              <input type="text" class="form-control" id="email_reg" name = "email_reg" placeholder="Informe o seu email" required>
            </div>
            <div class="mb-3">
              <label for="password_reg" class="form-label">Senha</label>
              <input type="password" class="form-control" id="password_reg" name = "password_reg" placeholder="Escolha uma senha" required>
            </div>
            <div class="mb-3">
              <label for="file_reg" class="form-label">Imagem para o perfil de usuário (opcional)</label>
              <!-- O usuário pode cadastrar uma foto, ou não. Se não cadastrar terá uma "padrão". -->
              <input class="form-control" type="file" id="file_reg" name = "file_reg" accept=".jpg, .jpeg, .png">
            </div>
            <button type="submit" class="btn btn-warning" name = "reg_btn">Registrar</button>
            <a href="index.php"><button type = "button" class="btn btn-warning">Log-in</button></a>
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