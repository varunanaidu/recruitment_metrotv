$(function () {
	$(".show-tick").selectpicker();
	
	$("#btn-excel").on("click", function(){
		var year		= $("#year").val();
		var month 		= $("#month").val();

		var data = {
			"year"		: year,
		};
		
		if ( year != "" ){
			if ( month == "") {
				$.ajax({
					url : base_url + "reporting/validate_excel_global",
					type : "POST",
					dataType: "JSON",
					data : data,
					success : function(data){
						if ( data.type === 'done' ){
							window.open(base_url + "reporting/get_excel_global_month/" + year, "_blank");
						}
						else{
							swal("Error!", data.msg, "error");
							setTimeout(function(){swal.close();}, 2000);
						}
					}
				});
			} else {
				var data = {
					"year" : year,
					"month" : month
				};
				$.ajax({
					url : base_url + "reporting/validate_excel_global",
					type : "POST",
					dataType: "JSON",
					data : data,
					success : function(data){
						if ( data.type === 'done' ){
							window.open(base_url + "reporting/get_excel_global_month/" + year + "/" + month, + "_blank");
						}
						else{
							swal("Error!", data.msg, "error");
							setTimeout(function(){swal.close();}, 2000);
						}
					}
				});
			}
		}
	});
	
	$("#btn-pdf").on("click", function(){
		var year		= $("#year").val();
		var month		= $("#month").val();

		var data = {
			"year"		: year,
		};
		if ( year != "" ){
			if ( month == "" ) {
				$("#print_preview").modal( "show" );
				url = base_url + "reporting/loading_page"; 
				$("#pview").attr('src',url);
				$("#pview").show('slow');
				$.ajax({
					url : base_url + "reporting/get_pdf_global",
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
							setTimeout(function(){swal.close();}, 2000);
						}
					}
				});
			}else{
				var data = {
					"year" : year,
					"month" : month
				};

				$('#print_preview').modal("show");
				url = base_url + "reporting/loading_page"; 
				$("#pview").attr('src',url);
				$("#pview").show('slow');

				$.ajax({
					url : base_url + "reporting/get_pdf_global_month",
					type : "POST",
					dataType : "JSON",
					data : data,
					success : function (data) {
						if (data.type == 'done') {
							$("#pview").attr('src', data.msg);
							$("#pview").show('slow');
						} else {
							$("#print_preview").modal("hide");
							swal("Error!", data.msg, "error");
							setTimeout(function(){swal.close();}, 2000);
						}
					}
				});

			}
		}
	});
});