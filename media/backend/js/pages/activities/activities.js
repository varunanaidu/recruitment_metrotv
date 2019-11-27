$(function(){
	$(".js-basic-example").dataTable();
//CKEditor
CKEDITOR.replace('activity_content');
CKEDITOR.config.height = 100;

$("#btn-add").on("click", function(){
	$("#type").val ( "add" );
	$("#content-img").hide();
	$("#activity_file").prop("required", true);
	$("#defaultModal").modal ( "show" );
});

$(".js-basic-example").on("click", ".btn-edit", function(){
	var data = {"key" : $(this).attr("attr-data")};
	$.ajax({
		url : base_url + "activities/ajax_finder",
		type : "POST",
		dataType : "JSON",
		data : data,
		success : function(data){
			if ( data.type == 'done' ){
				var date = data.msg[0].c.substring(0,10);
				var file = data.msg[0].e;
				var splited = file.split('.');
				$("#id").val ( data.msg[0].a );
				$("#type").val ( "edit" );
				$("#a_title").val ( data.msg[0].b );
				$("#activity_date").val ( date );
				CKEDITOR.instances['activity_content'].setData( data.msg[0].d );
				if (splited[splited.length - 1] == 'mp4') {
					$('#img-data').replaceWith('<video id="img-data" src="'+basic_url+'assets/activity/'+data.msg[0].e+'" controls class="img-responsive"></video>');
				}else{
					$("#img-data").replaceWith('<img id="img-data" src="'+basic_url+'assets/activity/'+data.msg[0].e+'" class="img-responsive" />');
				}
				$("#content-img").show();
				$("#activity_file").prop("required", false);
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
	beforeSerialize: function(form, options) { 
		for (instance in CKEDITOR.instances)
			CKEDITOR.instances[instance].updateElement();
	},
	url : base_url + "activities/ajax_validation",
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
				url : base_url + "activities/ajax_remove",
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