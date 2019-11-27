$(document).ready(function () {
// ##############################################################################################################
console.log(window.location.href);
console.log(base_url);
var scrollLink = $('.scroll');


if (window.location.href == base_url) {
    scrollLink.click(function(e) {
        e.preventDefault();
        var hash = this.hash;
        $('html').animate({
            scrollTop: $(this.hash).offset().top
        }, 800, function () {
            window.location.hash = hash;
        } );
    });

    $(this).scroll(function() {
        var scrollbarLocation = $(this).scrollTop();

        scrollLink.each(function() {

            var sectionOffset = $(this.hash).offset().top - 20;

            if ( sectionOffset <= scrollbarLocation ) {
                $(this).parent().addClass('act');
                $(this).parent().siblings().removeClass('act');
            }
        })
    });

}

// ##############################################################################################################


if( type != '' && msg != ''){
    if( type == 'done'){
        swal({
            title : "Success!", 
            text : msg, 
            type : "success"
        });
    }else{
        swal({
            title : "Error!", 
            text : msg, 
            type : "error"
        });
    }
}


// ##############################################################################################################


var owl = $('.owl-carousel');
owl.owlCarousel({
    center: true,
    loop: true,
    margin: 6,
    responsiveClass:true,
    autoplay: true,
        // autoplayTimeout: 1000,
        autoplayHoverPause: true,
        responsive: {
            1200: {
                items: 1.6
            },
            560: {
                items: 1.2
            },
            0: {
                items: 1
            }
        }
    });


// ##############################################################################################################


    /*$('.loop').owlCarousel({
        center: true,
        loop: true,
        autoPlay: true,
        margin: 6,
        responsiveClass:true,
        responsive: {
            1366: {
                items: 1.6
            },
            1000: {
                items: 1.2
            },
            0: {
                items: 1
            }
        }
    });*/


// ##############################################################################################################


    /*var owl = $('.post_testi');
    $('.post_testi').owlCarousel({
        loop: true,
        margin: 10,
        autoPlay: true,
        responsiveClass:true,
        responsive: {
            980: {
                items: 2
            },
            0: {
                items: 1
            }
        }
    });*/


// ##############################################################################################################


$("#scrollbox").mCustomScrollbar({
    theme:"minimal"
});

// ##############################################################################################################


$(".register a").click(function(){
    $('.reg_pop').fadeIn('fast');
    $('html').addClass('no-scroll');
});


// ##############################################################################################################


$(".close-popup").click(function(){
    $('.reg_pop').fadeOut('fast');
    $('html').removeClass('no-scroll');
});


// ##############################################################################################################


$(".login a").click(function(){
    $('.login_pop').fadeIn('fast');
    $('html').addClass('no-scroll');
});


// ##############################################################################################################


$(".close-popup").click(function(){
    $('.login_pop').fadeOut('fast');
    $('html').removeClass('no-scroll');
});


// ##############################################################################################################


$(".resend_email").click(function() {
    $('.reg_pop').fadeOut('fast');
    $('.rver_pop').fadeIn('fast');
    $('html').addClass('no-scroll');
});


// ##############################################################################################################


$(".close-popup").click(function(){
    $('.rver_pop').fadeOut('fast');
    $('html').removeClass('no-scroll');
});


// ##############################################################################################################


$(".forgot_pass").click(function() {
    $('.login_pop').fadeOut('fast');
    $('.fpass_pop').fadeIn('fast');
    $('html').addClass('no-scroll');
});


// ##############################################################################################################


$(".close-popup").click(function(){
    $('.fpass_pop').fadeOut('fast');
    $('html').removeClass('no-scroll');
});


// ##############################################################################################################


//MAIN MENU
$("#bar").click(function () {
    $("#sld").animate({ width: 'toggle'});
});
$("#back").click(function () {
    $("#sld").animate({ width: 'toggle'});
});
function setHeight() {
    windowHeight = $(window).innerHeight();
    $('#sld').css('height', windowHeight);
};
setHeight();

$(window).resize(function() {
    setHeight();
});


// ##############################################################################################################




// validate the comment form when it is submitted
$("#regis_form").validate({
    rules: {
        Email:"required",
        NewPassword:{minlength:8},
        RePassword:{minlength:8,equalTo:"#NewPassword"},
        terms:"required"
    },
    messages: {
        Email:"Masukkan email Anda",
        NewPassword:"Masukkan password Anda (min 8 karakter)",
        RePassword:"Confirm Password tidak sama dengan Password",
        terms:"Anda harus menyetujui ToS",
    }
});


// ##############################################################################################################


$("#login_form").validate({
    rules: {
        Email: {required:true},
        password:{required:true}
    },
    messages: {
        Email:"Masukkan email Anda",
        password:"Masukkan password Anda"
    }
});


// ##############################################################################################################


$('#regis_form').on('submit', function(e){
    e.preventDefault();
    var valid = $(this).valid();
    if (valid == false) return false;
    $.ajax({
        url : base_url + "site/register",
        dataType : "JSON",
        type : "POST",
        data : $(this).serialize(),
        beforeSend : function(){
            $("#registerBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
        },
        success : function(data){
            if ( data.type == 'done' ){
                swal({
                    title : "Success!", 
                    html : data.msg, 
                    type : "success"
                }).then(function(){
                    window.location.reload();
                });
            }
            else{
                swal({
                    title : "Error!", 
                    html : data.msg, 
                    type : "error"
                }).then(function(){
                 $("#registerBtn").html ( "Sign Up" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
             });
            }
        }
    });
});


// ##############################################################################################################


$('#login_form').on('submit', function(e){
    e.preventDefault();
    var valid = $(this).valid();
    if (valid == false) return false;
    $.ajax({
        url : base_url + "site/login",
        dataType : "JSON",
        type : "POST",
        data : $(this).serialize(),
        beforeSend : function(){
            $("#loginBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
        },
        success : function(data){
            if ( data.type == 'done' ){
                swal({
                    title : "Success!", 
                    html : data.msg, 
                    type : "success",
                }).then(function(){
                    window.location.reload(); 
                });
            }
            else{
                swal({
                    title : "Error!", 
                    html : data.msg, 
                    type : "error"
                }).then(function(){
                    $("#loginBtn").html ( "Login" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
                });
            }   
        }
    });
});


// ##############################################################################################################


$('#rver_form').on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url : base_url + "site/resend_verification_email",
        dataType : "JSON",
        type : "POST",
        data : $(this).serialize(),
        beforeSend : function(){
            $("#rverBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
        },
        success : function(data){
            if ( data.type == 'done' ){
                swal({
                    title : "Success!", 
                    html : data.msg, 
                    type : "success"
                }).then(function(){
                    window.location.reload();
                });
            }
            else{
                swal({
                    title : "Error!", 
                    html : data.msg, 
                    type : "error"
                }).then(function(){
                    $("#rverBtn").html ( "Send" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
                });
            }
        }
    });
});


// ##############################################################################################################


$('#fpass_form').on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url : base_url + "site/resend_forgot_pass",
        dataType : "JSON",
        type : "POST",
        data : $(this).serialize(),
        beforeSend : function(){
            $("#fpassBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
        },
        success : function(data){
            if ( data.type == 'done' ){
                swal({
                    title : "Success!", 
                    html : data.msg, 
                    type : "success"
                }).then(function(){
                    window.location.reload();
                });
            }
            else{
                swal({
                    title : "Error!", 
                    html : data.msg, 
                    type : "error"
                }).then(function(){
                    $("#fpassBtn").html ( "Send" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
                });
            }
        }
    });
});


// ##############################################################################################################


$('#change_pass').on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url : base_url + "site/update_password",
        dataType : "JSON",
        type : "POST",
        data : $(this).serialize(),
        beforeSend : function(){
            $("#change_passBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
        },
        success : function(data){
            if ( data.type == 'success' ){
                swal({
                    title : "Success!", 
                    html : data.msg, 
                    type : "success"
                }).then(function(){
                    window.location.reload();
                });
            }
            else{
                swal({
                    title : "Error!", 
                    html : data.msg, 
                    type : "error"
                }).then(function(){
                    $("#change_passBtn").html ( "Send" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
                });
            }
        }
    });
});


// ##############################################################################################################


$('#forgotPassword').on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url : base_url + "site/update_forgot_password",
        dataType : "JSON",
        type : "POST",
        data : $(this).serialize(),
        beforeSend : function(){
            $("#change_fpassBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
        },
        success : function(data){
            if ( data.type == 'success' ){
                swal({
                    title : "Success!", 
                    html : data.msg, 
                    type : "success"
                }).then(function(){
                    window.location.href = base_url;
                });
            }
            else{
                swal({
                    title : "Error!", 
                    html : data.msg, 
                    type : "error"
                }).then(function(){
                    $("#change_fpassBtn").html ( "Send" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
                });
            }
        }
    });
});


// ##############################################################################################################


$('#btnApply').on('click', function (e) {
    e.preventDefault();
    $('.login_pop').fadeIn('fast');
    $('html').addClass('no-scroll');
});

var data = {'key' : $('#unit').val()};
$.ajax({
    url : base_url + 'Site/getVacantGroup',
    type : 'POST',
    dataType : 'JSON',
    data : data,
    success : function (data) {
        if (data != 0) {
            for (var i = 0; i < data.length; i++) {
                $('#position').append('<option value="'+data[i].vacant_group_id+'">'+data[i].name+'</option>');
            }
        }
    }
});


// ##############################################################################################################

$('#unit').on('change', function () {
    $('#btnVMore').show();
    $('#loadV').hide();
    var data = {'key' : $(this).val()};

    $.ajax({
        url : base_url + 'Site/getVacantGroup',
        type : 'POST',
        dataType : 'JSON',
        data : data,
        success : function (data) {
            if (data != 0) {
                $('#position').html('<option value=""> -- ALL --</option> ');
                for (var i = 0; i < data.length; i++) {
                    $('#position').append('<option value="'+data[i].vacant_group_id+'">'+data[i].name+'</option>');
                }
            }
        }
    });

    $.ajax({
        url : base_url + 'Site/change_view_unit',
        type : 'POST',
        data : data,
        cache: false,
        success : function(html) {
            $('#loadFVacancy').html(html);
        }
    });
});


// ##############################################################################################################


$('#position').on('change', function() {
    $('#btnVMore').show();
    $('#loadV').hide();
    var data = {'key' : $(this).val(), 'unit' : $('#unit').val()};

    $.ajax({
        url : base_url + 'Site/change_view',
        type : 'POST',
        data : data,
        cache: false,
        success : function(html) {
            $('#loadFVacancy').html(html);
        }
    });
});

// ##############################################################################################################


$('#searchBtn').on('click', function (e) {
    e.preventDefault();

    var data = {
        'key' : $('input[name=search]').val(),
        'vacant_unit_id' : $('#unit').val(),
        'vacant_group_id' : $('#position').val(),
    };

    $.ajax({
        url : base_url + 'Site/searchJob',
        type : 'POST',
        data : data,
        cache: false,
        success : function(html) {
            $('#loadFVacancy').html(html);
        }
    });

});


// ##############################################################################################################

var pageV = 0;
var pageE = 0;
var pageA = 0;
var pageF = 0;

$('#btnVMore').on('click', function () {
    pageV++;
    loadMoreDataV(pageV);
});

function loadMoreDataV(pageV) {
    var data = { 
        'key' : 'vacancies',
        'vacant_unit_id' : $('#unit').val(),
        'vacant_group_id' : $('#position').val()
    }
    $.ajax(
    {
        url : base_url + 'Site/getPage/' + pageV,
        type: "POST",
        dataType : "JSON",
        data : data,
        beforeSend: function()
        {
            $('#loadV').show();
        }
    })
    .done(function(data)
    {
        if(data.data_vacancies == 0){
            $('#btnVMore').hide();
            $('#loadV').html("");
            return;
        }else{
            $('#loadV').hide();
            for (var i = 0; i < data.data_vacancies.length; i++) {
                $("#loadFVacancy .list_job").append('<li class="list_r"><h3>'+data.data_vacancies[i].c+'</h3><a href="#" class="cat_job">'+data.data_vacancies[i].d+'</a><div class="app"><a href="' + base_url + 'site/detailVacant/?v='+data.data_vacancies[i].a+'" class="apply">Apply</a><ul class="share"><li><a href="https://www.facebook.com/sharer/sharer.php?u=//career.metrotvnews.com"><i class="fa fa-facebook"></i></a></li><li><a href="https://twitter.com/share?url=//career.metrotvnews.com&text=Career%20Metro%20TVvia=<USERNAME>"><i class="fa fa-twitter"></i></a></li><li><a href="https://plus.google.com/share?url=https://career.metrotvnews.com"><i class="fa fa-google-plus"></i></a></li><li><a href="https://www.linkedin.com/shareArticle?url=//career.metrotvnews.com&title=Career%20Metrotv&summary=<SUMMARY>&source=//career.metrotvnews.com"><i class="fa fa-linkedin"></i></a></li><li><a href="whatsapp://send?text=Career%20MetroTV!"><i class="fa fa-whatsapp"></i></a></li></ul></div></li>');
            }
        }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('server not responding...');
    });
}

$('#btnEMore').on('click', function () {
    pageE++;
    loadMoreDataE(pageE);
});

function loadMoreDataE(pageE) {
    $.ajax(
    {
        url : base_url + 'Site/getPage/' + pageE,
        type: "POST",
        dataType : "JSON",
        data : {'key' : 'editorial'},
        beforeSend: function()
        {
            $('#loadE').show();
        }
    })
    .done(function(data)
    {
        if(data.data_editorial == 0){
            $('#btnEMore').hide();
            $('#loadE').html("");
            return;
        }else{
            $('#loadE').hide();
            for (var i = 0; i < data.data_editorial.length; i++) {
                var date = moment(data.data_editorial[i].date).format('MMM, DD YYYY');
                if (data.data_editorial[i].content.length >= 80) {
                    var content = data.data_editorial[i].content.substring(0, 80) + "...";
                }else{
                    var content = data.data_editorial[i].content;
                }
                $('#loadEditorial').append('<div class="box_full_l slot1"><div class="pic"><img src="' + base_url + 'assets/editorial/' + data.data_editorial[i].url_image + '" alt=""></div><div class="text"><div class="date">' + date + '</div><h3>'+ data.data_editorial[i].title +'</h3><p>'+ content +'</p><a href="'+ base_url +'site/detailTips/'+ data.data_editorial[i].tipsntrick_id +'" title="">Read More</a></div></div>');
            }
        }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('server not responding...');
    });
}

$('#btnAMore').on('click', function () {
    pageA++;
    loadMoreDataA(pageA);
});

function loadMoreDataA(pageA) {
    $.ajax(
    {
        url : base_url + 'Site/getPage/' + pageA,
        type: "POST",
        dataType : "JSON",
        data : {'key' : 'activity'},
        beforeSend: function()
        {
            $('#loadA').show();
        }
    })
    .done(function(data)
    {
        if(data.data_activities == 0){
            $('#btnAMore').hide();
            $('#loadA').html("");
            return;
        }else{
            $('#loadA').hide();
            for (var i = 0; i < data.data_activities.length; i++) {
                var file = data.data_activities[i].url_image;
                var splited = file.split('.');
                var date = moment(data.data_activities[i].date).format('MMM, DD YYYY');
                if (data.data_activities[i].content.length >= 80) {
                    var content = data.data_activities[i].content.substring(0, 80) + "...";
                }else{
                    var content = data.data_activities[i].content;
                }
                if (splited[splited.length - 1] == 'mp4') {
                    $('#loadActivity').append('<div class="box_full_l slot3"><div class="pic"><video class="article_pic" src="'+ base_url +'assets/activity/'+ data.data_activities[i].url_image +'" controls></div><div class="text"><div class="date">'+ date +'</div><h3>'+ data.data_activities[i].title +'</h3><p>'+ content +'</p><a href="'+ base_url +'site/detailAct/'+ data.data_activities[i].activity_id +'" title="">Read More</a></div></div>');
                }else{
                    $('#loadActivity').append('<div class="box_full_l slot3"><div class="pic"><img src="'+ base_url +'assets/activity/'+ data.data_activities[i].url_image +'" alt="" class="article_pic"></div><div class="text"><div class="date">'+ date +'</div><h3>'+ data.data_activities[i].title +'</h3><p>'+ content +'</p><a href="'+ base_url +'site/detailAct/'+ data.data_activities[i].activity_id +'" title="">Read More</a></div></div>');
                }
            }
        }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('server not responding...');
    });
}

$('#btnFMore').on('click', function () {
    pageF++;
    loadMoreDataF(pageF);
});

function loadMoreDataF(pageF) {
    $.ajax(
    {
        url : base_url + 'Site/getPage/' + pageF,
        type: "POST",
        dataType : "JSON",
        data : {'key' : 'faq'},
        beforeSend: function()
        {
            $('#loadF').show();
        }
    })
    .done(function(data)
    {
        if(data.data_faq == 0){
            $('#btnFMore').hide();
            $('#loadF').html("");
            return;
        }else{
            $('#loadF').hide();
            for (var i = 0; i < data.data_faq.length; i++) {
                $('#accordion1').append('<div class="panel faq_style"><div class="panel-heading"><h4 class="panel-title"><a id="'+data.data_faq[i].faq_id+'" href="#question'+data.data_faq[i].faq_id+'" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1">'+data.data_faq[i].question+'</a></h4></div><div id="question'+data.data_faq[i].faq_id+'" class="panel-collapse collapse"><div class="panel-body"><p>'+data.data_faq[i].answer+'</p></div></div></div>');
            }
        }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('server not responding...');
    });
}



// ##############################################################################################################


$('#optMarried').hide();
$('#check2').hide();

var form = $("#contact");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.after(error); },
    rules: {
        position:"required",
        fullname:"required",
        pob:"required",
        dob:"required",
        religion:"required",
        sex:"required",
        idnum:"required",
        status:"required",
        curr_address:"required",
        curr_district:"required",
        ca_city:"required",
        ca_zip_code:"required",
        ca_ph:"required",
        per_address:"required",
        per_district:"required",
        pa_city:"required",
        pa_zip_code:"required",
        pa_ph:"required",
        email:"required",
        candidat_phone:"required",
        "applicant_family[family_name][]":"required",
        "applicant_family[family_relation][]":"required",
        "applicant_family[family_gender][]":"required",
        "applicant_family[family_dob][]":"required",
        "applicant_family[family_edu][]":"required",
        "applicant_edu[edu_institute][]":"required",
        "applicant_edu[edu_major][]":"required",
        "applicant_edu[edu_title][]":"required",
        "applicant_edu[edu_start][]":"required",
        "applicant_edu[edu_end][]":"required",
        "applicant_edu[gpa][]":"required",
        salary:"required",
        describe:"required"
    }
});

form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        form.submit();
    }
});


// ##############################################################################################################


$('#contact').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url : base_url + 'applicant/update_form_applicant',
        dataType : 'JSON',
        type : 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success : function(data) {
            if (data.type == 'done') {
                swal({
                    title : "Success!", 
                    html : data.msg, 
                    type : "success"
                }).then(function(){
                    window.location.reload();
                });
            }else{
                swal({
                    title:"Failed", 
                    html : data.msg,
                    type:"error"
                });
            }
        }
    });
});


// ##############################################################################################################


$('input[name=checkPerm]').click(function () {
    if($(this).prop('checked') == true){
        $('#per_address').val($('#curr_address').val());
        $('#per_district').val($('#curr_district').val());
        $('#pa_city').val($('#ca_city').val());
        $('#pa_zip_code').val($('#ca_zip_code').val());
        $('#pa_ph').val($('#ca_ph').val());
    }else if($(this).prop('checked') == false){
        $('#per_address').val('');
        $('#per_district').val('');
        $('#pa_city').val('');
        $('#pa_zip_code').val('');
        $('#pa_ph').val('');
    }
});


// ##############################################################################################################




$('#martialStatus').on('change', function () {
    var status = $(this).val();

    if(status == 'Single' || status == ''){
        $('#optMarried').hide();
    }else{
        $('#optMarried').show();
    }
});


// ##############################################################################################################


$('input[name=work_bg]').click(function() {
    var val = $('input[name=work_bg]:checked').val();
    if(val == 'Yes'){
        $('#check2').show();
    }else{
        $('#check2').hide();
    }
});


// ##############################################################################################################


$('#addFam').click(function () {
    var famLength = $('#familyContainer tr').length;
    if (famLength < 5) {
        var inputName = '<div class="form-group m-b-0"><div class="form-line"><input type="text" class="form-control" name="applicant_family[family_name][]" value=""><input type="hidden" name="applicant_family[family_id][]" value=""></div></div>';
        var inputRelationship = '<select class="form-control show-tick" name="applicant_family[family_relation][]" data-container="body"><option value="">- Choose -</option><option value="PARENT" >Parent</option><option value="SIBLING" >Sibling</option><option value="CHILD" >Child</option></select>';
        var inputGender = '<select class="form-control show-tick" name="applicant_family[family_gender][]" data-container="body"><option value="">- Choose -</option><option value="M" >Male</option><option value="F" >Female</option></select>';
        var DOB = '<div class="form-group m-b-0"><div class="form-line"><input type="date" class="form-control date-picker" name="applicant_family[family_dob][]" value=""></div></div>';
        var education = '<select class="form-control show-tick" name="applicant_family[family_edu][]" data-container="body"><option value="">- Choose -</option><option value="S2" >S2</option><option value="S1" >S1</option><option value="D3" >D3</option><option value="SMU" >SMU</option></select>';

        $('#familyContainer').append('<tr class=""><td><div class="form-group m-b-0"><div class="form-line"><img name="removeFam" src="'+base_url+'assets/icon/minus.svg" alt=""/></div></div></td><td>'+inputName+'</td><td>'+inputRelationship+'</td><td>'+inputGender+'</td><td>'+DOB+'</td><td>'+education+'</td></tr>');
    }else{
        $('#addFam').hide();
    }
});


// ##############################################################################################################


$('#addEdu').click(function() {
    var eduLength = $('#eduContainer tr').length;
    var iconDelete = '<img name="removeEdu" src="'+base_url+'assets/icon/minus.svg" alt=""/>';
    var institution = '<select id="eduInstitute" name="applicant_edu[edu_institute][]" class="form-control show-tick" data-container="body"><option value="">- Choose -</option><option value="OTHER">Other</option>';
    var major = '<input type="text" class="form-control" name="applicant_edu[edu_major][]" placeholder="Major" value="">';
    var title = '<select class="form-control show-tick" name="applicant_edu[edu_title][]" data-container="body"><option value="">- Choose -</option><option value="S2" >S2</option><option value="S1" >S1</option><option value="D3" >D3</option><option value="SMU" >SMU</option></select>';
    var start = '<input type="date" class="form-control" name="applicant_edu[edu_start][]" value="">';
    var finish = '<input type="date" class="form-control" name="applicant_edu[edu_end][]" value="">';
    var gpa = '<input type="number" class="form-control" name="applicant_edu[gpa][]" placeholder="GPA" value="">';

    if (eduLength < 3) {
        $.ajax({
            url : base_url + 'Site/getUniversity',
            type : 'POST',
            dataType : 'JSON',
            success : function (data) {
                for (var i = 0; i < data.length; i++) {
                    institution += '<option value="'+data[i].university_name+'">'+data[i].university_name+'</option>';
                }
                institution += '</select><input type="text" id="tempInstitute" name="applicant_edu[edu_institute][]" style="display: none;">';
                var newForm = '<tr><td><div class="form-group m-b-0"><div class="form-line">'+iconDelete+'</div></div></td><td><div class="form-group m-b-0"><div class="form-line" id="addOther">'+institution+'<input type="hidden" name="applicant_edu[cedu_id][]" value="" ></div></div></td><td><div class="form-group m-b-0"><div class="form-line">'+major+'</div></div></td><td><div class="form-group m-b-0"><div class="form-line">'+title+'</div></div></td><td><div class="form-group m-b-0"><div class="form-line">'+start+'</div></div></td><td><div class="form-group m-b-0"><div class="form-line">'+finish+'</div></div></td><td style="width: 30%"><div class="form-group m-b-0"><div class="form-line">'+gpa+'</div></div></td></tr>';
                $('#eduContainer').append(newForm);
            }
        });

    }else{
        $('#addEdu').hide();
    }
});


// ##############################################################################################################


/*$(document).on('change', '#eduInstitute', function (event) {

    var key = $(this).val();

    if (key == 'OTHER') {
        $('#tempInstitute').show();
    }

});*/


// ##############################################################################################################


$('#addWExp').click(function() {
    var workLength = $('#workContainer tr').length;
    var newForm = '<tr><td><div class="form-group m-b-0"><div class="form-line"><img name="removeWork" src="'+base_url+'assets/icon/minus.svg" alt=""/></div></div></td><td><div class="form-group m-b-0"><div class="form-line"><input type="text" class="form-control" name="applicant_employment[company_name][]" placeholder="Company" value=""><input type="hidden" name="applicant_employment[work_exp_id][]" value=""></div></div></td><td><div class="form-group m-b-0"><div class="form-line"><input type="text" class="form-control" name="applicant_employment[work_exp_title][]" placeholder="Job Title" value=""></div></div></td><td><div class="form-group m-b-0"><div class="form-line"><input type="text" class="form-control" name="applicant_employment[last_salary][]" placeholder="Last Salary" value=""></div></div></td><td><div class="form-group m-b-0"><div class="form-line"><input type="text" class="form-control" name="applicant_employment[job_desc][]" placeholder="Job Desc" value=""></div></div></td><td><div class="form-group m-b-0"><div class="form-line"><input type="date" class="form-control" name="applicant_employment[work_exp_from][]" value=""></div></div></td><td style="width: 30%"><div class="form-group m-b-0"><div class="form-line"><input type="date" class="form-control" name="applicant_employment[work_exp_to][]"value=""></div></div></td></tr>';

    if (workLength < 3) {
        $('#workContainer').append(newForm);
    }else{
        $('#addWExp').hide();
    }
});


// ##############################################################################################################


$('#addOrg').click(function() {
    var orgLength = $('#orgContainer tr').length;
    var newForm = '<tr><td><div class="form-group m-b-0"><div class="form-line"><img name="removeOrg" src="'+base_url+'assets/icon/minus.svg" alt=""/></div></div></td><td><div class="form-group m-b-0"><div class="form-line"><input type="hidden" name="applicant_organization[org_id][]" value=""><input type="text" name="applicant_organization[activities][]" placeholder="Organization Name" value=""></div></div></td><td><div class="form-group m-b-0"><div class="form-line"><input type="text" name="applicant_organization[org_pos][]" placeholder="Position" value=""></div></div></td></tr>';

    if (orgLength < 3) {
        $('#orgContainer').append(newForm);
    }else{
        $('#addOrg').hide();
    }
});


// ##############################################################################################################


$(document).on('click', 'img[name=removeFam]', function(event) {
    var famLength = $('#familyContainer tr').length;

    var data = {"type" : "delFamily", "id" : $(this).data('id'), "relation" : $(this).data('name')};

    if (data.id) {
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
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : base_url + "Site/ajax_remove_data",
                    type : "POST",
                    dataType : "JSON",
                    data : data,
                    success : function(data){
                        if ( data.type === 'done' ){
                            swal({
                                title : "Deleted!", 
                                text : data.msg, 
                                type : "success"
                            }).then( function(){
                                $( event.target ).closest('#familyContainer tr').remove();
                            });
                        }
                        else{
                            swal({
                                title : "Error!", 
                                text : data.msg, 
                                type : "error"
                            }).then(function () {
                                swal.close();
                            });
                        }
                    }
                });

            } else {
                swal("Cancelled", "Remove data cancelled", "error");
            }
        });
    }else{
       $(this).closest('#familyContainer tr').remove(); 
   }

   if (famLength <= 5) {
    $('#addFam').show();
}else{
    $('#addFam').hide();
}
});


// ##############################################################################################################


$(document).on('click', 'img[name=removeWork]', function(event) {
    var workLength = $('#workContainer tr').length;

    var data = {"type" : "delWork", "id" : $(this).data('id')};

    if (data.id) {
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
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : base_url + "Site/ajax_remove_data",
                    type : "POST",
                    dataType : "JSON",
                    data : data,
                    success : function(data){
                        if ( data.type === 'done' ){
                            swal({
                                title : "Deleted!", 
                                text : data.msg, 
                                type : "success"
                            }).then(function() {
                                $( event.target ).closest('#workContainer tr').remove();                            
                            });
                        }
                        else{
                            swal({
                                title : "Error!", 
                                text : data.msg, 
                                type : "error"
                            }).then(function () {
                                swal.close();
                            }); 
                        }
                    }
                });

            } else {
                swal("Cancelled", "Remove data cancelled", "error");
            }
        });
    }else{
       $(this).closest('#workContainer tr').remove(); 
   }


   if (workLength <= 3) {
    $('#addWExp').show();
}else{
    $('#addWExp').hide();
}
});


// ##############################################################################################################


$(document).on('click', 'img[name=removeEdu]', function(event) {
    var eduLength = $('#eduContainer tr').length;

    var data = {"type" : "delEdu", "id" : $(this).data('id')};

    if (data.id) {
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
        }).then( function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : base_url + "Site/ajax_remove_data",
                    type : "POST",
                    dataType : "JSON",
                    data : data,
                    success : function(data){
                        if ( data.type === 'done' ){
                            swal({
                                title : "Deleted!", 
                                text : data.msg, 
                                type : "success"
                            }).then(function () {
                                $( event.target ).closest('#eduContainer tr').remove();                            
                            });
                        }
                        else{
                            swal({
                                title : "Error!", 
                                text : data.msg, 
                                type : "error"
                            }).then(function () {
                                swal.close();
                            });
                        }
                    }
                });

            } else {
                swal("Cancelled", "Remove data cancelled", "error");
            }
        });
    }else{
        $(this).closest('#eduContainer tr').remove(); 
    }


    if (eduLength <= 3) {
        $('#addEdu').show();
    }else{
        $('#addEdu').hide();
    }
});


// ##############################################################################################################


$(document).on('click', 'img[name=removeOrg]', function(event) {
    var orgLength = $('#orgContainer tr').length;

    var data = {"type" : "delOrg", "id" : $(this).data('id')};

    if (data.id) {
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
        }).then( function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url : base_url + "Site/ajax_remove_data",
                    type : "POST",
                    dataType : "JSON",
                    data : data,
                    success : function(data){
                        if ( data.type === 'done' ){
                            swal({
                                title : "Deleted!", 
                                text : data.msg, 
                                type : "success"
                            }).then(function () {
                                $( event.target ).closest('#orgContainer tr').remove();                            
                            });
                        }
                        else{
                            swal({
                                title : "Error!", 
                                text : data.msg, 
                                type : "error"
                            }).then(function () {
                                swal.close();
                            });
                        }
                    }
                });

            } else {
                swal("Cancelled", "Remove data cancelled", "error");
            }
        });
    }else{
        $(this).closest('#orgContainer tr').remove(); 
    }

    if (orgLength <= 3) {
        $('#addOrg').show();
    }else{
        $('#addOrg').hide();
    }
});

});

jQuery(document).ready(function($) {

//     if (window.location.pathname == '/karir-dev/') {
//         var scrollLink = $('.scroll');
//         scrollLink.click(function(e) {
//             e.preventDefault();
//             var hash = this.hash;
//             $('html').animate({
//                 scrollTop: $(this.hash).offset().top
//             }, 800, function () {
//                 window.location.hash = hash;
//             } );
//         });

// // Active link switching
// $(this).scroll(function() {
//     var scrollbarLocation = $(this).scrollTop();

//     scrollLink.each(function() {

//         var sectionOffset = $(this.hash).offset().top - 20;

//         if ( sectionOffset <= scrollbarLocation ) {
//             $(this).parent().addClass('act');
//             $(this).parent().siblings().removeClass('act');
//         }
//     })
// });
// }

});