
    htdocs = window.location.origin;

    /* PRIMEIRO CARREGAMENTO DA PÁGINA --------------------------------------------------------------------------------*/

    //Quando a página é carregada, os livros são listados
    function getRegistros(type="books"){

        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {load_table: type},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Carregando tabela..."+type); } //Antes de enviar..

        }).done(function(tb_livros){


            //O container é esvaziado para impedir sobreposição de conteúdo
            $('#tb-forms_section').empty();

            //A tabela aparece com efeito slide
            $("#tb-forms_section").hide().html(tb_livros).slideDown(1000);

        });
        
    }

    /* IMPRESSÃO DOS DADOS DE CADA TABELA -----------------------------------------------------------------------------*/

    //Listagem de livros
    $("#btn-all_books").click(function(){

        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {all_books: true},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Carregando livros disponíveis...."); } //Antes de enviar..

        }).done(function(response){

            //O container é esvaziado para impedir sobreposição de conteúdo
            $('#tb-forms_section').empty();

            //A tabela aparece com efeito slide
            $("#tb-forms_section").hide().html(response).slideDown(1000);

            //O placeholder do input de pesquisa é alterado
            $("#search_input").attr("placeholder", "Por nome ou autor");
            $("#search_input").val('');

        });

    });

    //Listagem de áreas
    $("#btn-all_areas").click(function(){

        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {all_areas: true},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Carregando áreas disponíveis...."); } //Antes de enviar..

        }).done(function(tb_areas){

            //O container é esvaziado para impedir sobreposição de conteúdo
            $('#tb-forms_section').empty();

            //A tabela aparece com efeito slide
            $("#tb-forms_section").hide().html(tb_areas).slideDown(1000);

            //O placeholder do input de pesquisa é alterado
            $("#search_input").attr("placeholder", "Por nome da área");
            $("#search_input").val('');

        });
        
    });

    //Listagem de alunos
    $("#btn-all_students").click(function(){
        
        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {all_students: true},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Carregando alunos registrados...."); } //Antes de enviar..

        }).done(function(tb_alunos){

            //O container é esvaziado para impedir sobreposição de conteúdo
            $('#tb-forms_section').empty();

            //A tabela aparece com efeito slide
            $("#tb-forms_section").hide().html(tb_alunos).slideDown(1000);

            //O placeholder do input de pesquisa é alterado
            $("#search_input").attr("placeholder", "Por matrícula ou nome");
            $("#search_input").val('');

        });

    });

    //Listagem de reservas
    $("#btn-all_loans").click(function(){
        
        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {all_loans: true},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Carregando reservas realizadas...."); } //Antes de enviar..

        }).done(function(tb_alunos){

            //O container é esvaziado para impedir sobreposição de conteúdo
            $('#tb-forms_section').empty();

            //A tabela aparece com efeito slide
            $("#tb-forms_section").hide().html(tb_alunos).slideDown(1000);

            //O placeholder do input de pesquisa é alterado
            $("#search_input").attr("placeholder", "Por nome do livro emprestado");
            $("#search_input").val('');

        });

    });

    /* GERAÇÃO DOS FORMULÁRIOS -----------------------------------------------------------------------*/

    //FORMULÁRIO DE EDITAR ALUNO
    function updateStudent(el){
        htdocs = window.location.origin;

        //Recuperamos o valor do elemento //Que será definido pelo ID do registro
        row_value = el.value;

        //Agora dos elementos da mesma linha serão recuperados pelo value comum a todos
        //Lembrando, os elementos de uma mesma tr possuem o mesmo value
        row_th = $("th[value='"+ row_value +"']");
        row_tds = $("td[value='"+ row_value +"']");

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/update/edit_student.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            campo_matricula = document.getElementById("id-student-edit_input").value = row_th[0].innerHTML;
            campo_nome = document.getElementById("name-student-edit_input").value = row_tds[0].innerHTML;
            campo_email = document.getElementById("email-student-edit_input").value = row_tds[1].innerHTML;
            campo_cpf = document.getElementById("cpf-student-edit_input").value = row_tds[2].innerHTML;
            campo_date = document.getElementById("date-student-edit_input").value = row_tds[3].innerHTML;

            }

        });
    }

    //FORMULÁRIO DE EDITAR ÁREA
    function updateArea(el){
        htdocs = window.location.origin;

        //Recuperamos o valor do elemento //Que será definido pelo ID do registro
        row_value = el.value;

        //Agora dos elementos da mesma linha serão recuperados pelo value comum a todos
        //Lembrando, os elementos de uma mesma tr possuem o mesmo value
        row_th = $("th[value='"+ row_value +"']");
        row_tds = $("td[value='"+ row_value +"']");

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/update/edit_areaa.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            campo_id = document.getElementById("id-edit-area_input").value = row_th[0].innerHTML;;
            campo_nome = document.getElementById("name-area-edit_input").value = row_tds[0].innerHTML;

            }

        });

    }

    //CRIA/GERA FORMULÁRIO DE CADASTRO DE LIVRO
    $(document).on("click", "#btn-new_book" ,function(){

        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {book_new_form: "new_book"},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Carregando formulário de registro de livro..."); } //Antes de enviar..

        }).done(function(form_new_book){

            //O container é esvaziado para impedir sobreposição de conteúdo
            $('#modal_form').empty();

            //O formulário aparece
            $("#modal_form").hide().html(form_new_book).fadeIn(500);


        });

    });

    //CRIA/GERA FORMULÁRIO DE EDITAR O LIVRO
    function updateBook(el){
        htdocs = window.location.origin;

        //Recuperamos o valor do elemento //Que será definido pelo ID do registro
        row_value = el.value;

        //Agora dos elementos da mesma linha serão recuperados pelo value comum a todos
        //Lembrando, os elementos de uma mesma tr possuem o mesmo value
        row_th = $("th[value='"+ row_value +"']");
        row_tds = $("td[value='"+ row_value +"']");

        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {book_edit_form: "edit_book"},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Carregando formulário de edição de livro..."); } //Antes de enviar..

        }).done(function(form_edit_book){

            //O container é esvaziado para impedir sobreposição de conteúdo
            $('#modal_form').empty();

            //O formulário aparece
            $("#modal_form").hide().html(form_edit_book).fadeIn(500);

            //Recuperação dos valores DEFAULT da linha para o formulário de edição
            id_book = document.getElementById("id-book-edit_input").value = row_th[0].innerHTML;;
            title_book = document.getElementById("title-book-edit_input").value = row_tds[0].innerHTML;
            author_book = document.getElementById("author-book-edit_input").value = row_tds[0].innerHTML;


        });
        
    }

    //CRIA/GERA FORMULÁRIO DE CADASTRO DE ALUNO
    $(document).on("click", "#btn-new_student" ,function(){
        htdocs = window.location.origin;

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/insert/new_student.html", function(responseTxt, statusTxt, xhr){
            $("#modal_form").fadeIn(500);

        });

    });

    //CRIA/GERA FORMULÁRIO DE CADASTRO DE ÁREA
    $(document).on("click", "#btn_new-area" ,function(){
        htdocs = window.location.origin;

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/insert/new_areaa.html", function(responseTxt, statusTxt, xhr){
            $("#modal_form").fadeIn(500);

        });

    });

    //CRIA/GERA FORMULÁRIO DE EXCLUIR LIVRO
    function deleteBook(el){
        htdocs = window.location.origin;

        //Recuperamos o valor do elemento //Que será definido pelo ID do registro
        row_value = el.value;

        //Agora dos elementos da mesma linha serão recuperados pelo value comum a todos
        //Lembrando, os elementos de uma mesma tr possuem o mesmo value
        row_th = $("th[value='"+ row_value +"']");
        row_tds = $("td[value='"+ row_value +"']");

        console.log(row_th)
        console.log(row_tds)

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/del_book.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            let book_id = document.getElementById("id-book-delete_input").value = row_th[0].innerHTML;;

            }

        });
    }

    //CRIA/GERA FORMULÁRIO DE EXCLUIR ALUNO
    function deleteStudent(el){
        htdocs = window.location.origin;

        //Recuperamos o valor do elemento //Que será definido pelo ID do registro
        row_value = el.value;

        //Agora dos elementos da mesma linha serão recuperados pelo value comum a todos
        //Lembrando, os elementos de uma mesma tr possuem o mesmo value
        row_th = $("th[value='"+ row_value +"']");
        row_tds = $("td[value='"+ row_value +"']");

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/delete_student.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            let student_matr = document.getElementById("id-student-delete_input").value = row_th[0].innerHTML;;

            }

        });
    }

    //CRIA/GERA FORMULÁRIO DE EXCLUIR ÁREA
    function deleteArea(el){
        htdocs = window.location.origin;

        //Recuperamos o valor do elemento //Que será definido pelo ID do registro
        row_value = el.value;

        //Agora dos elementos da mesma linha serão recuperados pelo value comum a todos
        //Lembrando, os elementos de uma mesma tr possuem o mesmo value
        row_th = $("th[value='"+ row_value +"']");
        row_tds = $("td[value='"+ row_value +"']");

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/delete_area.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            let campo_nome = document.getElementById("id-area-delete_input").value = row_th[0].innerHTML;;

            }

        });
    }

    //CRIA/GERA FORMULÁRIO DE REALIZAR EMPRÉSTIMO DE LIVRO
    function bookLoan(el){
        htdocs = window.location.origin;

        //Recuperamos o valor do elemento //Que será definido pelo ID do registro
        row_value = el.value;

        //Agora dos elementos da mesma linha serão recuperados pelo value comum a todos
        //Lembrando, os elementos de uma mesma tr possuem o mesmo value
        row_th = $("th[value='"+ row_value +"']");
        row_tds = $("td[value='"+ row_value +"']");

        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {book_loan_form: "loan_book"},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Carregando formulário de empréstimo de livro..."); } //Antes de enviar..

        }).done(function(form_edit_book){

            //O container é esvaziado para impedir sobreposição de conteúdo
            $('#modal_form').empty();

            //O formulário aparece
            $("#modal_form").hide().html(form_edit_book).fadeIn(500);

            //Recuperação dos valores DEFAULT da linha para o formulário de edição
            let id_book = document.getElementById("book-title_loan_input").value = row_th[0].innerHTML;;


        });
    }

    //CRIA/GERA FORMULÁRIO DE REALIZAR DEVOLUÇÃO DO LIVRO
    //Realizar devolução
    function doDevolution(el){
        htdocs = window.location.origin;

        //Recuperamos o valor do elemento //Que será definido pelo ID do registro
        row_value = el.value;

        //Agora dos elementos da mesma linha serão recuperados pelo value comum a todos
        //Lembrando, os elementos de uma mesma tr possuem o mesmo value
        row_th = $("th[value='"+ row_value +"']");
        row_tds = $("td[value='"+ row_value +"']");

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/loan_devolution.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            let loan_id = document.getElementById("id_loan-devolution").value = row_th[0].innerHTML;;
            let_book_id = document.getElementById("id_book-devolution").value = row_tds[0].innerHTML;


            }

        });
    }



