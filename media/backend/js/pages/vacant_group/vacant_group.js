$(function () {
	// DATATABLE
	$('.js-basic-example').DataTable();
	
	// BUAT NAMBAH
	$("#btn-add").on("click", function(){
		$("#type").val ( "add" );
		$("#defaultModal").modal ( "show" );		
	});

	$("#btn-add").on("click", function(){
		$.ajax({
			url : base_url + "vacant/get_vacantUnit",
			type : "POST",
			dataType : "JSON",
			success : function(data) {
				$('#v_unit_id').html('<option>-- Please Select --</option>');
				for (var i = 0; i < data.length; i++) {
					$('#v_unit_id').append('<option value="' + data[i].vacant_unit_id + '">' + data[i].unit_name + '</option>');
				}
				$("#type").val ( "add" );
				$("#defaultModal").modal("show");
			}
		});
	});

	$('.js-basic-example').on("click", "button[name=primaryBtnV]", function() {
		$.ajax({
			url : base_url + "vacant/get_vacantUnit",
			type : "POST",
			dataType : "JSON",
			success : function(data) {
					$('#v_unit_id').html('<option value="">-- Please Select --</option>');
				for (var i = 0; i < data.length; i++) {
					$('#v_unit_id').append('<option value="' + data[i].vacant_unit_id + '">' + data[i].unit_name + '</option>');
				}
			}
		});
	});
	
	// BUAT EDIT
	$('.js-basic-example').on("click", ".btn-edit", function(){
		var data = {"key" : $(this).attr("tag-id")};
		$.ajax({
			url : base_url + "vacantGroup/ajax_finder",
			type : "POST",
			dataType : "JSON",
			data : data,
			success : function(data){
				if ( data.type == 'done' ){
					$("#type").val ( "edit" );
					$("#id").val ( data.msg[0].a );
					$("#vacant_group_name").val ( data.msg[0].b );
					$("#v_unit_id").val ( data.msg[0].c );
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
	
	$('#default-form').validate({
		highlight: function (input) {
			$(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input) {
			$(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element) {
			$(element).parents('.form-group').append(error);
		}
	});
	// VALIDASI SEKALIAN NAMBAHIN
	$("#default-form").ajaxForm({
		url : base_url + "vacantGroup/ajax_validation",
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
	
	// BUAT DELETE
	$(".js-basic-example").on("click", ".btn-remove", function(){
		var data = {"key" : $(this).attr("tag-id")};
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
					url : base_url + "vacantGroup/ajax_remove",
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