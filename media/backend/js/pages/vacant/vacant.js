$(function () {
	$('.js-basic-example').DataTable();
	//CKEditor
	CKEDITOR.replace('v_req');
	CKEDITOR.config.height = 100;
	
	$(".dpicker").daterangepicker({
		autoUpdateInput: false,
		locale: {
			format: 'YYYY-MM-DD',
			cancelLabel: 'Clear'
		},		
	});
	
	$(".dpicker").on('apply.daterangepicker', function(ev, picker) {		
		$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
	});

	$(".dpicker").on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
	
	$("#btn-add").on("click", function(){
		// $.ajax({
		// 	url : base_url + "vacant/get_vacantGroup",
		// 	type : "POST",
		// 	dataType : "JSON",
		// 	success : function(data) {
		// 			$('#v_group_id').html('<option>-- Please Select --</option>');
		// 		for (var i = 0; i < data.length; i++) {
		// 			$('#v_group_id').append('<option value="' + data[i].vacant_group_id + '">' + data[i].name + '</option>');
		// 		}
				$("#type").val ( "add" );
				$("#defaultModal").modal("show");
		// 	}
		// });
	});

	// $("#btn-add").on("click", function(){
	// 	$.ajax({
	// 		url : base_url + "vacant/get_vacantUnit",
	// 		type : "POST",
	// 		dataType : "JSON",
	// 		success : function(data) {
	// 				$('#v_unit_id').html('<option>-- Please Select --</option>');
	// 			for (var i = 0; i < data.length; i++) {
	// 				$('#v_unit_id').append('<option value="' + data[i].vacant_unit_id + '">' + data[i].unit_name + '</option>');
	// 			}
	// 			$("#type").val ( "add" );
	// 			$("#defaultModal").modal("show");
	// 		}
	// 	});
	// });
	
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
					url : base_url + "vacant/ajax_remove",
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

	
	// $("#defaultModal").on('shown.bs.modal', function(){
	// // $('#v_unit_id').on("click", function() {
	// 	$.ajax({
	// 		url : base_url + "vacant/get_vacantUnit",
	// 		type : "POST",
	// 		dataType : "JSON",
	// 		success : function(data) {
	// 				$('#v_unit_id').html('<option>-- Please Select --</option>');
	// 			for (var i = 0; i < data.length; i++) {
	// 				$('#v_unit_id').append('<option value="' + data[i].vacant_unit_id + '">' + data[i].unit_name + '</option>');
	// 			}
	// 		}
	// 	});
	// });

	$('#v_unit_id').on("change", function() {
		$.ajax({
			url : base_url + "vacant/get_vacantGroup",
			type : "POST",
			dataType : "JSON",
			data : {"key" : $(this).val()},
			success : function(data) {
					$('#v_group_id').html('<option>-- Please Select --</option>');
				for (var i = 0; i < data.length; i++) {
					$('#v_group_id').append('<option value="' + data[i].vacant_group_id + '">' + data[i].name + '</option>');
				}
			}
		});
	});

	$(".js-basic-example").on("click", ".btn-edit", function(){		
		var data = {"key" : $(this).attr("attr-data")};

		$.ajax({
			url : base_url + "vacant/find_data",
			type : "POST",
			data : data,
			dataType : "JSON",
			success : function(data){
				if ( data.type === 'done' ){
					$("#v_title").val ( data.msg[0].b );
					CKEDITOR.instances['v_req'].setData( data.msg[0].c );
					$("#v_code").val ( data.msg[0].e );
					$('#v_unit_id'). val( data.msg[0].k ).trigger('change');
					setTimeout(function(){
						$('#v_group_id'). val( data.msg[0].i );
					}, 1000);
					$("#type").val ( "edit" );
					$("#id").val ( data.msg[0].a );
					$("#radio_4").removeAttr("checked");
					$("#radio_5").removeAttr("checked");
					if ( data.msg[0].d == "ACTIVE" )
						$("#radio_4").prop("checked", true);
					else
						$("#radio_5").prop("checked", true);

					var start = data.msg[0].f;
					var end = data.msg[0].g;
					$("#candidat_needed").val ( data.msg[0].h );
					$("#img-data").attr("src", basic_url + "assets/vacancy/" + data.msg[0].j );
					$("#content-img").show();


					$(".dpicker").daterangepicker({
						startDate: start,
						endDate : end,
						locale: {
							format: 'YYYY-MM-DD',
							cancelLabel: 'Clear'
						},		
					});
					
					$("#defaultModal").modal( "show" );
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
	$("#default-form").ajaxForm({
		beforeSerialize: function(form, options) { 
			for (instance in CKEDITOR.instances)
				CKEDITOR.instances[instance].updateElement();
		},
		url : base_url + "vacant/ajax_validation",
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