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
    <title>Sistema</title>
</head>
<body>

        <?php

            if(!empty($_SESSION['user']) && !empty($_SESSION['iduser']) && !empty($_SESSION['user_img'])){

        ?>

                <div class="card" style="width: 18rem;">
                    <?php echo "<img src='users/img/{$_SESSION['user_img']}' class='card-img-top' alt='{$_SESSION['user']} image'>";?>
                    <div class="card-body">
                        <h5 class="card-title">Olá <?php echo $_SESSION['user']; ?>!</h5>
                        <p class="card-text"><i class="fas fa-globe" style = "color: #157347;"></i> User <?php echo $_SESSION['iduser']; ?></p>
                        <a href="scripts/php/logout.php" class="btn btn-primary">Voltar para a tela de login</a>
                    </div>
                </div>
                
        <?php

            }else{

                $_SESSION['login_error'] = "Área restritra!";
                header("location: index.php");

            }

        ?>



    
</body>
</html>