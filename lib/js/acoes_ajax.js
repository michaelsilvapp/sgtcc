var save_method; //for save method string
var base_url = 'http://localhost/project/';

$(document).ready(function() 
{
    var container = $("#container_dados");
    var lista = container.find("#lista_dados");
    var html = '';

    $.getJSON(base_url+'pessoa/lista_dados_a', function(data)
    {   
        if(data)
        {    
            $.each(data, function(k, v)
            {
    
                html +=     '<li class="list-group-item"><b>Nome:</b> '+v.nome+'</li>';
                html +=     '<li class="list-group-item"><b>CPF:</b> '+v.cpf+'</li>';
                html +=     '<li class="list-group-item"><b>Data de Nascimento:</b> ' +v.dt_nascimento+'</li>';
                html +=     '<li class="list-group-item"><b>Area de atuação:</b> '+v.area+'</li>';
                html +=     '<li class="list-group-item"><b>Minhas Copetencias :</b> '+v.copetencia+'</li>';
                html +=     '<li class="list-group-item"><i class="fa fa-phone"></i> <b>Contato:</b> '+v.telefone+'</li>';
                html +=     '<li class="list-group-item"><i class="fa fa-envelope"></i> <b>Email:</b> '+v.email+'</li>';

            });
        }
        else
        {
            html += '<li class="list-group-item"><b>Nada encontrado:</b></li>';
        }

        lista.html(html);
    });

    var container_formacao = $("#container_dados_f");
    var lista_formacao = container_formacao.find("#lista_dados_f");
    var html_formacao = '';

    $.getJSON(base_url+'pessoa/lista_dados_f', function(data)
    {   
        if(data)
        {    
            $.each(data, function(k, v)
            {
                html_formacao += '<div class="col-md-6">';
                html_formacao +=  '<ul class="list-group">';
                html_formacao +=     '<li class="list-group-item"><b>Formado em:</b> '+v.curso+'</li>';
                html_formacao +=     '<li class="list-group-item">'
                html_formacao +=         '<button type="button"  onclick="editar_formacao('+v.id_curso_pessoa+')" class="btn btn-primary btn-circle"> <i class="fa fa-edit"></i></button>';
                html_formacao +=         '<button type="button" class="btn btn-danger btn-circle pull-right"><i class="fa fa-trash-o"></i></button>';
                html_formacao +=     '</li>';
                html_formacao +=  '</ul>';
                html_formacao += '</div>';
            });
        }
        else
        {
            html_formacao += '<li class="list-group-item"><b>Nada encontrado:</b></li>';   
        }
        lista_formacao.html(html_formacao);
    });

    $.getJSON(base_url+'pessoa/conta_formacaoes', function(data)
    {
            if(data == 1)
            {
                 $('#add_formacao_aluno').attr('disabled',true);
            }
            else
            {
                $('#add_formacao_aluno').attr('disabled',false);
            }
    });
});
$(document).ready(function() 
{
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});

function opcao_cadastro()
{
    $('#form-button')[0].reset(); // reset form on modals
    $('#modal_button').modal('show'); // show bootstrap modal
    $('.modal-title').text('Cadastrar'); // Set Title to Bootstrap modal title
}

function add_aluno()
{
    save_method = 'novo_aluno';
    msg = 'cadastro';
    $('#form_user')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_button').modal('hide');//fechar o modal de buttons
    $('#modal_user').modal('show'); // show bootstrap modal
    $('.modal-title').text('Aluno'); // Set Title to Bootstrap modal title
}

function add_professor()
{
    save_method = 'novo_professor';
    msg = 'cadastro';
    $('#form_user')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_button').modal('hide');//fechar o modal de buttons
    $('#modal_user').modal('show'); // show bootstrap modal
    $('.modal-title').text('Professor'); // Set Title to Bootstrap modal title
}

function alterar_senha()
{
    save_method = 'alterar_senha';
    msg = 'alterar';
    $('#form_senha')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_senha').modal('show'); // show bootstrap modal
    $('.modal-title').text('Alterar Senha'); // Set Title to Bootstrap modal title
}

function add_formacao()
{
    save_method = 'nova_formacao';
    msg = 'cadastro';
    $('#form_formacao')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_formacao').modal('show'); // show bootstrap modal
    $('.modal-title').text('Formação'); // Set Title to Bootstrap modal title
}

function busca_curso(tipo_cursos)
{         
    $.post( base_url + "professor/busca_por_curso", { tipo_cursos : tipo_cursos }, function(data)
    {
        $('#curso').html(data);
    });
}

function add_img()
{
    save_method = 'alterar_img';
    msg = 'alterar';
    $('#form_img')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_img').modal('show'); // show bootstrap modal
    $('.modal-title').text('Alterar Imagem'); // Set Title to Bootstrap modal title
}

function salvar()
{
    $('#btn_salvar').text('Salvando...'); //change button text
    $('#btn_salvar').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'novo_professor')
    {
        url = base_url + 'pessoa/cadastrar_pessoa/professor';
        data_form = $('#form_user').serialize();
    }
    else if(save_method == 'novo_aluno')
    {
        url = base_url + 'pessoa/cadastrar_pessoa/aluno';
        data_form = $('#form_user').serialize();
    }

    else if(save_method == 'nova_formacao')
    {
        url = base_url + 'pessoa/cadastrar_formacao';
        data_form = $('#form_formacao').serialize();
    }

    else if(save_method == 'alterar_formacao')
    {
        url = base_url + 'pessoa/alterar_formacao';
        data_form = $('#form_formacao').serialize();
    }
    else if(save_method == 'alterar_pessoa')
    {
        url = base_url + 'pessoa/alterar_pessoa';
        data_form = $('#form_user').serialize();
    }
    
    else if(save_method == 'alterar_senha')
    {
        url = base_url + 'pessoa/alterar_senha';
        data_form = $('#form_senha').serialize();
    }

    $.ajax({
        url : url,
        type: "POST",
        data: data_form,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_user').modal('hide');
                $('#modal_senha').modal('hide');
                $('#modal_formacao').modal('hide');

                $('#modal_alerta').modal('show'); // show bootstrap modal
                if(msg == 'cadastro')
                {
                    $('.alerta-msg').text('Cadastro realizado com sucesso'); // Set Title to Bootstrap modal title
                }
                else if(msg == 'alterar')
                {
                     $('.alerta-msg').text('Alteração realizada com sucesso'); // Set Title to Bootstrap modal title
                }
                    location.reload();
            }
            else
            {
                for (var i = 0; i < data.campo.length; i++) 
                {
                    $('[name="'+data.campo[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.campo[i]+'"]').next().text(data.msg_erro[i]); //select span help-block class set text error string
                }
            }
            $('#btn_salvar').text('Salvar'); //change button text
            $('#btn_salvar').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            $('#modal_alerta_erro').modal('show'); // show bootstrap modal
            $('.alerta-msg').text('ERRO :('); // Set Title to Bootstrap modal title
            $('#btn_salvar').text('Salvar'); //change button text
            $('#btn_salvar').attr('disabled',false); //set button enable 

        }
    });

}

function autentica_dados_login()
{
    $('#btnlogar').text('Entrado...'); //change button text
    $('#btnlogar').attr('disabled',true); //set button disable 

    $.ajax({
        url : base_url + 'login/verfica_login',
        type: "POST",
        data: $('#form_valida_login').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#btnlogar').text('Logado com sucesso...'); //change button text
                window.location.href = base_url + 'home';
            }
            else
            {
                for (var i = 0; i < data.campo.length; i++) 
                {
                    $('[name="'+data.campo[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.campo[i]+'"]').next().text(data.msg_erro[i]); //select span help-block class set text error string
                }
            }
            $('#btnlogar').text('Fazer Login'); //change button text
            $('#btnlogar').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            $('[name="login_senha"]').parent().parent().addClass('has-error'); 
            $('[name="login_senha"]').next().text('Login ou Senha não conferem ou você selecionou tipo de usuario errado');
            $('#btnlogar').text('Fazer Login'); //change button text
            $('#btnlogar').attr('disabled',false); //set button enable 

        }
    });
}

function editar(id)
{
    save_method = 'alterar_pessoa';
    msg = 'alterar';
    $('#form_user')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + 'pessoa/editar_pessoa/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nome"]').val(data.nome);
            $('[name="dt_nascimento"]').val(data.date);
            $('[name="telefone"]').val(data.telefone);
            $('[name="copetencia"]').val(data.copetencia);
            $('[name="area_id"]').val(data.area_id);

            $('#modal_user').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Dados'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function editar_formacao(id)
{
    save_method = 'alterar_formacao';
    msg = 'alterar';
    $('#form_formacao')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : base_url + 'pessoa/editar_formacao/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);
            $('[name="tipo_curso"]').val(data.tipo_curso);
            $('[name="curso"]:selected').val(data.curso);
            $('[name="id_curso_pessoa"]').val(data.id_curso_pessoa);

            $('#modal_formacao').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Curso'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}



function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : ""+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
