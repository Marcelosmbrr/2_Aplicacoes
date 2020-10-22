<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Cadastro</title>
    <style>
             body{
               background: #3C5377;
             }
                
             /*O maintcontainer contém tudo*/
            .maincontainer{
              position: absolute;
              width: 250px;
              height: 320px;
              background: none;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              perspective: 1000px;

            }

            /* thecard contém as duas faces da carta */
            .thecard{
              position: relative;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              border-radius: 10px;
              transform-style: preserve-3d;
              transition: all 0.8s ease;
            }

            /* Este controla a rotação do cartão, bem como os efeitos de mouse */
            .thecard:hover{
              transform: rotateY(180deg);
            }

            /* A face do cartão que é apresentada por padrão */
             .thefront{
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              border-radius: 10px;
              backface-visibility: hidden;
              -webkit-backface-visibility: hidden;
              overflow: hidden;
              background: #ffc728;
              color: #000;
            }

            /* A face do cartão que é mostrada com o passar do mouse */
            .theback{
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              border-radius: 10px;
              backface-visibility: hidden;
              overflow: hidden;
              background: #fafafa;
              color: #333;
              text-align: center;
              transform: rotateY(180deg);
            }


            /* Este é um estilo para a rotação do cartão, e não um requisito funcional em si */
            .thefront h1, .theback h1{
              font-family: 'zilla slab', sans-serif;
              padding: 30px;
              font-weight: bold;
              font-size: 24px;
              text-align: center;
            }
            
            /* Este é um estilo para a rotação do cartão, e não um requisito funcional em si */
            .thefront p, .theback p{
              font-family: 'zilla slab', sans-serif;
              padding: 30px;
              font-weight: normal;
              font-size: 12px;
              text-align: center;
            }
    </style>
  </head>
  <body>
       <div class="maincontainer">

      <div class="thecard">

        <div class="thefront"><h1>Cadastro e Pesquisa, com MySQL</h1>
            <p>Esta é uma aplicação com HTML, PHP e Banco de Dados MySQL. Consiste em um sistema de cadastro de dados, e pesquisa destes.
            <br><br> SMBR </p>
        </div>

        <div class="theback"><h1>Escolha</h1>
            <p>Clique no botão "Cadastrar" para ir para o cadastro de dados, ou no botão de pesquisa "Pesquisar".</p>
            <a href="cadastro.php"><button>Cadastrar</button></a>
            <a href="pesquisa.php"><button>Pesquisar</button></a>
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