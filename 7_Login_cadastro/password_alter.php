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
    <title>Alteração da senha</title>
</head>
<body>
    
    <div class = "actual-form">
        <h2><i class="fas fa-key" style = "color: #FDB813"></i>Alterar senha</h2>
    </div>
    
    <class class = "form-container" style = "width: 350px;">
        <form method = "POST" action = "scripts/php/outside_system/password_modify.php">
            <input type="text" value = "<?php echo $_GET['code']; ?>" name = "code_rec" hidden>
            <div class="mb-3">
              <label for="pass_alter" class="form-label">Nova senha</label>
              <input type="password" class="pass_alter" id="pass_alter" name = "pass_alter" required>
            </div>
            <button type="submit" class="btn btn-warning" name = "new_pass_btn">Confirmar nova senha</button>
        </form>
    </div>

    <div class = "msg-container" style = "margin-top: 15px;">
      <?php
        if(isset($_SESSION['error_msg'])){

          echo "<div class='alert alert-danger' role='alert'>
            {$_SESSION['error_msg']}
          </div>";

          unset($_SESSION['error_msg']);

        }
      ?>
    </div>

</body>
</html>