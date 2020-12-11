<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author = "Marcelosmbr">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src = "./Scripts_JS/script.js"></script>
    <link rel="stylesheet" href="./CSS_sistema/css.css">
    <link rel="stylesheet" href="./CSS_sistema/media_querie.css">
    <link rel="stylesheet" href="./CSS_sistema/icons-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/49b7b83709.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body onresize = "viewport_change()">

    <?php 
        //Após o login, este sistema será aberto, e receberá o nome de usuário
        //O nome será usado como referência para: o nome exibido no perfil, e para a consulta da foto respectiva
        $usuario = isset($_POST["username"]) ? $_POST["username"] : null;
    ?>

    <!-- CONTAINER GRID - DIMENSÕES IGUAIS AO BODY - DIVISÃO DA PÁGINA EM 3 COLUNAS -->
    <div id = "grid-container">
        <!-- PRIMEIRA COLUNA - COLUNA DA ESQUERDA -->
        <div class = "coluna colesquerda">
            <nav class = "menu_colesquerda">

                <h2 class = "h2-icon"><i class="fas fa-database"></i></h2>

                <ul class = "colesquerda_ul">
                    <li class = "list-item"><a href="#" class = "a-colesquerda"><i class="fas fa-house-user"></i>Home</a></li>
                    <li class = "list-item"><a href="#" class = "a-colesquerda"><i class="fas fa-bell"></i>Notificações</a></li>
                    <li class = "list-item"><a href="#" class = "a-colesquerda"><i class="fas fa-envelope"></i>Correio</a></li>
                    <li class = "list-item"><a href="#" class = "a-colesquerda"><i class="fas fa-list-alt"></i>Suporte</a></li>
                </ul>

                <button class = "btn-deslogar" onclick = "deslogar()"><i class="fas fa-sign-out-alt"></i> Deslogar</button>
                
            </nav>
        </div>
    
        <!-- SEGUNDA COLUNA - COLUNA CENTRAL - DIVIDA EM DUAS LINHAS, SENDO CADA UMA UMA SECTION  -->
        <main>
            <!-- PRIMEIRA LINHA, PRIMEIRA SECTION -->
            <section class = "perfil-usuario">
                <div class = "caixa-superior">

                    <div class = "div-menu_icon">
                        <i class="fas fa-bars"></i>

                        <!-- Menu Mobile -->
                        <div class = "container-menu-mobile">
                            <ul class = "menu-mobile_ul">
                                <li class = "list-item"><a href="#" class = "a-menumobile"><i class="fas fa-house-user"></i>Home</a></li>
                                <li class = "list-item"><a href="#" class = "a-menumobile"><i class="fas fa-bell"></i>Notificações</a></li>
                                <li class = "list-item"><a href="#" class = "a-menumobile"><i class="fas fa-envelope"></i>Correio</a></li>
                                <li class = "list-item"><a href="#" class = "a-menumobile"><i class="fas fa-list-alt"></i>Suporte</a></li>
                                <li class = "list-item"><a href="#" class = "a-menumobile"><i class="fas fa-sign-out-alt"></i></i>Deslogar</a></li>
                            </ul>

                        </div>
                        
                    </div>

                    <div class = "caixa-superior_dados">
                        <h3> <?php echo $_SESSION['nome_usuario']; ?> </h3> <p><i class="fas fa-globe"></i> Online</p>
                    </div>
                    
                </div>

                <div class = "perfil-banner">

                    <div class = "div-foto_usuario"></div>
                    
                </div>

                <div class = "container-perfil-dados">

                    <div class = "caixa-botao-editar">
                        <button class = "botao btn-editar">Editar foto</button>
                    </div>

                    <div class = "usuario-informacoes">
                        <h2> <?php echo $_SESSION['nome_usuario']; ?> </h2>
                        <p>@administrador</p>
                        <br>
                        <p><i class="far fa-calendar-alt"></i> Entrou em 03/12/2020</p>
                    </div>
                    
                </div>

                <!-- No menu horizontal, cada botão é um label de um input type checkbox -->
                <nav class = "menu-perfil">

                    <ul class = "menu-perfil_ul">
                        <li class = "db_li db_li-primeiro" onclick = "mostrar_clientes()"> <input type="checkbox" id = "check_btn-dados">
                            <label for="check_btn-dados">
                                <a href="#" class = "a-menuhorizontal"><i class="fas fa-eye"></i>Dados</a>
                            </label>
                        </li>
                        <li class = "db_li db_li-segundo"> 
                            <a href="#" class = "a-menuhorizontal" onclick = "pesquisar_cliente()">
                                <span class = "btn_pesquisar_text">
                                    <i class="fas fa-search"></i>
                                    Pesquisar
                                </span>
                                <form class="form-inline" action="interface_adm.php" method="POST"> <!-- Dados serão enviados para o próprio arquivo pesquisa.php -->
                                    <input class="form-control mr-sm-2" type="search" placeholder="Código, nome e CPF" aria-label="Search" name = "nome_busca" autofocus> 
                                    <button class="btn btn-outline-success my-2 my-sm-0" id = "btn-pesquisar" type="submit"><i class="fas fa-search"></i></button>
                                 </form>
                            </a>
                        </li>
                    </ul>

                </nav>
            </section>

            <!-- SEGUNDA LINHA, SEGUNDA SECTION - COMEÇA APÓS O MENU HORIZONTAL -->
            <section class = "container-conteudo">

                <div class = "div-conteudo">
                    <table class="table-clientes table-hover">
                            <thead>
                            <tr> 
                                <th scope="col">Código</th>
                                <th scope="col">Nome</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">Estado</th>
                            </tr>
                            </thead>
                            <tbody>

                                    <?php

                                        
                                        

                                        
                                        
                                    ?>

                            </tbody>
                    </table>
                    <h1>PROJETO EM ANDAMENTO</h1>
                </div>

            </section>
    
        </main>

        <!-- TERCEIRA COLUNA - COLUNA DA DIREITA -->
        <div class = "coluna coldireita">

            <div class = "container_atualizacoes"> 

                <div class = "atualizacoes-cabecalho">
                    <h3><i class="fas fa-file-signature"></i> Registro de atualizações</h3>
                    <input type="checkbox" id = "check">
                    <label for="check">
                        <div id = "toggle-effect"></div><button class = "btn-toggle" onclick = "botaoToggle()">Off</button>
                    </label>
                </div>

                <ul class = "menu-atualizacoes">
                    <li class = "li-toggle"></li> <!-- para dar um espaço -->
                    <li class = "list-item-att">
                        <div class = "user-att-foto"><img src="img/user2.png" alt=""></div>
                        <div class = "text-att"><p>{{ action }} </p></div>
                        <div class = "att-time"><i class="fas fa-hourglass-half"></i> {{ time }}</div>
                    </li>
                    <li class = "list-item-att">
                        <div class = "user-att-foto"><img src="img/user1.png" alt=""></div>
                        <div class = "text-att"><p>{{ action }}</p></div>
                        <div class = "att-time"><i class="fas fa-hourglass-half"></i> {{ time }}</div>
                    </li>
                    <li class = "list-item-att">
                        <div class = "user-att-foto"><img src="img/user2.png" alt=""></div>
                        <div class = "text-att"><p>{{ action }}.</p></div>
                        <div class = "att-time"><i class="fas fa-hourglass-half"></i> {{ time }}</div>
                    </li>
                    <li class = "list-item-att">
                        <div class = "user-att-foto"><img src="img/user2.png" alt=""></div>
                        <div class = "text-att"><p>{{ action }} .</p></div>
                        <div class = "att-time"><i class="fas fa-hourglass-half"></i> {{ time }}</div>
                    </li>
                    <li class = "list-item-att">
                        <div class = "user-att-foto"><img src="img/user1.png" alt=""></div>
                        <div class = "text-att"><p>{{ action }}.</p></div>
                        <div class = "att-time"><i class="fas fa-hourglass-half"></i> {{ time }}</div>
                    </li>
                    <li class = "list-item-att">
                        <div class = "user-att-foto"><img src="img/user1.png" alt=""></div>
                        <div class = "text-att"><p>{{ action }} .</p></div>
                        <div class = "att-time"><i class="fas fa-hourglass-half"></i> {{ time }}</div>
                    </li>
                </ul>

            </div>

        </div>
    
    </div>

    </div>
    <!-- FIM DO CONTAINER GRID -->

    <!-- JQUERY-->
    <script>

        $(".btn-publicar").click(() => {
            $(".container_publicacao").fadeIn(500);
        });

        $(".btn-close").click(() => {
            $(".container_publicacao").fadeOut(500);
        })

        $(".div-menu_icon").click(() => {
            $(".container-menu-mobile").slideToggle(1000);
        })

        $(".btn-toggle").click(() => {
            $(".menu-atualizacoes").slideToggle(1000);
        })

        $(".db_li-segundo").click(() => {
            $(".btn_pesquisar_text").fadeOut(200);
            setTimeout(() => {
                $(".form-inline").fadeIn(500);
                $(".db_li-segundo").css("background-color", "#eca43b");
            }, 600);
        });

    </script>

    <script>

        //////Em breve: Para as funções JS criar módulos
        //////Importar funções do arquivo de scripts JS
        //type = "module" src = "http://localhost/1_Projetos/4_Banco_dados/Scripts_JS/script.js"

        function deslogar(){

            window.location = "http://localhost/1_Projetos/4_Banco_dados/Login.php";

        }

        function mostrar_clientes(){

        btn_dados = window.document.querySelector("li.db_li-primeiro");
        btn_dados_check = window.document.querySelector("input#check_btn-dados");
        div_conteudo = window.document.querySelector("div.div-conteudo");

        if(btn_dados_check.checked != true){
            btn_dados_check.checked = true;
            console.log("Mostrar todas as linhas da tabela de clientes");

            btn_dados.style.backgroundColor = "rgba(236, 164, 59, 1)";

            div_conteudo.style.display = "block";

        } else if(btn_dados_check.checked){
            btn_dados_check.checked = false;
            console.log("Esconder dados da tabela de clientes");

            btn_dados.style.backgroundColor = "#5f82b9";

            div_conteudo.style.display = "none";
        }

    }

    function pesquisar_cliente(){



        

        
        
    }
        
    </script>



</body>

</html>