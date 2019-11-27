$(function () {
    // $('.js-basic-example').DataTable({"bDestroy": true});
	$(".show-tick").selectpicker();
	
	// $("#vac_id").on("change", function(){
	// 	var data = { "key" : $(this).val(), "type" : "history" };
	// 	if ( $(this).val() != "" ){
	// 		$.ajax({
	// 			url : base_url + "applicant/filtering",
	// 			type : "POST",
	// 			dataType: "JSON",
	// 			data : data,
	// 			success : function(data){					
	// 				if ( data.type === 'done' ){
	// 					$(".js-basic-example").DataTable().destroy();
	// 					$(".js-basic-example tbody").html ( data.msg );
	// 					$(".js-basic-example").DataTable({"bDestroy": true});					
	// 				}
	// 				else{
	// 					swal({
	// 							title : "Error!", 
	// 							text : data.msg, 
	// 							type : "error"
	// 						}, 
	// 						function(){
	// 							swal.close();
	// 						}
	// 					);
	// 				}
	// 			}
	// 		});
	// 	}
	// 	else
	// 		$(".js-basic-example").DataTable().destroy();
	// 		$(".js-basic-example tbody").html ( "" );
	// 		$(".js-basic-example").DataTable({"bDestroy": true});
	// });

	var tbl_applicant_hist = $('#tbl-applicant-history');
	tbl_applicant_hist.dataTable({
		"processing": true, 
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
			// "processing": "DataTables is currently busy"
		},
		"serverSide": true, 
		"order": [], 
		"ajax": {
			"url": base_url + "applicant/filtering?t=history&vac=" + $("#vac_id").val(),
			"type": "POST"
		},
		"searchDelay" : 750,
		// "stateSave": true,
		// "columnDefs": [{ 
			// "targets": [ 0 ], 
			// "orderable": false, 
		// }]
	});

	$("#vac_id").on("change", function(){
		var val = $(this).val();
		if (val != '') window.location.href = base_url + 'applicant/history?vac=' + val;
	});
	
	$(".js-basic-example").on("click", ".view-img", function(){		
		$("#model-image").attr("src", $(this).attr("data-src"));
		$("#defaultModal").modal( "show" );
	});
	
	$(".js-basic-example").on("click", ".btn-action", function(){
		var data = {"key" : $(this).attr("attr-data")};
		$.ajax({
			url : base_url + "applicant/results_history",
			type : "POST",
			dataType : "JSON",
			data : data,
			success:  function(data){
				if ( data.type === "done" ){
					$("#actionModal .modal-body").html ( data.msg );
					$("#actionModal").modal( "show" );
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
	
	$("#actionModal").on("click", ".view-detail-test", function(){
		var data = {"key" : $(this).attr("data-key"), "type" : $(this).attr("data-src")};
		$.ajax({
			url : base_url + "applicant/detail-test",
			type : "POST",
			dataType : "JSON",
			data : data,
			success:  function(data){
				if ( data.type === "done" ){
					$("#detail-test-modal #detail-test-modal-header").html ( data.header );
					$("#detail-test-modal .modal-body").html ( data.msg );
					$("#detail-test-modal").modal( "show" );
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
	
	$(".js-basic-example").on("click", ".btn-move-pos", function(){
		$("#id_move").val ( $(this).attr("attr-data") );
		$("#move-pos-modal").modal("show");
	});
	
	$("#move-pos-form").ajaxForm({
		url : base_url + "applicant/move_candidat",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#move-pos-modal .default-footer button").hide();
			$("#move-pos-modal .default-footer p").text("Moving candidat....").removeClass("alert-danger alert-success alert-warning").addClass("alert-warning").show();
		},
		success : function(data){
			if ( data.type === 'done' ){
				$("#move-pos-modal .default-footer p").text ( data.msg ).removeClass("alert-danger alert-success alert-warning").addClass("alert-success");
				setTimeout(function(){window.location.reload();}, 2000);
			}
			else{
				$("#move-pos-modal .default-footer p").text ( data.msg ).removeClass("alert-danger alert-success alert-warning").addClass("alert-danger");
				setTimeout(function(){
					$("#move-pos-modal .default-footer button").show();
					$("#move-pos-modal .default-footer p").hide();
				},2000);
			}
		}
	});

	//create pdf application form based on candidate data
	tbl_applicant_hist.on("click", ".create-cv", function(){
		var data = { "key" : $(this).attr("tag-id") };
		$("#print_preview").modal( "show" );
		url = base_url + "reporting/loading_page"; 
		$("#pview").attr('src',url);
		$("#pview").show('slow');
		$.ajax({
			url : base_url + "applicant/get_create_cv",
			type : "POST",
			dataType : "JSON",
			data : data,
			success : function(data){
				if ( data.type === 'done' ){
					$("#pview").attr('src', data.msg);
					$("#pview").show('slow');
				}
				else{
					$("#print_preview").modal("hide");
					swal("Error!", data.msg, "error");
				}
			}
		});
	});

	tbl_applicant_hist.on("click", ".open-cv", function(){
		var $this = $(this);
		var tag_id		= $(this).attr("tag-id"),
			tag_data	= $(this).attr("tag-data");
			
		var data = {"key" : tag_id, "mycv" : tag_data};
		
		if ( tag_id == "" || tag_data == "" ){
			swal({
				title : "",
				text : "Candidat has not upload CV yet.",
				type : "error"
			});
		}
		else{
			$.ajax({
				url : base_url + "applicant/ajax_visited",
				type : "POST",
				dataType : "JSON",
				data : data,
				success : function(data){
					if ( data.type == 'done' ){
						window.open( data.msg, "_blank" );
						// $this.removeClass('special-cv-blue').addClass('special-cv-red');
					}
					else{
						swal({
							title : "",
							text : data.msg,
							type : "error"
						});
					}
				}
			});
		}
	});
});