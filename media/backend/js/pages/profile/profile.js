$(function(){
	$("#change-profile-form").ajaxForm({
		url : base_url + "profile/change_data",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#btn-save").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type === 'done' ){
				swal({
						title : "Success!", 
						text : data.msg, 
						type : "success"
					}, 
					function(){
						window.location.reload();
					}
				);
			}
			else{
				swal({
						title : "Error!", 
						text : data.msg, 
						type : "error"
					}, 
					function(){
						swal.close();
						$("#btn-save").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
					}
				);
			}
		}
	});
});