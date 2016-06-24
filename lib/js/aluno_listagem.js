var save_method; //for save method string
var base_url = 'http://localhost/project/';

$(document).ready(function() 
{
    var container = $("#container_dados_a");
    var lista = container.find("#lista_dados_a");
    var html = '';

    $.getJSON(base_url+'aluno/lista_dados_a', function(data)
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

    var container_formacao = $("#container_dados_f_a");
    var lista_formacao = container_formacao.find("#lista_dados_f_a");
    var html_formacao = '';

    $.getJSON(base_url+'aluno/lista_dados_f', function(data)
    {   
        if(data)
        {    
            $.each(data, function(k, v)
            {
                html_formacao += '<div class="col-md-6">';
                html_formacao +=  '<ul class="list-group">';
                html_formacao +=     '<li class="list-group-item"><b>Formado em:</b> '+v.curso+'</li>';
                html_formacao +=     '<li class="list-group-item">'
                html_formacao +=         '<button type="button"  onclick="editar_formacao_aluno('+v.id_curso_aluno+')" class="btn btn-primary btn-circle"> <i class="fa fa-edit"></i></button>';
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
});
