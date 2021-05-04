<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro e listagem de usuários</title>
        <link rel="shortcut icon" href="display/img/logo.png"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&family=Josefin+Sans:wght@100&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="display/css/display.css">
    </head>
    <body onload = getRegistros()>

        <header>
            <h1><img src="display/img/logo.png" width = "110px" alt="logo-php"></h1>
            <nav class = "header_menu">
                <ul class = "ul_menu">
                    <li><a href="">Opção 1</a></li>
                    <li><a href="">Opção 2</a></li>
                    <li><a href="">Opção 3</a></li>
                </ul>
            </nav>
        </header>

        <main>

            <section class = "main_left-column">

                <!-- OS DADOS SÃO RECUPERADOS PELO SCRIPT JS, QUANDO O FORMULÁRIO É ENVIADO -->
                <div class = "registro_container">
                    <form class = "formulario_registro">
                        <div class="mb-3">
                            <label for="nome_input" class="form-label">Informe seu nome completo</label>
                            <input type="text" class="form-control" id="nome_input" required>
                        </div>
                        <div class="mb-3">
                            <label for="email_input" class="form-label">Informe seu e-mail de cadastro</label>
                            <input type="email" class="form-control" id="email_input" required>
                        </div>
                        <div class="mb-3">
                            <label for="username_input" class="form-label">Crie seu nome de usuário</label>
                            <input type="text" class="form-control" id="username_input" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha_input" class="form-label">Crie uma senha</label>
                            <input type="password" class="form-control" id="senha_input" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>

                <div class = "alert_msg_reg">
                    <!-- AQUI É IMPRESSO A ESTRUTURA "ALERT" DO BOOTSTRAP - REGISTRO -->
                </div>
            
            </section>

            <section class = "main_center-column">
                <!-- AQUI É IMPRESSA A TABELA DE REGISTROS -->

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Login</th>
                            <th scope="col">Editar ou excluir</th>
                        </tr>
                    </thead>
                    <tbody id = "corpo_tabela">
                        <!-- AQUI SÃO IMPRESSOS OS REGISTROS EXISTENTES -->
                    </tbody>
                </table>

            </section>
            
            <section class = "main_right-column">
                
                <!-- O FORMULÁRIO DE EDIÇÃO E DE EXCLUSÃO SERÃO RENDERIZADOS NESTE CONTAINER VIA AJAX -->
                <div class = "update-delete-container">
                     
                </div>

                <div class = "alert_msg_up-del">
                    <!-- AQUI É IMPRESSO A ESTRUTURA "ALERT" DO BOOTSTRAP - UPDATE -->
                </div>

            </section>
            
        </main>     
    </body>
    <script src="javascript/jquery/jquery-3.5.1.js"></script>
    <script src="javascript/script_ajax.js"></script>
</html>