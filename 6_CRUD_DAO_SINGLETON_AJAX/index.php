<?php
    require_once("vendor/autoload.php");
    use Classes\Pessoa_DAO;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Display/css/bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Display/css/display.css">
    <script src="https://kit.fontawesome.com/49b7b83709.js" crossorigin="anonymous"></script>
    <title>CRUD</title>
</head>
<body onload = "getRegistros()">

    <header>

        <h1 style="color: #fff;"><i class="fas fa-database" style="color: #DD8A00;"></i> CRUD AJAX_DAO_SINGLETON_COMPOSER</h1>

    </header>

    <!-- O MAIN É UM GRID DE TRÊS COLUNAS, SENDO CADA UMA SECTION -->
    <main>
        
        <!-- SECTION LADO ESQUERDO -->
        <section class = "main_form-side">

            <div class = "form_header">
                <h6 style="color: #fff;"> Cadastrar Pessoa <i class="fas fa-user-plus" style="color: #DD8A00; cursor: pointer;"></i></h6>
            </div>
            <div class = "form_body fb_1">

                <form class="row g-3 form-insert" style="display: grid;" action = "Cadastro_script/cadastro_verifica.php" method = "POST">
                    <div class="col-md-6">
                      <label for="nome_input" class="form-label">Nome</label>
                      <input style = "width: max-content;" type = "text" class="form-control" id="nome_input" placeholder="Nome completo" name = "cadastro_nome">
                    </div>
                    <div class="col-md-6">
                      <label style = "width: max-content;" for="telefone_input" class="form-label">Telefone</label>
                      <input type="text" class="form-control" id="telefone_input" placeholder="Insira o DDD" style="width: max-content;" name = "cadastro_telefone">
                    </div>
                    <div class="col-md-6">
                        <label for="email_input" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email_input" style="width: max-content;" placeholder="usuário@exemplo.com" name = "cadastro_email">
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary" style="background: #dd8a00; border: 0;" name = "btn_cadastrar">Insert</button>
                    </div>
                  </form>

            </div>

        </section>

        <!-- SECTION DO MEIO - CONTÉM A TABELA -->
        <section class = "main_table-side">

            <div class = "alert_row">

              <!-- O ALERTA SERÁ ENVIADO POR AJAX -->

            </div>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Editar</th>
                  </tr>
                </thead>
                <tbody id = "corpo_tabela">
                  
                  <!-- OS DADOS SERÃO ENVIADOS POR AJAX -->
                 

                </tbody>
              </table>

        </section>

        </section>

        <!-- SECTION LADO DIREITO -->
        <section class = "main_delete-side">

            <div class = "form_header">
                <h6 style="color: #fff;"> Excluir Pessoa <i class="fas fa-user-minus" style="color: #DD8A00; cursor: pointer;"></i></h6>
            </div>
            <div class = "form_body fb_2">

                <form class="row g-3 form-delete" style="display: grid;" action = "Delete_script/delete_verifica.php" method = "POST">
                    <div class="col-md-6">
                      <label for="id_dinput" class="form-label">ID</label>
                      <input style = "width: max-content;" type = "text" class="form-control" id="id_dinput" placeholder="ID do registro" name = "delete_id">
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary" style="background: #dd8a00; border: 0;" name = "btn_delete">Delete</button>
                    </div>
                  </form>

            </div>

        </section>

    </main>

    <!-- O FORMULÁRIO DE UPDATE POR PADRÃO É DISPLAY NONE -->
    <!-- DEVE APARECER CASO O USUÁRIO CLIQUE NO BOTÃO DE EDITAR, DE ALGUM DOS REGISTROS LISTADOS -->
    <div class = "update_form">
    
      <form class="row g-3 form-update" style="display: grid;" action = "Update_script/update_verifica.php" method = "POST">
          <div class="col-md-6">
            <label for="id_uinput" class="form-label">ID</label>
            <input style = "width: max-content;" type = "text" class="form-control" id="id_uinput" placeholder="Nome completo" name = "update_id">
          </div>
          <div class="col-md-6">
            <label for="nome_uinput" class="form-label">Nome</label>
            <input style = "width: max-content;" type = "text" class="form-control" id="nome_uinput" placeholder="Nome completo" name = "update_nome">
          </div>
          <div class="col-md-6">
            <label style = "width: max-content;" for="telefone_uinput" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_uinput" placeholder="Insira o DDD" style="width: max-content;" name = "update_telefone">
          </div>
          <div class="col-md-6">
              <label for="email_uinput" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="email_uinput" style="width: max-content;" placeholder="usuário@exemplo.com" name = "update_email">
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary" style="background: #dd8a00; border: 0;" name = "btn_update">Update</button>
          </div>
        </form>

    </div>

    <script src="Javascript/Front/jquery/jquery-3.5.1.js"></script>
    <script src="Javascript/Front/scripts.js"></script>
    <script src="Javascript/Back/ajax.js"></script>

</body>

</html>