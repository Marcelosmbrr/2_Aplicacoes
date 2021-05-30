    
//CADASTRO ASSÍNCRONO DOS DADOS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Quando o formulário é enviado, esta função é executada tendo como parâmetro o próprio evento (o envio do formulário)
    $('.formulario_registro').submit(function(e){
        e.preventDefault(); //O efeito original do evento é cancelado
        
        //Recuperamos os valores existentes nos campos de input
        var u_name = $('#nome_input').val();
        var u_email = $('#email_input').val();
        var u_username = $('#username_input').val();
        var u_senha = $('#senha_input').val();

        //Apenas para confirmar se os valores foram corretamente recuperados
        //console.log("Dados a registrar...." + "Nome: " + u_name + "....Email: " + u_email + "....Nome de usuário(login): " + u_username + "....Senha: " + u_senha); 

        $.ajax({

            //Configurações de envio dos dados para o script PHP
            url: 'script_php/insert.php', //Para onde serão enviados
            method: 'POST', //Serão enviados via POST
            data: {nome: u_name, email: u_email, login: u_username, senha: u_senha}, //Dados a serem enviados //variável_url: dado
            dataType: 'text', //Tratamento da resposta //Nesse caso, por ser um insert, retornarei true ou false
            beforeSend: function(){ console.log("Usuário está sendo registrado..."); } //Antes de enviar..
        
        //Quando o script PHP retornar uma resposta (true ou false) esta função é executada
        //Seu parâmetro é a resposta recebida
        }).done(function(response){
        
            //console.log(response);
        
            //Os campos do formulário são esvaziados
            $('#nome_input').val('');
            $('#email_input').val('');
            $('#username_input').val('');
            $('#senha_input').val('');

            //O alerta aparece e some dentro de um intervalo de tempo, como definido logo abaixo
            //Mas pode ocorrer do usuário preencher e enviar um novo formulário antes do alerta anterior desaparecer
            //Por isso a cada nova resposta a caixa de alerta deve ser esvaziada
            $(".alert_msg_reg").empty(); 

            //Se a resposta for true
            if(response == true){

                //É impresso um alerta de sucesso, do bootstrap
                //O código abaixo é uma "gambiarra" para aplicar FadeIn e FadeOut em um HTML criado //Não é possível aplicar efeito na criação de HTML com Jquery
                //Os efeitos só valem para estruturas que já existem //HTML criado com Jquery surge visualmente "do nada"
                //Com essa "gambiarra" o HTML surge do nada, igualmente, mas não aparece de repente porque o container antes é tornado invisivel, e com FadeIn ressurge suavemente junto com o conteúdo
                $('.alert_msg_reg').hide().prepend("<div class='alert alert-success' role='alert'> Cadastro realizado com sucesso! </div>").fadeIn(500);
                $(".alert").delay(5000).fadeOut(500);

                //Esvaziamos o tbody, para que não hajam conflitos na atualização da listagem
                $("#corpo_tabela").empty();

                //E recuperamos os registros novamente, para atualizar
                getRegistros();

            //Se a reposta for false
            }else{

                //É impresso um alerta de fracasso (danger), do bootstrap, seguindo a mesma lógica do alerta de sucesso
                $('.alert_msg_reg').hide().prepend("<div class='alert alert-danger' role='alert'> Erro no cadastro! Tente novamente! </div>").fadeIn(500);
                $(".alert").delay(5000).fadeOut(500);

            }
        
        });
   
    });
    
//SELECT ASSÍNCRONO DOS DADOS CADASTRADOS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function getRegistros(){
        
        $.ajax({

            url: 'script_php/select.php',
            method: 'GET',
            dataType: 'json', //Tratamento da resposta //A resposta é convertida em um objeto literal JS
            beforeSend: function(){ console.log("Buscando registros..."); } //Antes de enviar..

        }).done(function(response){

            //Como a resposta é tratada como JSON, aqui os dados estarão dentro de um array de objetos
            console.log(response);

            if(response){

                //console.log(typeof response); //Tipo da estrutura //Objeto
                //console.log(response);
                $("#corpo_tabela").empty(); //Para impedir a duplicação de comentários
                
                //O array é em si é indexado, e em cada índice existe um registro
                //Cada registro é um objeto

                let num_linhas = response.length; //Contamos quantos índices/registros o array tem
                let num_colunas = Object.keys(response[0]).length; //Contamos quantos elementos chave-valor existem em um único registro 
            
                let registros = response;
            
                ///CRIAÇÃO DINÂMICA DA TABELA
            
                //For para percorrer as linhas, ou índices do array
                for(let linha = 0; linha < num_linhas; linha++){
            
                    //Criamos a cada loop um table row com uma classe que varia a cada loop, por utilizar o contador de linhas
                    //Usaremos a classe para identificar em que elemento HTML devemos inserir os dados
                    $('#corpo_tabela').append("<tr class = linha_" + linha + "> </tr>");
            
                    //Cada linha do array é um objeto
                    //ForIn é usado para percorrer objetos 
                    for(let coluna in registros[linha]){
                        
                        //Adicionaremos os td's na atual tr
                        //Os tds de uma mesma tr terão uma classe comum, mas que será diferente dos tds de outras trs
                        //O que tds de uma mesma tr possuem em comum? a tr/linha //a classe comum será td_r-[linha]
                        $(".linha_" + linha).append("<td class = td_r-" + linha + ">" + registros[linha][coluna] + "</td>");
                    
                    }

                    //Todas as linhas da tabela terão essa última coluna, com esses botões de edição e exclusão
                    //A classe de cada botão será dinâmica e servirá para identificar a linha/registro que deve modificar
                    $(".linha_" + linha).append("<td>" + "<button type='button' class='btn r-" + linha + " btn-primary' onclick = editar_registro(this)>Editar</button>" + " " + "<button type='button' class='btn r-" + linha + " btn-danger' onclick = excluir_registro(this)>Excluir</button>" + "</td>");
            
                }
            
            }else{
            
                //NÃO EXISTEM REGISTROS NO BANCO
                
            }  
                
        });  
    }

//UPDATE ASSÍNCRONO DOS REGISTROS LISTADOS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //FUNÇÃO PARA A DEFINIÇÃO DO REGISTRO A SER MODIFICADO E RENDERIZAÇÃO DO FORMULÁRIO
    //el = elemento
    function editar_registro(el){

        //Recuperamos a segunda classe do elemento //r-[linha]
        classe_linha = el.classList[1];
        
        //Transformo o nome da classe em um array de caracteres
        v_classe = classe_linha.split(''); //["r", "-", "0"]
        linha = v_classe[2]; 
        //console.log("O registro " + linha + " será alterado");

        //Agora vou recuperar os table data da mesma linha a partir da classe
        //Lembrando, os td de uma mesma tr possuem a mesma classe td_r-[linha]
        tds_classe = "td_r-" + linha;
        vetor_tds = document.getElementsByClassName(tds_classe);
        console.log(vetor_tds);

        //Estilização prévia do container do formulário
        container_form = document.getElementsByClassName("update-delete-container");
        console.log(container_form)

        //Renderização do formulário de edição com Ajax local
        //Os códigos envolvendo o formulário carregado devem ser escritos no escopo desta função
        $(".update-delete-container").load("html-forms/form-update.html", function(responseTxt, statusTxt, xhr){

            if(statusTxt == "success"){

                //Agora vou recuperar cada input do formulário de edição e atribuir o valor respectivo de cada td
                campo_id = document.getElementById("id_input").value = vetor_tds[0].innerHTML;
                campo_nome = document.getElementById("nome_edit_input").value = vetor_tds[1].innerHTML;
                campo_email = document.getElementById("email_edit_input").value = vetor_tds[2].innerHTML;
                campo_username = document.getElementById("username_edit_input").value = vetor_tds[3].innerHTML;

                //MODIFICAÇÃO ASSÍNCRONA DO REGISTRO DEFINIDO
                $('.formulario_edicao').submit(function(e){
                    e.preventDefault(); 
                    
                    //Recuperamos os valores existentes nos campos de input
                    ed_id = $('#id_input').val();
                    ed_name = $('#nome_edit_input').val();
                    ed_email = $('#email_edit_input').val();
                    ed_username = $('#username_edit_input').val();

                    //Apenas para confirmar se os valores foram corretamente recuperados
                    //console.log("Dados a registrar...." + "ID: " + ed_id + "....Nome: " + ed_name + "....Email: " + ed_email + "....Nome de usuário(login): " + ed_username); 

                    //AJAX
                    $.ajax({

                        url:'script_php/update.php',
                        method: 'POST',
                        data: {ID: ed_id, nome: ed_name, email: ed_email, username: ed_username},
                        dataType: 'text', //Tratamento da resposta //Por ser um update, será true ou false
                        beforeSend: function(){ console.log("Atualizando registro.."); } 

                    }).done(function(response){

                        //console.log(response);
                    
                        //Os campos do formulário são esvaziados
                        $('#id_input').val('');
                        $('#nome_edit_input').val('');
                        $('#email_edit_input').val('');
                        $('#username_edit_input').val('');

                        //Para impedir sobreposição de alertas
                        $(".alert_msg_up-del").empty();

                        //Se a resposta for true
                        if(response == true){

                            //Alerta de sucesso é renderizado
                            $('.alert_msg_up-del').hide().prepend("<div class='alert alert-success' role='alert'> Atualização realizada com sucesso! </div>").fadeIn(500);
                            $(".alert").delay(5000).fadeOut(500);

                            //Esvaziamos o tbody, para que não hajam conflitos na atualização da listagem
                            $("#corpo_tabela").empty();

                            //E recuperamos os registros novamente, para atualizar
                            getRegistros();

                        //Se a reposta for false
                        }else{

                            //É impresso um alerta de fracasso (danger), do bootstrap, seguindo a mesma lógica do alerta de sucesso
                            $('.alert_msg_up-del').hide().prepend("<div class='alert alert-danger' role='alert'> Erro na atualização! Tente novamente! </div>").fadeIn(500);
                            $(".alert").delay(5000).fadeOut(500);

                        }

                    });

                });

            }else if(statusTxt == "error"){

                console.log("Erro no carregamento do formulário!");

            }
              
        });

    }

    
//EXCLUSÃO ASSÍNCRONA DOS REGISTROS LISTADOS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //FUNÇÃO PARA A DEFINIÇÃO DO REGISTRO A SER EXCLUÍDO
    //el = elemento
    function excluir_registro(el){

        //Recuperamos a segunda classe do elemento //r-[linha]
        classe_linha = el.classList[1];

        //Transformo o nome da classe em um array de caracteres
        v_classe = classe_linha.split(''); //["r", "-", "0"]
        linha = v_classe[2]; 
        //console.log("O registro " + linha + " será excluído");

        //Agora vou recuperar os table data da mesma linha a partir da classe
        //Lembrando, os td de uma mesma tr possuem a mesma classe td_r-[linha]
        tds_classe = "td_r-" + linha;
        vetor_tds = document.getElementsByClassName(tds_classe);
        console.log(vetor_tds);

        //Renderização do formulário de edição
        $(".update-delete-container").load("html-forms/form-delete.html", function(responseTxt, statusTxt, xhr){

            if(statusTxt == "success"){

                //console.log("Formulário carregado com sucesso!");

                //Agora vou recuperar o id
                campo_id = document.getElementById("id_input").value = vetor_tds[0].innerHTML;

                //MODIFICAÇÃO ASSÍNCRONA DO REGISTRO DEFINIDO
                $('.formulario_exclusao').submit(function(e){
                    e.preventDefault(); 
                    
                    //Recuperamos o valor do id, agora existente como valor do input
                    del_id = $('#id_input').val();

                    //AJAX
                    $.ajax({

                        url:'script_php/delete.php',
                        method: 'POST',
                        data: {ID: del_id},
                        dataType: 'text', //Tratamento da resposta //Por ser um update, será true ou false
                        beforeSend: function(){ console.log("Excluíndo registro.."); } 

                    }).done(function(response){

                        //console.log(response);
                    
                        //O input do form é esvaziado
                        $('#id_input').val('');
                        
                        //Para impedir sobreposição de alertas
                        $(".alert_msg_up-del").empty();

                        //Se a resposta for true
                        if(response == true){

                            //Alerta de sucesso é renderizado
                            $('.alert_msg_up-del').hide().prepend("<div class='alert alert-success' role='alert'> Exclusão realizada com sucesso! </div>").fadeIn(500);
                            $(".alert").delay(5000).fadeOut(500);

                            //Esvaziamos o tbody, para que não hajam conflitos na atualização da listagem
                            $("#corpo_tabela").empty();

                            //E recuperamos os registros novamente, para atualizar
                            getRegistros();

                        //Se a reposta for false
                        }else{

                            //É impresso um alerta de fracasso (danger), do bootstrap, seguindo a mesma lógica do alerta de sucesso
                            $('.alert_msg_up-del').hide().prepend("<div class='alert alert-danger' role='alert'> Erro na exclusão! Tente novamente! </div>").fadeIn(500);
                            $(".alert").delay(5000).fadeOut(500);

                        }

                    });

                });

            }else if(statusTxt == "error"){

              console.log("Erro no carregamento do formulário!");

            }

        });

    }
   

    


    



