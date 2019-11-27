$(function () {
	$(".show-tick").selectpicker();
	$("#status_married").on("change", function(){		
		if ( $(this).val() == "Married" ){
			$(".for-married").show();
		}
		else{
			$(".for-married").hide();
		}
	});

	$(".dpicker").daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		autoUpdateInput: false,
		locale :{
			format : "YYYY-MM-DD"
		}
	});
	
	$(".dpicker").on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('YYYY-MM-DD'));
	});

	$(".dpicker").on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
	
	$('.edu-picker').daterangepicker({
		autoUpdateInput: false,
		locale : {
			format : "YYYY-MM-DD"
		}
	}).on('apply.daterangepicker', function(ev, picker){
        $(this).val(picker.startDate.format('YYYY-MM-DD') + " - " + picker.endDate.format("YYYY-MM-DD"));
    }).on('cancel.daterangepicker', function(ev, picker){
		$(this).val( '' );
	});
	
	$('.work-picker').daterangepicker({
		autoUpdateInput: false,
		showDropdowns: true,
		locale : {
			format : "YYYY-MM-DD"
		}
	}).on('apply.daterangepicker', function(ev, picker){
        $(this).val(picker.startDate.format('YYYY-MM-DD') + " - " + picker.endDate.format("YYYY-MM-DD"));
    }).on('cancel.daterangepicker', function(ev, picker){
		$(this).val( '' );
	});
	
	Dropzone.autoDiscover = false;
	var myDropZone = new Dropzone("#dz_file", {
		paramName: 'dzfile',
		url : base_url + "applicant/dropzone_file",
		autoProcessQueue: false,
		clickable : true,
		addRemoveLinks: true,
		acceptedFiles: ".docx,.doc,.pdf",
		uploadMultiple: false,
		maxFiles: 1,
	});
	
	Dropzone.autoDiscover = false;
	var myDropZone2 = new Dropzone("#dz_photo", {
		paramName: 'dzfoto',
		url : base_url + "applicant/dropzone_foto",
		autoProcessQueue: false,
		clickable : true,
		addRemoveLinks: true,
		acceptedFiles: ".jpeg,.jpg,.png",
		uploadMultiple: false,
		maxFiles: 1,
	});
	
	$("#cpi-form").ajaxForm({
		url : base_url + "applicant/process-cpi",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#btn-cpi").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type === 'done' ){
				swal({
						title : "Success!", 
						text : data.msg, 
						type : "success"
					}, 
					function(){
						swal.close();
						$("#btn-cpi").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
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
						$("#btn-cpi").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
					}
				);				
			}
		}
	});
	
	$("#cfi-form").ajaxForm({
		url : base_url + "applicant/process-cfi",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#btn-cfi").html ( "Processing..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type === 'done' ){
				swal({
						title : "Success!", 
						text : data.msg, 
						type : "success"
					}, 
					function(){
						swal.close();
						$("#btn-cfi").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
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
						$("#btn-cfi").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
					}
				);
			}
		}
	});
	
	$("#cei-form").ajaxForm({
		url : base_url + "applicant/process-cei",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#btn-cei").html ( "Processing..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type === 'done' ){
				swal({
						title : "Success!", 
						text : data.msg, 
						type : "success"
					}, 
					function(){
						swal.close();
						$("#btn-cei").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
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
						$("#btn-cei").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
					}
				);
			}
		}
	});
	
	$("#ceb-form").ajaxForm({
		url : base_url + "applicant/process-ceb",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#btn-ceb").html ( "Processing..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type === 'done' ){
				swal({
						title : "Success!", 
						text : data.msg, 
						type : "success"
					}, 
					function(){
						swal.close();
						$("#btn-ceb").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
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
						$("#btn-ceb").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
					}
				);
			}
		}
	});
	
	$("#ai-form").ajaxForm({
		url : base_url + "applicant/process-ai",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#btn-ai").html ( "Processing..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type === 'done' ){
				swal({
					title : "Success!", 
					text : data.msg, 
					type : "success"},
					function(){
						if ( myDropZone.files.length > 0 || myDropZone2.files.length > 0 ){
							var drop1 = false;
							var drop2 = false;
							if ( myDropZone.files.length > 0 ) drop1 = true;
							if ( myDropZone2.files.length > 0 ) drop2 = true;					
							
							if ( myDropZone.files.length > 0 ){
								myDropZone.options.params = {"myid" : data.cnd_id};
								myDropZone.processQueue();
								myDropZone.on("complete", function(file){
									if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
										if ( ! drop2 ){
											swal.close();
											$("#btn-ai").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
										}
									}
									myDropZone.removeFile(file);
								});
							}

							if ( myDropZone2.files.length > 0 ){
								myDropZone2.options.params = {"myid" : data.cnd_id};
								myDropZone2.processQueue();
								myDropZone2.on("complete", function(file){
									if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
										swal.close();
										$("#btn-ai").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
									}
									myDropZone2.removeFile(file);
								});
							}
						}
						else
							$("#btn-ai").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);						
				});				
			}
			else{
				swal({
						title : "Error!", 
						text : data.msg, 
						type : "error"
					}, 
					function(){
						swal.close();
						$("#btn-ai").html ( "Save & Update" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
					}
				);
			}
		}
	});
});