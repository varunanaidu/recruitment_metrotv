$(function () {
    $('.js-basic-example').DataTable();
	$("#btn-add").on("click", function(){
		$("#type").val ( "add" );
		$("#defaultModal").modal ( "show" );
	});
	
	$("#default-form").ajaxForm({
		url : base_url + "users/ajax_validation",
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
	
	$(".js-basic-example").on("click", ".btn-edit", function(){
		var data = {"key" : $(this).attr("attr-data") };
		$.ajax({
			url : base_url + "users/find_data",
			type : "POST",
			dataType : "JSON",
			data : data,
			success : function(data){
				if ( data.type == 'done' ){
					$("#uname").val ( data.msg[0].B );
					$("#ufname").val ( data.msg[0].C );
					$("#id").val ( data.msg[0].A );
					$("#type").val ( "edit" );
					$("#defaultModal").modal ( "show" );
				}
				else{
					swal({
							title : "Error!", 
							text : data.msg, 
							type : "error"
						}, 
						function(){
							swal.close();
						}
					);
				}
			}
		});
	});
	
	$(".js-basic-example").on("click", ".btn-remove", function(){
		var data = {"key" : $(this).attr("attr-data")};
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					url : base_url + "users/ajax_remove",
					type : "POST",
					data : data,
					dataType : "JSON",
					success : function(data){
						if ( data.type === 'done' ){
							swal({
									title : "Deleted!", 
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
								}
							);
						}
					}
				});
				
			} else {
				swal("Cancelled", "Remove data cancelled", "error");
			}
		});
	});
});