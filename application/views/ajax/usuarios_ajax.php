<script type="text/javascript">
 $('.name_usuario').append("<?php echo $this->session->userdata('nome');?>");

//Função que troca cores dos botoes no painel
$(document).ready(function() 
{
	$(".btn-pref .btn").click(function () 
	{
    	$(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    	// $(".tab").addClass("active"); // instead of this do the below 
    	$(this).removeClass("btn-default").addClass("btn-primary");   
	});
});

$(document).ready(function() 
{
	var container = $("#container");
	var lista = container.find("#lista");
	var html = '';

	$.getJSON('<?php echo base_url('professor/lista_dados')?>', function(data)
	{	
		$.each(data, function(k, v)
		{
			html +=	 '<ul class="list-group">';
            html +=  	'<li class="list-group-item"><b>Nome:</b> '+v.nome+'</li>';
            html +=   	'<li class="list-group-item"><b>CPF:</b> '+v.cpf+'</li>';
            html +=    	'<li class="list-group-item"><b>Data de Nascimento:</b> ' +v.dt_nascimento+'</li>';
            html +=    	'<li class="list-group-item"><b>Sexo:</b> '+v.sexo+'</li>';
            html +=    	'<li class="list-group-item"><b>Area de atuação:</b> '+v.area+'</li>';
            html +=    	'<li class="list-group-item"><i class="fa fa-phone"></i> <b>Contato:</b> '+v.telefone+'</li>';
            html +=    	'<li class="list-group-item"><i class="fa fa-envelope"></i> <b>Email:</b> '+v.email+'</li>';
            html +=  '</ul>';
		
		});
		lista.html(html);
	});
});


</script>
