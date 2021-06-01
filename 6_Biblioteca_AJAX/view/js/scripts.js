
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

        //Recuperamos a última classe do elemento //Que é igual ao ID do registro na tabela
        class_reg = el.classList[3];

        //Transformo o nome da classe em um array de caracteres, para recuperar o ID do registro
        split_class = class_reg.split(''); //["r", "-", "0"]

        if(split_class.length > 3){
            reg_id = split_class[2] + split_class[3];
        }else{
            reg_id = split_class[2]; 
        }

        //console.log(reg_id)

        //Agora vou recuperar os table data da mesma linha a partir da classe 
        //Lembrando, os td de uma mesma tr possuem a mesma classe definida por r-$value['id']
        id_reg_fields = "r-" + reg_id;
        vetor_tds = document.getElementsByClassName(id_reg_fields);
        //console.log(vetor_tds);

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/update/edit_student.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            campo_matricula = document.getElementById("id-student-edit_input").value = vetor_tds[0].innerHTML;
            campo_nome = document.getElementById("name-student-edit_input").value = vetor_tds[1].innerHTML;
            campo_email = document.getElementById("email-student-edit_input").value = vetor_tds[2].innerHTML;
            campo_cpf = document.getElementById("cpf-student-edit_input").value = vetor_tds[3].innerHTML;
            campo_date = document.getElementById("date-student-edit_input").value = vetor_tds[4].innerHTML;

            }

        });
    }

    //FORMULÁRIO DE EDITAR ÁREA
    function updateArea(el){
        htdocs = window.location.origin;

        //Recuperamos a última classe do elemento //Que é igual ao ID do registro na tabela
        class_reg = el.classList[3];

        //Transformo o nome da classe em um array de caracteres, para recuperar o ID do registro
        split_class = class_reg.split(''); //["r", "-", "0"]

        if(split_class.length > 3){
            reg_id = split_class[2] + split_class[3];
        }else{
            reg_id = split_class[2]; 
        }

        //Agora vou recuperar os table data da mesma linha a partir da classe 
        //Lembrando, os td de uma mesma tr possuem a mesma classe definida por r-$value['id']
        id_reg_fields = "r-" + reg_id;
        vetor_tds = document.getElementsByClassName(id_reg_fields);
        //console.log(vetor_tds);

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/update/edit_areaa.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            campo_id = document.getElementById("id-edit-area_input").value = vetor_tds[0].innerHTML;
            campo_nome = document.getElementById("name-area-edit_input").value = vetor_tds[1].innerHTML;

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

        //Recuperamos a última classe do elemento //Que é igual ao ID do registro na tabela
        class_reg = el.classList[3];

        //Transformo o nome da classe em um array de caracteres, para recuperar o ID do registro
        split_class = class_reg.split(''); //["r", "-", "0"]

        if(split_class.length > 3){
            reg_id = split_class[2] + split_class[3];
        }else{
            reg_id = split_class[2]; 
        }

        //Agora vou recuperar os table data da mesma linha a partir da classe 
        //Lembrando, os td de uma mesma tr possuem a mesma classe definida por r-$value['id']
        id_reg_fields = "r-" + reg_id;
        vetor_tds = document.getElementsByClassName(id_reg_fields);
        //console.log(reg_id, vetor_tds);

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
            id_book = document.getElementById("id-book-edit_input").value = vetor_tds[0].innerHTML;
            title_book = document.getElementById("title-book-edit_input").value = vetor_tds[1].innerHTML;
            author_book = document.getElementById("author-book-edit_input").value = vetor_tds[2].innerHTML;


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

        //Recuperamos a última classe do elemento //Que é igual ao ID do registro na tabela
        class_reg = el.classList[3];

        //Transformo o nome da classe em um array de caracteres, para recuperar o ID do registro
        split_class = class_reg.split(''); //["r", "-", "0"]
        reg_id = split_class[2]; 

        //Agora vou recuperar os table data da mesma linha a partir da classe 
        //Lembrando, os td de uma mesma tr possuem a mesma classe definida por r-$value['id']
        id_reg_fields = "r-" + reg_id;
        vetor_tds = document.getElementsByClassName(id_reg_fields);
        //console.log(vetor_tds);

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/del_book.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            let book_id = document.getElementById("id-book-delete_input").value = vetor_tds[0].innerHTML;

            }

        });
    }

    //CRIA/GERA FORMULÁRIO DE EXCLUIR ALUNO
    function deleteStudent(el){
        htdocs = window.location.origin;

        //Recuperamos a última classe do elemento //Que é igual ao ID do registro na tabela
        class_reg = el.classList[3];

        //Transformo o nome da classe em um array de caracteres, para recuperar o ID do registro
        split_class = class_reg.split(''); //["r", "-", "0"]

        if(split_class.length > 3){
            reg_id = split_class[2] + split_class[3];
        }else{
            reg_id = split_class[2]; 
        }

        //Agora vou recuperar os table data da mesma linha a partir da classe 
        //Lembrando, os td de uma mesma tr possuem a mesma classe definida por r-$value['id']
        id_reg_fields = "r-" + reg_id;
        vetor_tds = document.getElementsByClassName(id_reg_fields);

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/delete_student.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            let student_matr = document.getElementById("id-student-delete_input").value = vetor_tds[0].innerHTML;

            }

        });
    }

    //CRIA/GERA FORMULÁRIO DE EXCLUIR ÁREA
    function deleteArea(el){
        htdocs = window.location.origin;

        //Recuperamos a última classe do elemento //Que é igual ao ID do registro na tabela
        class_reg = el.classList[3];

        //Transformo o nome da classe em um array de caracteres, para recuperar o ID do registro
        split_class = class_reg.split(''); //["r", "-", "0"]
        reg_id = split_class[2]; 

        //Agora vou recuperar os table data da mesma linha a partir da classe 
        //Lembrando, os td de uma mesma tr possuem a mesma classe definida por r-$value['id']
        id_reg_fields = "r-" + reg_id;
        vetor_tds = document.getElementsByClassName(id_reg_fields);
        //console.log(vetor_tds);

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/delete_area.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            let campo_nome = document.getElementById("id-area-delete_input").value = vetor_tds[0].innerHTML;

            }

        });
    }

    //CRIA/GERA FORMULÁRIO DE REALIZAR EMPRÉSTIMO DE LIVRO
    function bookLoan(el){
        htdocs = window.location.origin;

        //Recuperamos a última classe do elemento //Que é igual ao ID do registro na tabela
        class_reg = el.classList[3];

        //Transformo o nome da classe em um array de caracteres, para recuperar o ID do registro
        split_class = class_reg.split(''); //["r", "-", "0"]

        if(split_class.length > 3){
            reg_id = split_class[2] + split_class[3];
        }else{
            reg_id = split_class[2]; 
        }

        //Agora vou recuperar os table data da mesma linha a partir da classe 
        //Lembrando, os td de uma mesma tr possuem a mesma classe definida por r-$value['id']
        id_reg_fields = "r-" + reg_id;
        vetor_tds = document.getElementsByClassName(id_reg_fields);
        //console.log(reg_id, vetor_tds);

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
            let id_book = document.getElementById("book-title_loan_input").value = vetor_tds[0].innerHTML;


        });
    }

    //CRIA/GERA FORMULÁRIO DE REALIZAR DEVOLUÇÃO DO LIVRO
    //Realizar devolução
    function doDevolution(el){

        //console.log(el)

        htdocs = window.location.origin;

        //Recuperamos a última classe do elemento //Que é igual ao ID do registro na tabela
        class_reg = el.classList[3];

        //Transformo o nome da classe em um array de caracteres, para recuperar o ID do registro
        split_class = class_reg.split(''); //["r", "-", "0"]

        if(split_class.length > 3){
            reg_id = split_class[2] + split_class[3];
        }else{
            reg_id = split_class[2]; 
        }

        //Agora vou recuperar os table data da mesma linha a partir da classe 
        //Lembrando, os td de uma mesma tr possuem a mesma classe definida por r-$value['id']
        id_reg_fields = "r-" + reg_id;
        vetor_tds = document.getElementsByClassName(id_reg_fields);
        //console.log(reg_id, vetor_tds);

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/loan_devolution.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            let loan_id = document.getElementById("id_loan-devolution").value = vetor_tds[0].innerHTML;
            let_book_id = document.getElementById("id_book-devolution").value = vetor_tds[1].innerHTML;


            }

        });
    }

    /* EXECUCAÇÃO DAS OPERAÇÕES -NOVO, EDITAR -----------------------------------------------------------------------*/

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

    //EXECUÇÃO DA EDIÇÃO DE ÁREA*********
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
    $(".search_btn").click(function(e){
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

                //console.log(response)

                //Os containers são esvaziados para impedir sobreposição de conteúdo
                $('#tb-forms_section').empty();

                $("#tb-forms_section").hide().html(response).slideDown(1000);
                $(".search_input").val('');

            }else{

                //Caso não exista o valor do banco de dados
                console.log("Nenhum registro encontrado");

            }
            
        });

    });


