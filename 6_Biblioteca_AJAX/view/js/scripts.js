
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
            $(".search_input").attr("placeholder", "Por nome ou autor");
            $(".search_input").val('');

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
            $(".search_input").attr("placeholder", "Por nome da área");
            $(".search_input").val('');

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
            $(".search_input").attr("placeholder", "Por matrícula ou nome");
            $(".search_input").val('');

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
            $(".search_input").attr("placeholder", "Por nome do livro");
            $(".search_input").val('');

        });

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

    /* GERAÇÃO DOS FORMULÁRIOS -----------------------------------------------------------------------*/

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
            $("#modal_form").hide().html(form_edit_book).slideDown(1000);

            //Recuperação dos valores DEFAULT da linha para o formulário de edição
            id_book = document.getElementById("id-book-edit_input").value = vetor_tds[0].innerHTML;
            title_book = document.getElementById("title-book-edit_input").value = vetor_tds[1].innerHTML;
            author_book = document.getElementById("author-book-edit_input").value = vetor_tds[2].innerHTML;


        });
        
    }

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
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/update/edit_area.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            campo_id = document.getElementById("id-edit-area_input").value = vetor_tds[0].innerHTML;
            campo_nome = document.getElementById("name-area_input").value = vetor_tds[1].innerHTML;

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
            $("#modal_form").hide().html(form_new_book).slideDown(1000);


        });

    });

    //CRIA/GERA FORMULÁRIO DE CADASTRO DE ALUNO
    $(document).on("click", "#btn-new_student" ,function(){
        htdocs = window.location.origin;

        //Renderização do formulário de edição
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/insert/new_student.html", function(responseTxt, statusTxt, xhr){
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
        $("#modal_form").load(htdocs+"/proj_biblioteca/view/modals/forms/delete/delete_book.html", function(responseTxt, statusTxt, xhr){

            $("#modal_form").fadeIn(500);

            if(statusTxt == "success"){

            //Recuperação dos valores de cada campo do registro da tabela HTML
            campo_nome = document.getElementById("data-field_input").value = vetor_tds[0].innerHTML;

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
            campo_nome = document.getElementById("data-field_input").value = vetor_tds[0].innerHTML;

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
            campo_nome = document.getElementById("data-field_input").value = vetor_tds[0].innerHTML;

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
            $("#modal_form").hide().html(form_edit_book).slideDown(1000);

            //Recuperação dos valores DEFAULT da linha para o formulário de edição
            id_book = document.getElementById("book-title_loan_input").value = vetor_tds[0].innerHTML;


        });
    }

    /* EXECUCAÇÃO DAS OPERAÇÕES -NOVO, EDITAR, EXCLUIR -----------------------------------------------------------------------*/

    //EXECUÇÃO DO CADASTRO DE LIVRO
    $(document).on("click", "#btn_register_book" ,function(e){
        e.preventDefault();

        htdocs = window.location.origin;

        //Valores a serem inseridos
        book_title = $("#title-book-new_input").val();
        book_author = $("#author-book-new_input").val();
        book_area = $("#area-book-new_input").val();

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

    //EXECUÇÃO DA EDIÇÃO DE LIVRO******
    $(document).on("click", "#btn_edit_book" ,function(e){
        e.preventDefault();

        //Valores a serem inseridos
        book_id = $("#id-book-edit_input").val();
        book_title = $("#title-book-edit_input").val();
        book_author = $("#author-book-edit_input").val();
        book_area = $("#area-book-edit_input").val();

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
        book_id = $("#id-book-edit_input").val();
        book_title = $("#title-book-edit_input").val();
        book_author = $("#author-book-edit_input").val();
        book_area = $("#area-book-edit_input").val();

        intb_id = parseInt(book_id);
        s_title = toString(book_title);
        s_author = toString(book_author);
        intb_area = parseInt(book_area);

        //Ajax da pesquisa
        $.ajax({

            url: htdocs+"/proj_biblioteca/bridge/bridge.php",
            method: 'POST',
            data: {edit_book: {id: intb_id, title: s_title,author: s_author,area: intb_area}},
            dataType: 'json', //Tratamento da resposta
            beforeSend: function(){ console.log("Editando livro...."); } //Antes de enviar..
    
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

    //EXECUÇÃO DA EXCLUSÃO DE LIVRO*******

    //EXECUÇÃO DA EXCLUSÃO DE LIVRO********

    //EXECUÇÃO DO EMPRÉSTIMO


    /* EMPRÉSTIMO E DEVOLUÇÃO -------------------------------------------------------------------------------*/

    //Realizar devolução
    $(document).on("click", "#btn-do_devolution" ,function(){
        console.log("Realizar devolução")
    });


    /* EVENTOS GERAIS --------------------------------------------------------------------------------------------------*/
    $(document).on("click", ".btn_close" ,function(e){
        e.preventDefault();
        $("#modal_form").fadeOut(500);
    });


