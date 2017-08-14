$(function () {
	$('#list-of-projects').on('change', onNewProjectSelected);

	$("#mostrarCredits").on("click",function(){

		$("#creditsModal").modal("show");

	});

});

function onNewProjectSelected() {

	var project_id = $(this).val();
	location.href = '/seleccionar/proyecto/'+project_id;
}
