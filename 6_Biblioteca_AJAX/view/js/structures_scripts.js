//EXECUÇÃO DO CADASTRO DE LIVRO
$(document).on("click", "#btn_register_book" ,function(e){
    e.preventDefault();

    htdocs = window.location.origin;

    //Valores a serem inseridos
    book_title = $("#title-book-new_input").val();
    book_author = $("#author-book-new_input").val();
    book_area = $("#area_select").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {new_book: {title: book_title, author: book_author,area: book_area}},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Cadastrando livro...."); } //Antes de enviar..

        }).done(function(response){

            console.log("Cadastro de livro: "+response);
            
            if(response){

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Recarregar a tabela de alunos
                getRegistros(type="books");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha no cadastro");

            }
            
        });

});

//EXECUÇÃO DO CADASTRO DE ALUNO
$(document).on("click", "#btn_register_student" ,function(e){
    e.preventDefault();

    htdocs = window.location.origin;

    //console.log("ok")

    //Valores a serem inseridos
    student_name = $("#name-student_input").val();
    student_email = $("#email-student_input").val();
    student_cpf = $("#cpf-student_input").val();
    student_date = $("#dt-student_input").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {new_student: {name: student_name, email: student_email,cpf: student_cpf,date: student_date}},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Cadastrando aluno...."); } //Antes de enviar..

        }).done(function(response){
            
            if(response){

                console.log("Cadastro de aluno: "+response);

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Recarregar a tabela de alunos
                getRegistros(type="students");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha no cadastro");

            }
            
        });

});

//EXECUÇÃO DO CADASTRO DE ÁREA
$(document).on("click", "#btn_register_area" ,function(e){
    e.preventDefault();

    htdocs = window.location.origin;

    //Valores a serem inseridos
    area_name = $("#name-area_input").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {new_area: area_name},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Cadastrando área...."); } //Antes de enviar..

        }).done(function(response){
            
            if(response){

                console.log("Cadastro de área: "+response);

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Esconder modal de cadastro de área
                $("#modal_form").hide();

                //Recarregar a tabela de alunos
                getRegistros(type="areas");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha no cadastro");

            }
            
        });

});

//EXECUÇÃO DA EDIÇÃO DE LIVRO
$(document).on("click", "#btn_edit_book" ,function(e){
    e.preventDefault();

    //Valores a serem inseridos
    book_id = $("#id-book-edit_input").val();
    book_title = $("#title-book-edit_input").val();
    book_author = $("#author-book-edit_input").val();
    book_area = $("#area_select").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {edit_book: {id: book_id, title: book_title,author: book_author,area: book_area}},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Editando livro...."); } //Antes de enviar..

        }).done(function(response){
            
            if(response){

                console.log("Edição de livro: "+response);

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Recarregar a tabela de alunos
                getRegistros(type="books");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha no cadastro");

            }
            
        });

    htdocs = window.location.origin;

});

//EXECUÇÃO DA EDIÇÃO DE ALUNO
$(document).on("click", "#btn_edit_student" ,function(e){
    e.preventDefault();

    //console.log("ok")

    //Valores a serem inseridos
    student_id = $("#id-student-edit_input").val();
    student_name = $("#name-student-edit_input").val();
    student_email = $("#email-student-edit_input").val();
    student_cpf = $("#cpf-student-edit_input").val();
    student_date = $("#date-student-edit_input").val();
    
    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {edit_student: {matricula: student_id, name: student_name, email: student_email, cpf: student_cpf, date: student_date}},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Editando aluno...."); } //Antes de enviar..

        }).done(function(response){
            
            if(response){

                console.log("Edição de livro: "+response);

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Recarregar a tabela de alunos
                getRegistros(type="students");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha no cadastro");

            }
            
        });

    htdocs = window.location.origin;

});

//EXECUÇÃO DA EDIÇÃO DE ÁREA
$(document).on("click", "#btn_edit_area" ,function(e){
    e.preventDefault();

    //Valores a serem inseridos
    area_id = $("#id-edit-area_input").val();
    area_name = $("#name-area-edit_input").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {edit_area: {area_id, area_name}},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Editando área...."); } //Antes de enviar..

        }).done(function(response){
            
            if(response){

                console.log("Edição de área: "+response);

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Recarregar a tabela de alunos
                getRegistros(type="areas");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha na edição da área");

            }
            
        });

});

/* EMPRÉSTIMO E DEVOLUÇÃO -------------------------------------------------------------------------------*/

//EXECUÇÃO DO EMPRÉSTIMO
$(document).on("click", "#btn_register_loan" ,function(e){
    e.preventDefault();

    htdocs = window.location.origin;

    //Valores a serem inseridos
    book_id = $("#book-title_loan_input").val();
    student_name = $("#student_select").val();
    date_finish = $("#book-date_loan_input").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {new_loan: {book: book_id, student: student_name,date: date_finish}},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Emprestando livro...."); } //Antes de enviar..

        }).done(function(response){

            console.log("Empréstimo de livro: "+response);
            
            if(response){

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Esconder modal de empréstimo
                $("#modal_form").hide();

                //Carregar tabela de empréstimos
                getRegistros(type="loans");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha na realização do empréstimo");

            }
            
        });

});


/* EXCLUSÕES --------------------------------------------------------------*/

//EXECUÇÃO DA EXCLUSÃO DE LIVRO
$(document).on("click", "#btn_del_book" ,function(e){
    e.preventDefault();

    htdocs = window.location.origin;

    //Valores a serem inseridos
    del_book_id = $("#id-book-delete_input").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {delete_book: del_book_id},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Excluindo livro...."); } //Antes de enviar..

        }).done(function(response){

            console.log("Exclusão de livro: "+response);
            
            if(response){

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Esconder modal exclusão
                $("#modal_form").hide();

                //Carregar tabela de empréstimos
                getRegistros(type="books");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha na exclusão do livro");

            }
            
        });

});

//EXECUÇÃO DA EXCLUSÃO DE ALUNO
$(document).on("click", "#btn_del_student" ,function(e){
    e.preventDefault();

    htdocs = window.location.origin;

    //Valores a serem inseridos
    del_student_id = $("#id-student-delete_input").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {delete_student: del_student_id},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Excluindo aluno...."); } //Antes de enviar..

        }).done(function(response){

            console.log("Exclusão de aluno: "+response);
            
            if(response){

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Esconder modal de exclusão
                $("#modal_form").hide();

                //Carregar tabela de empréstimos
                getRegistros(type="students");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha na exclusão do livro");

            }
            
        });

});

//EXECUÇÃO DA EXCLUSÃO DE ÁREA
$(document).on("click", "#btn_del_area" ,function(e){
    e.preventDefault();

    htdocs = window.location.origin;

    //Valores a serem inseridos
    del_area_id = $("#id-area-delete_input").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {delete_area: del_area_id},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Excluindo área...."); } //Antes de enviar..

        }).done(function(response){

            console.log("Exclusão de área: "+response);
            
            if(response){

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Esconder modal de exclusão
                $("#modal_form").hide();

                //Carregar tabela de empréstimos
                getRegistros(type="areas");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha na exclusão da área");

            }
            
        });

});

//EXECUÇÃO DA EXCLUSÃO DE EMPRÉSTIMO
$(document).on("click", "#btn_do_devolution" ,function(e){
    e.preventDefault();

    htdocs = window.location.origin;

    //Valores a serem inseridos
    devo_loan = $("#id_loan-devolution").val();
    devo_book = $("#id_book-devolution").val();

    //Ajax da pesquisa
    $.ajax({

        url: htdocs+"/proj_biblioteca/bridge/bridge.php",
        method: 'POST',
        data: {devolution: {dev_loan_id: devo_loan, dev_book_id: devo_book}},
        dataType: 'json', //Tratamento da resposta
        beforeSend: function(){ console.log("Realizando devolução...."); } //Antes de enviar..

        }).done(function(response){

            console.log("Devolução do livro: "+response);
            
            if(response){

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                //Esconder modal de exclusão
                $("#modal_form").hide();

                //Carregar tabela de empréstimos
                getRegistros(type="loans");  

            }else{

                //Caso o cadastro falhe
                console.log("Falha na devolução do livro");

            }
            
        });

});


/* EVENTOS GERAIS --------------------------------------------------------------------------------------------------*/
$(document).on("click", ".btn_close" ,function(e){
    e.preventDefault();
    $("#modal_form").fadeOut(500);
});

//Pesquisa de dados //Não finalizado
$("#search_btn").click(function(e){
    e.preventDefault(); //O evento de enviar o formulário é cancelado

    //Recuperação do valor existente no input de pesquisa
    search_data = $("#search_input").val();

    //Ajax da pesquisa
    $.ajax({

    url: htdocs+"/proj_biblioteca/bridge/bridge.php",
    method: 'POST',
    data: {do_search: search_data},
    dataType: 'json', //Tratamento da resposta
    beforeSend: function(){ console.log("Realizando pesquisa...."); } //Antes de enviar..

    }).done(function(response){
        
        if(response){

            //Os containers são esvaziados para impedir sobreposição de conteúdo
            $('#tb-forms_section').empty();

            //Renderização dos dados na tabela
            $("#tb-forms_section").hide().html(response).slideDown(1000);

            //Limpar o input de pesquisa
            $(".search_input").val('');

        }else{

            //Caso não exista o valor do banco de dados
            console.log("Nenhum registro encontrado");

        }
        
    });

});