$(function () {
	"use strict";
	
	$('.date-picker').datepicker({
		format: "dd-mm-yyyy",
		orientation: "bottom left",
		startView: 2,
		maxViewMode: 2,
		clearBtn: true,
		autoclose: true
	});
	
	$('.month-picker').datepicker({
		format: "mm/yyyy",
		orientation: "bottom left",
		startView: 2,
		minViewMode: 1,
		maxViewMode: 2,
		clearBtn: true,
		autoclose: true
	});
	
	$('.year-picker').datepicker({
		format: "yyyy",
		orientation: "bottom left",
		startView: 2,
		minViewMode: 2,
		maxViewMode: 2,
		clearBtn: true,
		autoclose: true
	});
	
	/* change panel color */
	var panel_success = "panel-col-indigo";
	
	/* validate */
	$('.frm_applicant').each(function() {
        $(this).validate();
    });
	
	$('#fc_applicant button').on('click', function(e) {
		// e.preventDefault();
		var type = $(this).data('type');
		var form = $(this).closest('form');
		if (type == 'f1') {
			submit_dropzone(form);
		}
		else if (type == 'f1_remove') {
			remove_file($(this));
		}
		else if (type == 'fx') {
			submit_form(form);
		}
		else if (type == 'f5') {
			var action = $(this).data('action');
			if (action == 'delete')
				remove_exp($(this));
		}
		else if (type == 'apply') {
			submit_apply($(this).data('vid'));
		}
		else if (type == 'back') {
			window.location.href = $(this).data('href');
		}
	});
	
	/*Dropzone.autoDiscover = false;
	var cvDropzone = new Dropzone( "#dz_cv", {
		paramName: 'dzfile',
		url : _base_url + "applicant/dz_upload?type=cv",
		clickable : true,
		addRemoveLinks: true,
		maxFilesize: 0.2,
		acceptedFiles: ".doc, .docx, .pdf",
		maxFiles: 1,
		uploadMultiple: false,
		maxfilesexceeded: function(file) {
			this.removeAllFiles();
			this.addFile(file);
		},
		removedfile: function(file){
			var _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		},
		autoProcessQueue:false
	});
	
	var phDropzone = new Dropzone( "#dz_photo", {
		paramName: 'dzfile',
		url : _base_url + "applicant/dz_upload?type=photo",
		clickable : true,
		addRemoveLinks: true,
		acceptedFiles: ".jpeg,.jpg,.png",
		maxFilesize: 0.2,
		maxFiles: 1,
		uploadMultiple: false,
		maxfilesexceeded: function(file) {
			this.removeAllFiles();
			this.addFile(file);
		},
		removedfile: function(file){
			var _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		},
		autoProcessQueue:false
	});
        
	function submit_dropzone(form) {
		if (!form.valid()) {
			swal("Warning!", "Please fill in all required fields", "warning");
			return;
		}
		cvDropzone.processQueue();  
		phDropzone.processQueue();
		cvDropzone.on("success", function(file, response) {
			var data = $.parseJSON(response);
			var sa_title = (data.type == 'done') ? "Saved!" : "Failed!";
			var sa_type = (data.type == 'done') ? "success" : "warning";
			swal({ title:sa_title, text:data.msg, type:sa_type, html:true }, function(){
				form.find('button').attr('disabled', true).text('Processing..').removeClass('bg-indigo').addClass('bg-orange');
				window.location.reload();
			});
		});
		phDropzone.on("success", function(file, response) {
			var data = $.parseJSON(response);
			var sa_title = (data.type == 'done') ? "Saved!" : "Failed!";
			var sa_type = (data.type == 'done') ? "success" : "warning";
			swal({ title:sa_title, text:data.msg, type:sa_type, html:true }, function(){
				form.find('button').attr('disabled', true).text('Processing..').removeClass('bg-indigo').addClass('bg-orange');
				window.location.reload();
			});
		});
	}
	
	function submit_form(form) {
		if (!form.valid()) {
			swal("Warning!", "Please fill in all required fields", "warning");
			return;
		}
		var fid = form.attr('id');
		$.ajax({
			type: "POST",
			url: _base_url + "applicant/update_" + fid,
			data: form.serialize(),
			dataType: "json",
			beforesend: form.find('button').attr('disabled', true).text('Processing..').removeClass('bg-indigo').addClass('bg-orange'),
			success: function (data) {
				if(data.type != 'done') {
					swal({ title:"Oops!", text:data.msg, type:"warning", html:true });
				}
				else {
					swal({ title:"Saved!", text:"Your data has been saved succesfully!", type:"success" }, function(){
						// form.closest('.panel').removeClassPrefix('panel-col').addClass(panel_success);
						// form.closest('.panel-collapse').removeClass('in');
						window.location.reload();
					});
				}
				form.find('button').removeAttr('disabled').text('Save Changes').removeClass('bg-orange').addClass('bg-indigo');
			}
		});
	}
	
	function submit_apply(vid) {
		$.ajax({
			type: "POST",
			url: _base_url + "vacancy/apply_confirm/" + vid,
			dataType: "json",
			success: function (data) {
				if(data.type != 'done') {
					swal({ title:"Oops!", text:data.msg, type:"warning", html:true });
				}
				else {
					swal({ title:"Application submitted!", text:data.msg, type:"success", html:true }, function(){
						window.location.href = _base_url;
					});
				}
			}
		});
	}
	
	function remove_exp(el) {
		var id = el.data('emp-id');
		var title = el.data('title');
		swal({
			title: "Employment History - " + title,
			text: "Are you sure want to delete this data?",
			type: "warning",
			html: true,
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function() {
			setTimeout(function() {
				$.ajax({
					type: "POST",
					url: _base_url + "applicant/delete_experience",
					data: { 'id' : id },
					dataType: "json",
					success: function (data) {
						var sa_title = (data.type == 'done') ? "Success!" : "Failed!";
						var sa_type = (data.type == 'done') ? "success" : "warning";
						swal({ title:sa_title, text:data.msg, type:sa_type, html:true }, function() { 
							window.location.reload(); 
						});
					}
				});
			}, 2000);
		});
	}
	
	function remove_file(el) {
		var filetype = el.data('file');
		swal({
			title: "Remove File",
			text: "Are you sure want to remove your " + filetype + " ?",
			type: "warning",
			html: true,
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function() {
			setTimeout(function() {
				$.ajax({
					type: "POST",
					url: _base_url + "applicant/remove_file",
					data: { 'type' : filetype },
					dataType: "json",
					success: function (data) {
						var sa_title = (data.type == 'done') ? "Success!" : "Failed!";
						var sa_type = (data.type == 'done') ? "success" : "warning";
						swal({ title:sa_title, text:data.msg, type:sa_type, html:true }, function() { 
							window.location.reload(); 
						});
					}
				});
			}, 2000);
		});
	}
	*/
	/* FORM 2 */
	$(document).on('click', '#f2_checkaddress', function() {
		if (this.checked) {
			$('#f2_padd').val( $('#f2_cadd').val() ).parent().removeClass('error').addClass('focused');
			$('#f2_pcity').val( $('#f2_ccity').val() ).parent().removeClass('error').addClass('focused');
			$('#f2_ppost').val( $('#f2_cpost').val() ).parent().removeClass('error').addClass('focused');
			$('#f2_pphone').val( $('#f2_cphone').val() ).parent().removeClass('error').addClass('focused');
		}
		else {
			$('#f2_padd, #f2_pcity, #f2_ppost, #f2_pphone').val('').parent().removeClass('focused');
		}
	});
	
	$(document).on('change', 'input:radio[name="f2[marital_status]"]', function(){
		if ($(this).val() == 'Single') $('.for-f2-married').slideUp();
		else $('.for-f2-married').slideDown();
	});
	
	/* FORM 3 - university */
	$('select.f3_university').on('change', function() {
		var val = $(this).val();
		var otherinput = $(this).closest('td').find('.for-f3-univ');
		if (val == 'Other') {
			otherinput.show();
			otherinput.find('input[type=text]').prop('required', true);
		}
		else {
			otherinput.hide();
			otherinput.find('input[type=text]').prop('required', false);
		}
	});
	
	/* FORM 8 */
	$('.currency').inputmask({ alias:"decimal", rightAlign:false, groupSeparator:'.', autoGroup:true });
});