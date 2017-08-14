$(function(){

	$("[data-projectuser]").on("click",editProjectUserModal);

	$("#select-project").on("change",onSelectProjectChange);	

	$("#select-project-modal").on("change",onSelectProjectChangeModal);	

		if($("#old_project").val()!=""){

			$('#select-project option[value='+$("#old_project").val()+']').attr('selected','selected');

			onSelectProjectChangeAjax($("#old_project").val());
		}

});


function editProjectUserModal(){

	var ProjectUser = $(this).data("projectuser");
	var Project 	= $(this).data("project");
	var Level   	= $(this).data("level");


	$('#select-project-modal option[value='+Project+']').attr('selected','selected');

	$("#project_user_modal").val(ProjectUser);

	onSelectProjectChangeAjaxModal(Project,Level);

	$('#select-project-modal').prop("disabled",true);

}


function onSelectProjectChange() {

	var project_id = $(this).val();

	if(! project_id) {
		$("#select-level").html("<option value='' >Seleccione un nivel</option>");
		// $("#select-level").prop("disabled",true);	
		return;
	}

	onSelectProjectChangeAjax(project_id);
}


function onSelectProjectChangeModal() {

	var project_id = $(this).val();

	if(! project_id) {
		$("#select-level-modal").html("<option value='' >Seleccione un nivel</option>");
		// $("#select-level").prop("disabled",true);	
		return;
	}

	onSelectProjectChangeAjaxModal(project_id,null);
}


function onSelectProjectChangeAjax(project_id) {
	

	$.get("/api/proyecto/"+project_id+"/niveles",function(data) {
		
		var html_select = "<option value=''>Seleccione nivel</option>";

		if(data.length>0)
			$("#select-level").prop("disabled",false);
		else		
			$("#select-level").prop("disabled",true);

		for (var i=0;i<data.length; ++i){

			html_select += "<option value='"+data[i].id+"'>"+data[i].name+"</option>";
		}

		$("#select-level").html(html_select);
	})

}


function onSelectProjectChangeAjaxModal(project_id,Level) {
	

	$.get("/api/proyecto/"+project_id+"/niveles",function(data) {
		
		var html_select = "<option value=''>Seleccione nivel</option>";

		if(data.length>0)
			$("#select-level-modal").prop("disabled",false);
		else		
			$("#select-level-modal").prop("disabled",true);

		for (var i=0;i<data.length; ++i){

			html_select += "<option value='"+data[i].id+"'>"+data[i].name+"</option>";
		}

		$("#select-level-modal").html(html_select);

		if(Level)
			$('#select-level-modal option[value='+Level+']').attr('selected','selected');

		$("#modalEditProjectUser").modal("show");

	})



}