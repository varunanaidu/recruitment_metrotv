"use strict";

var CaptchaCallback = function(){
	$('.g-recaptcha').each(function(index, el) {
		grecaptcha.render(el, {'sitekey' : '6LeFxRkUAAAAADYdyyz-OjsRBw7nAxAgKMXMKqJs'});
	});
};
		
$.MetroAP.Login = {
    init: function () {
		
		$('#frm_sign_in').validate({
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: _base_url + "site/login",
					data: $(form).serialize(),
					dataType: "json",
					beforesend: $('#fc_btn_signin').text('PROCESSING..').prop('disabled', true),
					success: function (data) {
						setTimeout(function() { $('#fc_btn_signin').text('LOGIN').prop('disabled', false); }, 2000);
						if (data.type != 'done') {
							$('#signin_alert').html(data.msg).slideDown().fadeTo(2000, 500).fadeOut("slow");
						}
						else {
							if (data.referred_to != '') window.location.href = data.referred_to;
							else window.location.reload();
						}
						grecaptcha.reset();
					}
				});
				return false;  // block the default submit action
			}
		});
		
		$('#frm_sign_in_popup').validate({
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: _base_url + "site/login",
					data: $(form).serialize(),
					dataType: "json",
					beforesend: $('#fc_pop_signin').text('PROCESSING..').prop('disabled', true),
					success: function (data) {
						setTimeout(function() { $('#fc_pop_signin').text('LOGIN').prop('disabled', false); }, 2000);
						if (data.type != 'done') {
							$('#pop_signin_alert').html(data.msg).slideDown().fadeTo(2000, 500).fadeOut("slow");
						}
						else {
							if (data.referred_to != '') window.location.href = data.referred_to;
							else window.location.reload();
						}
						grecaptcha.reset();
					}
				});
				return false;  // block the default submit action
			}
		});

		$('#frm_sign_up').validate({
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: _base_url + "site/register",
					data: $(form).serialize(),
					dataType: "json",
					beforesend: $('#fc_btn_signup').text('PROCESSING..').prop('disabled', true),
					success: function (data) {
						setTimeout(function() { $('#fc_btn_signup').text('REGISTER').prop('disabled', false); }, 2000);
						if (data.type != 'done') {
							$('#signup_alert').html(data.msg).slideDown().fadeTo(2000, 500).fadeOut("slow");
						}
						else {
							swal({ title:"Thank You!", text:data.msg, html:true }, function() { 
								window.location.href = _base_url; 
							});
						}
					}
				});
				return false;  // block the default submit action
			}
		});

		$('#frm_resend_verification').validate({
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: _base_url + "site/resend_verification_email",
					data: $(form).serialize(),
					dataType: "json",
					beforesend: $('#fc_btn_resend').text('PROCESSING..').prop('disabled', true),
					success: function (data) {
						setTimeout(function() { $('#fc_btn_resend').text('SEND').prop('disabled', false); }, 2000);
						if (data.type != 'done') {
							$('#resend_alert').html(data.msg).slideDown().fadeTo(2000, 1000).fadeOut("slow");
						}
						else {
							swal({ title:"Thank You!", text:data.msg, html:true }, function() { 
								window.location.href = _base_url; 
							});
						}
					}
				});
				return false;  // block the default submit action
			}
		});
		
		$('#frm_forgot_pass').validate({
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: _base_url + "site/resend_forgot_pass",
					data: $(form).serialize(),
					dataType: "json",
					beforesend: $('#fc_btn_forgot').text('PROCESSING..').prop('disabled', true),
					success: function (data) {
						setTimeout(function() { $('#fc_btn_forgot').text('SEND').prop('disabled', false); }, 2000);
						if (data.type != 'done') {
							$('#forgot_alert').html(data.msg).slideDown().fadeTo(2000, 1000).fadeOut("slow");
						}
						else {
							swal({ title:"Thank You!", text:data.msg, html:true }, function() { 
								window.location.href = _base_url; 
							});
						}
					}
				});
				return false;  // block the default submit action
			}
		});
		
		$('#frm1_change_pass').validate({
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: _base_url + "site/update_password",
					data: $(form).serialize(),
					dataType: "json",
					beforesend: $(form).find('button[type=submit]').text('PROCESSING..').prop('disabled', true),
					success: function (data) {
						setTimeout(function() { $(form).find('button[type=submit]').text('LOGIN').prop('disabled', false); }, 2000);
						if (data.type != 'success') {
							$(form).find('.alert').html(data.msg).slideDown().fadeTo(2000, 500).fadeOut("slow");
						}
						else {
							var sa_title = (data.type == 'success') ? "Success!" : "Error!";
							swal({ title:sa_title, text:data.msg, type:data.type, html:true }, function() {
								window.location.href = _base_url;
							});
						}
					}
				});
				return false;  // block the default submit action
			}
		});

    $('#fpass_change_pass').ajaxForm({
        url : _base_url + "site/update_forgot_password",
        dataType : "JSON",
        beforeSubmit : function(){
            $("#fpass_updateBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
        },
        success : function(data){
            if ( data.type == 'success' ){
                swal({
                        title : "Success!", 
                        text : data.msg, 
                        type : "success"
                    }, 
                    function(){
                        window.location.href = _base_url;
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
                        $("#fpass_updateBtn").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
                    }
                );
            }
        }
    });

    $('#change_pass').ajaxForm({
        url : _base_url + "site/update_password",
        dataType : "JSON",
        beforeSubmit : function(){
            $("#change_passBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
        },
        success : function(data){
            if ( data.type == 'success' ){
                swal({
                        title : "Success!", 
                        text : data.msg, 
                        type : "success"
                    }, 
                    function(){
                        window.location.href = _base_url;
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
                        $("#change_passBtn").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
                    }
                );
            }
        }
    });
		
		/*$('#frm2_change_pass').validate({
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: _base_url + "site/update_forgot_password",
					data: $(form).serialize(),
					dataType: "json",
					beforesend: $(form).find('button[type=submit]').text('PROCESSING..').prop('disabled', true),
					success: function (data) {
						setTimeout(function() { $(form).find('button[type=submit]').text('LOGIN').prop('disabled', false); }, 2000);
						if (data.type != 'success') {
							$(form).find('.alert').html(data.msg).slideDown().fadeTo(2000, 500).fadeOut("slow");
						}
						else {
							var sa_title = (data.type == 'success') ? "Success!" : "Error!";
							swal({ title:sa_title, text:data.msg, type:data.type, html:true }, function() {
								window.location.href = _base_url;
							});
						}
					}
				});
				return false;  // block the default submit action
			}
		});*/
    }
}

$(function () {
	
	$.MetroAP.Login.init();
	
	$(".socialshare").jsSocials({
		showLabel: false,
		showCount: false,
		shareIn: "popup",
		shares: ["twitter", "googleplus", "linkedin", "pinterest"]
	});
});

/*-------- FOLLOW BUTTON --------*/
/* Twitter */
window.twttr = (function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0],
t = window.twttr || {};
if (d.getElementById(id)) return t;
js = d.createElement(s);
js.id = id;
js.src = "https://platform.twitter.com/widgets.js";
fjs.parentNode.insertBefore(js, fjs);
t._e = [];
t.ready = function(f) {
t._e.push(f);
};
return t;
}(document, "script", "twitter-wjs"));

/* Facebook */
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));