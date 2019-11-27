$(function(){
	$(".js-basic-example").dataTable();
	
	$("#btn-add").on("click", function(){
		$("#type").val ( "add" );
		$("#content-img").hide();
		$("#file").prop("required", true);
		$("#defaultModal").modal ( "show" );
	});
	
	$(".js-basic-example").on("click", ".btn-edit", function(){
		var data = {"key" : $(this).attr("attr-data")};
		$.ajax({
			url : base_url + "slideshow/ajax_finder",
			type : "POST",
			dataType : "JSON",
			data : data,
			success : function(data){
				if ( data.type == 'done' ){
					$("#id").val ( data.msg[0].a );
					$("#type").val ( "edit" );
					$("#text_slide").val ( data.msg[0].b );
					$("#img-data").attr("src", basic_url + "assets/slideshow/" + data.msg[0].c );
					$("#content-img").show();
					$("#file").prop("required", false);
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
	
	$("#default-form").ajaxForm({
		url : base_url + "slideshow/ajax_validation",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#btn-save").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type == 'done' ){
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
					url : base_url + "slideshow/ajax_remove",
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