$(document).on('click','#btn-add',function(e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "funcoesCadServ/save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#addEmployeeModal').modal('hide');
                    //alert('Adicionado com sucesso!'); 
                   location.reload();
										
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
$(document).on('click','.update',function(e) {
    var id=$(this).attr("data-id");
    var nome=$(this).attr("data-nome");
    var matricula=$(this).attr("data-matricula");
    var local=$(this).attr("data-local");
    var setor=$(this).attr("data-setor");
    var data_nascimento=$(this).attr("data-data");
var estado_civil=$(this).attr("data-estadocivil");
var sexo=$(this).attr("data-sexo");
var escolaridade=$(this).attr("data-escolaridade");
var rg=$(this).attr("data-rg");
var cpf=$(this).attr("data-cpf");
var endereco=$(this).attr("data-endereco");
var numero=$(this).attr("data-numero");
var bairro=$(this).attr("data-bairro");
var cidade=$(this).attr("data-cidade");
var cep=$(this).attr("data-cep");
var funcao=$(this).attr("data-funcao");
var tipo=$(this).attr("data-tipo");
var data1=$(this).attr("data-data1");
var data2=$(this).attr("data-data2");
var telefone=$(this).attr("data-telefone");
var celular=$(this).attr("data-celular");
var wattsap=$(this).attr("data-wattsap");
var email=$(this).attr("data-email");
var limite=$(this).attr("data-limite");
    



    $('#id_u').val(id);
    $('#nome_u').val(nome);
    $('#matricula_u').val(matricula);
    $('#local_u').val(local);
    $('#setor_u').val(setor);
    $('#data_u').val(data_nascimento);
$('#estadocivil_u').val(estado_civil);
$('#sexo_u').val(sexo);
$('#escolaridade_u').val(escolaridade);
$('#rg_u').val(rg);
$('#cpf_u').val(cpf);
$('#endereco_u').val(endereco);
$('#numero_u').val(numero);
$('#bairro_u').val(bairro);
$('#cidade_u').val(cidade);
$('#cep_u').val(cep);
$('#funcao_u').val(funcao);
$('#tipo_u').val(tipo);
$('#data1_u').val(data1);
$('#data2_u').val(data2);
$('#telefone_u').val(telefone);
$('#celular_u').val(celular);
$('#wattsap_u').val(wattsap);
$('#email_u').val(email);
$('#limite_u').val(limite);
});

$(document).on('click','#update',function(e) {
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "funcoesCadServ/save.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#editEmployeeModal').modal('hide');
                    //alert('Alterado com sucesso!'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
$(document).on("click", ".delete", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
	
    
});
$(document).on("click", "#delete", function() { 
    $.ajax({
        url: "funcoesCadServ/save.php",
        type: "POST",
        cache: false,
        data:{
            type:3,
            id: $("#id_d").val()
        },
        success: function(dataResult){
                $('#deleteEmployeeModal').modal('hide');
                $("#"+dataResult).remove();
        
        }
    });
});
$(document).on("click", "#delete_multiple", function() {
    var user = [];
    $(".user_checkbox:checked").each(function() {
        user.push($(this).data('user-id'));
    });
    if(user.length <=0) {
        alert("Selecione os registros."); 
    } 
    else { 
        WRN_PROFILE_DELETE = "Tem certeza de que deseja excluir "+(user.length>1?"esses":"esse")+" registro(s)?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if(checked == true) {
            var selected_values = user.join(",");
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "funcoesCadServ/save.php",
                cache:false,
                data:{
                    type: 4,						
                    id : selected_values
                },
                success: function(response) {
                    var ids = response.split(",");
                    for (var i=0; i < ids.length; i++ ) {	
                        $("#"+ids[i]).remove(); 
                    }	
                } 
            }); 
        }  
    } 
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });
});



