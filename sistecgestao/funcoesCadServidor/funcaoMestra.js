$(document).ready(function(){
	
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"funcoesCadServidor/buscar.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":true,
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
		var usuario = $('#matricula').val();
		
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
				url:"funcoesCadServidor/inserir_alterar.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Nome e Matrícula, Obrigatórios");
		}
	});
	
	$(document).on('click', '.update', function(){
		var usuario_id = $(this).attr("id");
		
		$.ajax({
			url:"funcoesCadServidor/busca_unica.php",
			method:"POST",
			data:{usuario_id:usuario_id},
			dataType:"json",
			success:function(data)
			{
				//MONTA O ID E CARREGA OS VALORES VINDO DA BUSCA_UNICA.PHP E ENVIA PARA OS CAMPOS DENTRO DA MODAL
				$('#userModal').modal('show');

				


				$('#matricula').val(data.matricula);
				$('#nome').val(data.nome);
				$('#data_nascimento').val(data.data_nascimento);
				$('#estado_civil').val(data.estado_civil);
				$('#sexo').val(data.sexo);
				$('#escolaridade').val(data.escolaridade);
				$('#rg').val(data.rg);
				$('#cpf').val(data.cpf);
				$('#enderecox').val(data.enderecox);
				$('#numerox').val(data.numerox);
				$('#bairrox').val(data.bairrox);
				$('#cepx').val(data.cepx);
				$('#cidade').val(data.cidade);
				$('#funcao').val(data.funcao);
				$('#setor').val(data.setor);
				$('#tipo').val(data.tipo);
				$('#data1').val(data.data1);
				$('#data2').val(data.data2);
				$('#telefone').val(data.telefone);
				$('#celular').val(data.celular);
				$('#wattsap').val(data.wattsap);
				$('#email').val(data.email);
				$('#limite').val(data.limite);
				$('#local').val(data.local);



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
				url:"funcoesCadServidor/delete.php",
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