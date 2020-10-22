        <?php
                         
            //Recuperação dos dados do formulário do arquivo cadastro_form
            $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : null;
            $senha = isset($_POST["senha"]) ? $_POST["senha"] : null;

            //Declaração dados de conexão
            $username = "root";
            $pass = "";
            $dsn = "mysql:host=localhost;dbname=first_crud";

            //Conexão
            if($conn = new PDO($dsn, $username, $pass)){

                $stmt = $conn->prepare("SELECT `usuario` FROM `bd_admin` WHERE `usuario` = :usuario");
                $stmt->bindParam(":usuario", $usuario);
                $stmt->execute(); 
                if($fetch = $stmt->fetch()){
                     echo"<script language='javascript' type='text/javascript'>
                    alert('Bem vindo {$usuario}!');window.location
                    .href='Interface_adm.php';</script>";
                    die(); //die = exit()
                    
                }
                else{
                    echo"<script language='javascript' type='text/javascript'>
                    alert('Login e/ou senha incorretos');window.location
                    .href='Cadastro_login.html';</script>";
                    die(); //die = exit()
                   
                }
            }
      
        ?>