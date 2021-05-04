
    //Recuperar os registros a cada cinco segundos, para caso alguma alteração ocorra diretamente no banco
    //setInterval(getRegistros, 10000);
    
    //Requisão assíncrona do listamento dos registros
    function getRegistros(){

        $.ajax({

            url: 'http://localhost:8000/Scripts_php/select.php',
            method: 'GET',
            dataType: 'json', //Tratamento da resposta //Avalia a resposta como JSON e retorna um objeto javascript
            beforeSend: function(){ console.log("Buscando registros..."); } //Antes de enviar..

        }).done(function(response){

            //Os registros aqui estarão dentro de um array de objetos
            //Não existe array associativo em JS
            if(response){

                //console.log(typeof response); //Tipo da estrutura //Objeto
                //console.log(response);
                $("#corpo_tabela").empty(); //Para impedir a duplicação de comentários

                let num_linhas = response.length;
                let num_colunas = Object.keys(response[0]).length;
                //console.log("Quantidade de linhas ou registros: " + num_linhas);
                //console.log("Quantidade de colunas ou campos, em cada linha: " + num_colunas);

                let registros = response;

                //CRIAÇÃO DINÂMICA DA TABELA

                //A estrutura de dados é um array de objetos 
                //Cada linha é na verdade um índice do array, e em cada um existe um objeto estruturado em atributo-valor

                //For para percorrer as linhas, ou índices
                for(let linha = 0; linha < num_linhas; linha++){

                    //Criamos a cada loop um table row com uma classe que varia a cada loop, por utilizar o contador
                    $('#corpo_tabela').append("<tr class = linha_" + linha + "> </tr>");

                    //Cada linha do um array é um objeto
                    //Cada coluna da linha é um atributo do objeto
                    //Cada atributo é um campo do registro, com seu valor
                    for(let coluna in registros[linha]){

                        //console.log(coluna);
                        
                        $(".linha_" + linha).append("<td>" + registros[linha][coluna] + "</td>");
                    
                    }

                    //Inserimos um botão do bootstrap ao final de cada linha
                    $(".linha_" + linha).append("<td> <button type='button' class='btn btn-danger btn-editar'>Editar</button> </td>");

                }

            }else{

                //console.log("Não existem registros no banco de dados");
                //$('.alert_row').hide().prepend("<div class='alert alert-danger' role='alert'> Nenhum registro encontrado! </div>").fadeIn(500);
                //$(".alert").delay(5000).fadeOut(500);
                
            }  
        });  
    }

    //Requisão assíncrona do cadastro de dados
    $('.form-insert').submit(function(e){
        e.preventDefault();
    
        var p_name = $('#nome_input').val();
        var p_telefone = $('#telefone_input').val();
        var p_email = $('#email_input').val();
        console.log("Dados a enviar...." + "Nome: " + p_name + "....Telefone: " + p_telefone + "....Email: " + p_email);

        $.ajax({

            url: 'http://localhost:8000/Scripts_php/insert.php',
            method: 'POST',
            data: {nome: p_name, telefone: p_telefone, email: p_email},
            dataType: 'text', //Tratamento da resposta
            beforeSend: function(){ console.log("Inserindo dados no banco..."); } //Antes de enviar..

        }).done(function(response){

            //console.log(response);

            //Quando a requisição é realizada, os campos do formulário são esvaziados
            $('#nome_input').val('');
            $('#telefone_input').val('');
            $('#email_input').val('');

            //Para impedir a duplicação de alertas
            $(".alert_row").empty(); 

            if(response){

                //É impresso um alerta de sucesso, do bootstrap
                $('.alert_row').hide().prepend("<div class='alert alert-success' role='alert'> Cadastro realizado com sucesso! </div>").fadeIn(500);
                $(".alert").delay(5000).fadeOut(500);
                
                //Poderia colocar um delay, para que caso não houvessem mais registros, o alerta de falta de registros não conflitasse com esse
                $("#corpo_tabela").empty();
                getRegistros();

            } else{

                //É impresso um alerta de fracasso (danger), do bootstrap
                $('.alert_row').prepend('<div class="alert alert-danger" role="alert"> Erro no cadastro! Tente novamente! </div>');

            }

        });
        
    });

    //Requisão assíncrona do cadastro de dados
    $('.form-delete').submit(function(e){
        e.preventDefault();
    
        var p_id = $('#id_dinput').val();
        console.log("ID do registro a ser deletado: " + p_id);

        $.ajax({

            url: 'http://localhost:8000/Scripts_php/delete.php',
            method: 'POST',
            data: {id: p_id},
            dataType: 'text', //Tratamento da resposta
            beforeSend: function(){ console.log("Excluindo registro do banco de dados..."); } //Antes de enviar..

        }).done(function(response){

            //Quando a requisição é realizada, os campos do formulário são esvaziados
            $('#id_dinput').val('');

            //Para impedir a duplicação de alertas
            $(".alert_row").empty(); 

            if(response){

                //É impresso um alerta de sucesso, do bootstrap
                $('.alert_row').hide().prepend("<div class='alert alert-success' role='alert'> O registro foi excluído com sucesso! </div>").fadeIn(500);
                $(".alert").delay(5000).fadeOut(500);
                
                //Poderia colocar um delay, para que caso não houvessem mais registros, o alerta de falta de registros não conflitasse com esse
                $("#corpo_tabela").empty();
                getRegistros();

            } else{

                //É impresso um alerta de fracasso (danger), do bootstrap
                $('.alert_row').prepend('<div class="alert alert-danger" role="alert"> Erro na remoção! Tente novamente! </div>');

            }

        });
        
    });




