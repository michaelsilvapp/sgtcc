<script type="text/javascript">
var save_method; //for save method string

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
    $('#form_aluno')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_button').modal('hide');//fechar o modal de buttons
    $('#modal_aluno').modal('show'); // show bootstrap modal
    $('.modal-title').text('Aluno'); // Set Title to Bootstrap modal title
}

function add_professor()
{
    save_method = 'novo_professor';
    $('#form_professor')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_button').modal('hide');//fechar o modal de buttons
    $('#modal_professor').modal('show'); // show bootstrap modal
    $('.modal-title').text('Professor'); // Set Title to Bootstrap modal title
}

function salvar_aluno()
{
    $('#btnSalvar_aluno').text('Salvando...'); //change button text
    $('#btnSalvar_aluno').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'novo_aluno') 
    {
        url = "<?php echo base_url('aluno/cadastrar_aluno_ajax')?>";
    } 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_aluno').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_aluno').modal('hide');
                $('#modal_professor').modal('hide');
                $('#modal_alerta').modal('show'); // show bootstrap modal
                if(save_method == 'novo_aluno')
                {
                    $('.alerta-msg').text('Cadastrado realizado com sucesso'); // Set Title to Bootstrap modal title
                }
                else
                {
                    $('.alerta-msg').text('Cadastro editado com sucesso'); // Set Title to Bootstrap modal title
                }
            }
            else
            {
                for (var i = 0; i < data.campo.length; i++) 
                {
                    $('[name="'+data.campo[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.campo[i]+'"]').next().text(data.msg_erro[i]); //select span help-block class set text error string
                }
            }
            $('#btnSalvar_aluno').text('Salvar'); //change button text
            $('#btnSalvar_aluno').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            $('#modal_alerta_erro').modal('show'); // show bootstrap modal
            $('.alerta-msg').text('ERRO :('); // Set Title to Bootstrap modal title
            $('#btnSalvar_aluno').text('Salvar'); //change button text
            $('#btnSalvar_aluno').attr('disabled',false); //set button enable 

        }
    });
}

function salvar_professor()
{
    $('#btnSalvar_professor').text('Salvando...'); //change button text
    $('#btnSalvar_professor').attr('disabled',true); //set button disable 
    var url;
    if(save_method == 'novo_professor')
    {
        url = "<?php echo base_url('professor/cadastrar_professor_ajax')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_professor').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_aluno').modal('hide');
                $('#modal_professor').modal('hide');
                $('#modal_alerta').modal('show'); // show bootstrap modal
                if(save_method == 'novo_professor')
                {
                    $('.alerta-msg').text('Cadastrado realizado com sucesso'); // Set Title to Bootstrap modal title
                }
                else
                {
                    $('.alerta-msg').text('Cadastro editado com sucesso'); // Set Title to Bootstrap modal title
                }
            }
            else
            {
                for (var i = 0; i < data.campo.length; i++) 
                {
                    $('[name="'+data.campo[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.campo[i]+'"]').next().text(data.msg_erro[i]); //select span help-block class set text error string
                }
            }
            $('#btnSalvar_professor').text('Salvar'); //change button text
            $('#btnSalvar_professor').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //$('#modal_alerta_erro').modal('show'); // show bootstrap modal
            //$('.alerta-msg').text('ERRO :('); // Set Title to Bootstrap modal title
            $('#modal_alerta_erro').modal('show'); // show bootstrap modal
            $('.alerta-msg').text('ERRO :('); // Set Title to Bootstrap modal title
            $('#btnSalvar_professor').text('Salvar'); //change button text
            $('#btnSalvar_professor').attr('disabled',false); //set button enable 

        }
    });
}

function autentica_dados_login()
{
    $('#btnlogar').text('Entrado...'); //change button text
    $('#btnlogar').attr('disabled',true); //set button disable 

    var url = "<?php echo base_url('login/verfica_login')?>";

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_valida_login').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                window.location.href = "<?php echo base_url('home'); ?>";
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

function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url('person/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="gender"]').val(data.gender);
            $('[name="address"]').val(data.address);
            $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

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
            url : "<?php echo base_url('person/ajax_delete')?>/"+id,
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

</script>