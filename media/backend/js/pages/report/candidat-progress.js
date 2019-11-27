$(function () {
	$(".show-tick").selectpicker();
	$(".dpicker").daterangepicker({		
		locale: {
		  format: 'YYYY-MM-DD',
		  cancelLabel: 'Clear'
		},
		autoUpdateInput: false,
	});
	
	$(".dpicker").on('apply.daterangepicker', function(ev, picker) {		
		$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
	});

	$(".dpicker").on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
	
	$("#btn-excel").on("click", function(){
		var vacant		= $("#vacant").val(),
			range_date	= $("#range_date").val();
			
		var data = {
			"vacant"		: vacant,
			"range_date"	: range_date
		};
		
		if ( vacant != "" && range_date != "" ){
			$.ajax({
				url : base_url + "reporting/validate_excel_cp",
				type : "POST",
				dataType: "JSON",
				data : data,
				success : function(data){
					if ( data.type === 'done' ){
						window.open(base_url + "reporting/get_excel_cp/" + vacant + "/" + range_date, "_blank");
					}
					else{
						swal("Error!", data.msg, "error");
						setTimeout(function(){swal.close();}, 2000);
					}
				}
			});
		}
	});
	
	$("#btn-pdf").on("click", function(){
		var vacant		= $("#vacant").val(),
			range_date	= $("#range_date").val();
			
		var data = {
			"vacant"		: vacant,
			"range_date"	: range_date
		};
		if ( vacant != "" && range_date != "" ){
			$("#print_preview").modal( "show" );
			url = base_url + "reporting/loading_page"; 
			$("#pview").attr('src',url);
			$("#pview").show('slow');
			$.ajax({
				url : base_url + "reporting/get_pdf_cp",
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
		}
	});
	
});