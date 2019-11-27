$(function () {
    $('#sign_in').validate({
        highlight: function (input) {            
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
	
	$("#sign_in").ajaxForm({
		url : base_url + "auth/checkin",
		dataType: "JSON",
		beforeSubmit : function(){
			$("#btn-sign-in").html ( "Processing..." );
			$("#btn-sign-in").attr("disabled", true);
		},
		success : function(data){
			// console.log(data);
			// return;
			if ( data.type === 'done' ){
				swal("Success!",data.msg,"success");
				window.location.reload();
			}
			else{
				swal({
						title : "Error!", 
						text : data.msg, 
						type : "error"
					}).then(function(){
						// swal.close();
						$("#btn-sign-in").html ( "SIGN IN" );
						$("#btn-sign-in").attr("disabled", false);
					}
				);				
			}
		}
	});
});