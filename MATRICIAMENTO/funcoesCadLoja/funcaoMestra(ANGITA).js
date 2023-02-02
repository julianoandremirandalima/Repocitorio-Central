$(document).ready(function(){
	
	
	var dataTable = $('#user_data').DataTable({
		"processing":false,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"funcoesCadLoja/buscar.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],
		"oLanguage": {
                    "sProcessing":   "Processando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "Não foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "Último"
                    }
                },

	});

  $('#add_button').click(function(){
    $('#userModal').modal('show');
	var senhax = document.getElementById('senha');
	$(senhax).hide();
		$('#user_form')[0].reset();
		$('.modal-title').text("Adicionar Usuário");
		$('#action').val("Adicionar");
		$('#operacao').val("Add");
		$('#user_uploaded_image').html('');
	});


	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var nome = $('#nome').val();
		var usuario = $('#usuario').val();
		
		var etx = $('#imagem_usuario').val().split('.').pop().toLowerCase();
		if(etx != '')
		{
			if(jQuery.inArray(etx, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Formato da imagem inválido");
				$('#imagem_usuario').val('');
				return false;
			}
		}	
		if(nome != '' && usuario != '')
		{
			$.ajax({
				url:"funcoesCadLoja/inserir_alterar.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					//alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Nome e Sobre Nome, Obrigatórios");
		}
	});
	
	$(document).on('click', '.update', function(){
		var usuario_id = $(this).attr("id");
		$.ajax({
			url:"funcoesCadLoja/busca_unica.php",
			method:"POST",
			data:{usuario_id:usuario_id},
			dataType:"json",
			success:function(data)
			{
				//MONTA O ID E CARREGA OS VALORES VINDO DA BUSCA_UNICA.PHP E ENVIA PARA OS CAMPOS DENTRO DA MODAL
				$('#userModal').modal('show');
				$('#usuarioLogista').val(data.usuarioLogista);
				$('#nomeLogista').val(data.nomeLogista);
				$('#razaosocialLogista').val(data.razaosocialLogista);
				$('#cnpjLogista').val(data.cnpjLogista);
				$('#enderecoLogista').val(data.enderecoLogista);
				$('#telefoneLogista').val(data.telefoneLogista);
				$('#emailLogista').val(data.emailLogista);
				$('#statusLogista').val(data.statusLogista);
				$('#descontologista').val(data.descontologista);
				$('#responsavelLogista').val(data.responsavelLogista);
				$('#cpfresponsavelLogista').val(data.cpfresponsavelLogista);
				$('.modal-title').text("Editar");
				
				$('#usuario_id').val(usuario_id);
				$('#user_uploaded_image').html(data.imagem_usuario);
				$('#action').val("Editar");
				$('#operacao').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var usuario_id = $(this).attr("id");
		if(confirm("Tem certeza que deseja excluir esse Usuario ?"))
		{
			$.ajax({
				url:"funcoesCadLoja/delete.php",
				method:"POST",
				data:{usuario_id:usuario_id},
				success:function(data)
				{
					//alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});