<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/waves.min.css">
<link rel="stylesheet/less" href="<?php echo base_url(); ?>assets/css/main.less">

<?php require_once "header_user_profile.php"; ?>
<div class="bg_pattern pac60">
    <div class="frame">
        <div class="box_apply">
            <form id="contact" action="#">
                <div>
                    <h3>Apply</h3>
                    <section>
                        <div class="tile">General Info</div>
                        <label for="position">Position Applied</label>
                        <select class="custom-select my_select" >
                            <option value="">Choose Your Position</option>
                            <option value="Position 1" >Position 1</option>
                            <option value="Position 2" >Position 2</option>
                            <option value="Position 3" >Position 3</option>
                            <option value="Position 4" >Position 4</option>
                            <option value="Position 5" >Position 5</option>
                            <option value="Position 6" >Position 6</option>
                        </select>
                        <label>Alternatives Position</label>
                        <select class="custom-select my_select" >
                            <option value="">Choose Your Position</option>
                            <option value="Position 1" >Position 1</option>
                            <option value="Position 2" >Position 2</option>
                            <option value="Position 3" >Position 3</option>
                            <option value="Position 4" >Position 4</option>
                            <option value="Position 5" >Position 5</option>
                            <option value="Position 6" >Position 6</option>
                        </select>
                        <select class="custom-select my_select" >
                            <option value="">Choose Your Position</option>
                            <option value="Position 1" >Position 1</option>
                            <option value="Position 2" >Position 2</option>
                            <option value="Position 3" >Position 3</option>
                            <option value="Position 4" >Position 4</option>
                            <option value="Position 5" >Position 5</option>
                            <option value="Position 6" >Position 6</option>
                        </select>
                        <label for="timejoin">When You Can Join? *</label>
                        <input id="timejoin" name="timejoin" type="date">
                        <label for="uplodcv">Upload Your CV *</label>
                        <input type="file" name="uplodcv" id="uplodcv">
                        <label for="uplodfoto">Upload Your Photo *</label>
                        <input type="file" name="uplodfoto" id="uplodfoto">
                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Personal Data</h3>
                    <section>
                        <div class="tile">Personal Data</div>
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input id="fullname" name="fullname" type="text" placeholder="Full Name">
                            <label for="dob">Date of Birth</label>
                            <input id="dob" name="dob" type="text" placeholder="Date of Birth">
                            <label for="religion">Religion</label>
                            <select class="custom-select my_select" id="religion" name="religion">
                                <option value="">Religion</option>
                                <option value="Religion" >Religion</option>
                                <option value="Religion" >Religion</option>
                                <option value="Religion" >Religion</option>
                            </select>
                            <label for="sex">Sex</label>
                            <select class="custom-select my_select" name="sex" id="sex">
                                <option value="">Sex</option>
                                <option value="Male" >Male</option>
                                <option value="Female" >Female</option>
                            </select>
                            <label for="idnum">ID Number</label>
                            <input type="text" placeholder="ID Number" id="idnum" name="idnum">
                            <label for="status">Status</label>
                            <select class="custom-select my_select">
                                <option value="">Status</option>
                                <option value="Status" >Status</option>
                                <option value="Status" >Status</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h5>Family Member</h5>
                            <input id="" name="" type="text">
                        </div>

                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Contact</h3>
                    <section>
                        <div class="tile">Contact</div>
                        <div class="form-group">
                            <h5>Your Address</h5>
                            <input type="text" placeholder="Address">
                            <select class="custom-select my_select">
                                <option value="">Sub-district</option>
                                <option value="" >Position 1</option>
                                <option value="" >Position 2</option>
                                <option value="" >Position 3</option>
                                <option value="" >Position 4</option>
                                <option value="" >Position 5</option>
                                <option value="" >Position 6</option>
                            </select>
                            <select class="custom-select my_select">
                                <option value="">City</option>
                                <option value="" >Position 1</option>
                                <option value="" >Position 2</option>
                                <option value="" >Position 3</option>
                                <option value="" >Position 4</option>
                                <option value="" >Position 5</option>
                                <option value="" >Position 6</option>
                            </select>
                            <select class="custom-select my_select">
                                <option value="">Postal Code</option>
                                <option value="" >Position 1</option>
                                <option value="" >Position 2</option>
                                <option value="" >Position 3</option>
                                <option value="" >Position 4</option>
                                <option value="" >Position 5</option>
                                <option value="" >Position 6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h5>Phone Number</h5>
                            <input type="text" placeholder="Phone">
                            <input type="text" placeholder="Whatsapp">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="" id="" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <h5>Social Media</h5>
                            <input type="text" placeholder="Instagram">
                            <input type="text" placeholder="Facebook">
                            <input type="text" placeholder="linkedin">
                        </div>

                    </section>
                    <h3>Background</h3>
                    <section>
                        <div class="tile">Background</div>
                        <div class="form-group">
                            <label for="work_bg">Have You Ever Worked With Us Before?</label>
                            <input type="radio" class="radio_b" name="work_bg" value="Yes"><span class="rb">Yes</span>
                            <input type="radio" class="radio_b" name="work_bg" value="No"><span class="rb">No</span>
                        </div>
                        <div class="form-group">
                            <h5>Work Experiences :</h5>
                            <input type="text" placeholder="Company">
                            <input type="text" placeholder="Job Title">
                            <textarea name="" id="" cols="30" rows="10" placeholder="Job Description"></textarea>
                            <input type="text" placeholder="Last Salary">
                        </div>
                        <div class="form-group">
                            <h5>Educational Backgrounds :</h5>
                            <input type="text" placeholder="Institution">
                            <input type="text" placeholder="Major">
                        </div>
                        <div class="form-group">
                            <h5>Organizational Experiences:</h5>
                            <input type="text" placeholder="Organization Name">
                            <input type="text" placeholder="Position">
                        </div>
                        <p>(*) Mandatory</p>
                    </section>
                    <h3>Finish</h3>
                    <section>
                        <div class="tile">Finish</div>
                        <label for="salary">Expected Salary</label>
                        <input type="text" name="salary" id="salary">
                        <label for="">Why We Should Hire You</label>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.11.0.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/waves.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.steps.js"></script> -->

<script>
    var form = $("#contact");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.after(error); },
        rules: {
            position:"required",
            timejoin:"required",
            uplodcv:"required",
            fullname:"required"
        },
        messages: {
            position:"Pilih posisi yang Anda inginkan",
            timejoin:"Isi kolom ini",
            uplodcv:"Upload CV Anda",
            fullname:"Nama Lengkap Anda"
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
            alert("Submitted!");
        }
    });


</script>
</body>
</html>