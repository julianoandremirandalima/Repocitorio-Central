$(document).on('click','#btn-add',function(e) {
    var data = $("#user_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "funcoesCadDependente/save.php",
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
    var data_nascimento=$(this).attr("data-data");
    var parentesco=$(this).attr("data-parentesco");

    $('#id_u').val(id);
    $('#nome_u').val(nome);
    $('#data_u').val(data_nascimento);
    $('#parentesco_u').val(parentesco);

});

$(document).on('click','#update',function(e) {
    var data = $("#update_form").serialize();
   
    $.ajax({
        data: data,
        type: "post",
        url: "funcoesCadDependente/save.php",
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
    //alert(data);
});
$(document).on("click", ".delete", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
	
    
});
$(document).on("click", "#delete", function() { 
    $.ajax({
        url: "funcoesCadDependente/save.php",
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
                url: "funcoesCadDependente/save.php",
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



