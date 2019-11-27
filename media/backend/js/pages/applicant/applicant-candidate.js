$(function () {
	var tbl_applicant = $('#tbl-applicant');


	tbl_applicant.dataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"ajax": {
			"url": base_url + "applicant/view_candidate",
			"type": "POST"
		},
		"searchDelay" : 750,
	});


	tbl_applicant.on("click", ".view-img", function(){		
		$("#model-image").attr("src", $(this).attr("data-src"));
		$("#defaultModal").modal( "show" );
	});

	tbl_applicant.on("click", ".open-cv", function(){
		var $this = $(this);
		var tag_id		= $(this).attr("tag-id"),
			tag_data	= $(this).attr("tag-data");
			
		var data = {"key" : tag_id, "mycv" : tag_data, "type" : "candidate"};
		
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
	
	//create pdf application form based on candidate data
	tbl_applicant.on("click", ".create-cv", function(){
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

});