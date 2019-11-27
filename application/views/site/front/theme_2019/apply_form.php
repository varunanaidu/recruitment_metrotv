<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/waves.min.css">
<link rel="stylesheet/less" href="<?php echo base_url(); ?>assets/css/main.less">

<?php require_once "header_apply_form.php"; ?>

<div class="bg_pattern pac60">
    <div class="frame">
        <div class="box_apply">
            <form role="form" action="#" id="contact" method="POST" enctype="multipart/form-data">
                <div>
                    <h3>Apply</h3>
                    <section>

                        <!-- photo and applied position box -->

                        <div class="card shadow">
                            <div class="col-md-4">
                                <?php
                                if (isset($applicant_data) and $applicant_data != 0) {
                                    foreach ($applicant_data as $row) {
                                        if ($row->candidat_foto != "") {
                                           ?>
                                           <img src="<?php echo base_url(); ?>/media/candidate/<?php echo $row->candidat_foto; ?>" class="img_avatar">
                                           <?php
                                       }
                                   }
                               } 
                               ?>
                           </div>
                           <div class="position">
                            <h3 class="text-right">Applied Position</h3>
                            <?php
                            if (isset($applicant_apply) and $applicant_apply != 0) {
                                foreach ($applicant_apply as $row) {
                                    ?>
                                    <ul>
                                        <li style="float: right;"><?php echo $row->a ?></li>
                                    </ul>
                                    <?php 
                                }
                            }else{
                                ?>
                                <h4>Nothing Applied Before</h4>     
                                <?php 
                            } 
                            ?> 
                        </div>
                    </div>

                    <div class="tile">Apply</div>
                    <?php
                    if (isset($vacancy_detail)) {
                        foreach ($vacancy_detail as $row) {
                            ?>
                            <label for="position">Position *</label>
                            <select class="custom-select my_select" name="position">
                                <option value="">Choose Your Position</option>
                                <?php
                                if (isset($vacancy)) {
                                    foreach ($vacancy as $row2) {
                                        ?>
                                        <option value="<?php echo $row2->vacant_id ?>" <?=(ist($row2->vacant_id) == $row->vacant_id) ? 'selected' : ''  ?>><?php echo $row2->vacant_title ?></option>
                                        <?php 
                                    }
                                } 
                                ?>
                            </select>
<!-- <label>Alternatives</label>
<select class="custom-select my_select" name="alternate_pos1" >
<option value="">Choose Your Position</option>
<?php
if (isset($vacancy)) {
foreach ($vacancy as $row) {
?>
<option value="<?php echo $row->vacant_id ?>"><?php echo $row->vacant_title ?></option>
<?php 
}
} 
?>
</select>
<select class="custom-select my_select" name="alternate_pos2" >
<option value="">Choose Your Position</option>
<?php
if (isset($vacancy)) {
foreach ($vacancy as $row) {
?>
<option value="<?php echo $row->vacant_id ?>"><?php echo $row->vacant_title ?></option>
<?php 
}
} 
?>
</select>
<label for="timejoin">When You Can Join? *</label>
<input id="timejoin" name="timejoin" type="date"> -->
<?php 
}
} 
?> 
<div class="form-group">
    <?php
    if (isset($applicant_data) and $applicant_data != 0) {
        foreach ($applicant_data as $row) {
            ?>
            <label for="uploadfile">Upload Your CV (Allowed file type : doc, docx, pdf (max. 200 Kb)) *</label>
            <input type="file" name="uploadfile[]" accept=".doc, .docx, .pdf">
            <?php
            echo (empty($row->candidat_cv) ? '<span style="color : red;">NOT UPLOADED</span>' : '<span style="color:green;">UPLOADED</span>'); 
            ?>
            <label for="uploadfile">Upload Your Photo (Allowed file type : jpg, jpeg, png (max. 200 Kb)) *</label>
            <input type="file" name="uploadfile[]" accept=".jpg, .jpeg, .png">
            <?php
            echo (empty($row->candidat_foto) ? '<span style="color : red;">NOT UPLOADED</span>' : '<span style="color:green;">UPLOADED</span>'); 
            ?>
            <?php 
        }
    } 
    ?>
</div>
<p>(*) Mandatory</p>


</section>
<!-- ######################################################################################################################################## -->
<h3>Personal Data</h3>
<section>
    <div class="tile">Personal Data</div>
    <div class="form-group">
        <?php
        if (isset($applicant_data) and $applicant_data != 0) {
            foreach ($applicant_data as $row) {
                if (is_null($row->dob)) {
                    $dob = '';
                }else{
                    $dob = date('Y-m-d', strtotime($row->dob) );
                }
                ?>
                <label for="fullname"><img src="<?php echo base_url(); ?>assets/icon/fullname.svg" alt=""/>&nbsp;Full Name *</label>
                <input id="fullname" name="fullname" type="text" placeholder="Full Name" value="<?php echo $row->candidat_name ?>">
                <div class="row">
                    <div class="col-md-6">
                        <label for="pob"><img src="<?php echo base_url(); ?>assets/icon/dob.svg" alt=""/>&nbsp;Place of Birth *</label>
                        <input id="pob" name="pob" type="text" placeholder="Place of Birth" value="<?php echo $row->pob ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="dob"><img src="<?php echo base_url(); ?>assets/icon/dob.svg" alt=""/>&nbsp;Date of Birth *</label>
                        <input id="dob" name="dob" type="date" placeholder="Date of Birth" value="<?php echo $dob ?>">
                    </div>
                </div>
                <label for="religion"><img src="<?php echo base_url(); ?>assets/icon/religion.svg" alt=""/>&nbsp;Religion *</label>
                <select class="custom-select my_select" id="religion" name="religion">
                    <option value="">Religion</option>
                    <option value="I" <?=(ist($row->religion_id) == 'I') ? 'selected' : ''  ?>>Islam</option>
                    <option value="P" <?=(ist($row->religion_id) == 'P') ? 'selected' : ''  ?>>Kristen Protestan</option>
                    <option value="K" <?=(ist($row->religion_id) == 'K') ? 'selected' : ''  ?>>Kristen Katolik</option>
                    <option value="H" <?=(ist($row->religion_id) == 'H') ? 'selected' : ''  ?>>Hindu</option>
                    <option value="B" <?=(ist($row->religion_id) == 'B') ? 'selected' : ''  ?>>Budha</option>
                    <option value="O" <?=(ist($row->religion_id) == 'O') ? 'selected' : ''  ?>>Other</option>
                </select>
                <label for="sex"><img src="<?php echo base_url(); ?>assets/icon/gender.svg" alt=""/>&nbsp;Gender *</label>
                <select class="custom-select my_select" name="sex" id="sex">
                    <option value="">Gender</option>
                    <option value="M" <?=(ist($row->gender) == 'M') ? 'selected' : ''  ?>>Male</option>
                    <option value="F" <?=(ist($row->gender) == 'F') ? 'selected' : ''  ?>>Female</option>
                </select>
                <label for="idnum"><img src="<?php echo base_url(); ?>assets/icon/id.svg" alt=""/>&nbsp;KTP Number *</label>
                <input type="number" placeholder="ID Number" id="idnum" name="idnum" value="<?php echo $row->id_number ?>">
                <label for="status"><img src="<?php echo base_url(); ?>assets/icon/marital.svg" alt=""/>&nbsp;Marital Status *</label>
                <select class="custom-select my_select" name="status" id="martialStatus">
                    <option value="">Status</option>
                    <option value="Single" <?=(ist($row->marital_status) == 'Single') ? 'selected' : ''  ?>>Single</option>
                    <option value="Married" <?=(ist($row->marital_status) == 'Married') ? 'selected' : ''  ?>>Married</option>
                </select>
                <div id="optMarried">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="date_mart"><img src="<?php echo base_url(); ?>assets/icon/dob.svg" alt=""/>&nbsp;Date of Marriage *</label>
                            <input id="dom" name="dom" type="date" placeholder="Date of Marriage">
                            <label for="spousename"><img src="<?php echo base_url(); ?>assets/icon/fullname.svg" alt=""/>&nbsp;Spouse Name *</label>
                            <input id="spousename" name="spousename" type="text" placeholder="Spouse Full Name"> 
                        </div>
                        <div class="col-md-6">
                            <label for="sdob"><img src="<?php echo base_url(); ?>assets/icon/dob.svg" alt=""/>&nbsp;Spouse Date of Birth *</label>
                            <input id="sdob" name="sdob" type="date" placeholder="Spouse Date of Birth">
                            <label for="spouse_occupation"><img src="<?php echo base_url(); ?>assets/icon/fullname.svg" alt=""/>&nbsp;Spouse Occupation *</label>
                            <input id="spouse_occupation" name="spouse_occupation" type="text" placeholder="Spouse Occupation">
                        </div>
                    </div>
                </div>
            </div>
            <p>(*) Mandatory</p>
        </section>
        <!-- ######################################################################################################################################## -->
        <h3>Contact</h3>
        <section>
            <div class="tile">Contact</div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?php echo base_url(); ?>assets/icon/address.svg" alt=""/>&nbsp;<h5>Current Address *</h5>
                        <input type="text" name="curr_address" id="curr_address" placeholder="Current Address" value="<?php echo $row->curr_address ?>">
                        <input type="text" name="curr_district" id="curr_district" placeholder="Current Sub District" value="<?php echo $row->curr_district ?>">
                        <input type="text" name="ca_city" id="ca_city" placeholder="Current City" value="<?php echo $row->ca_city ?>">
                        <input type="number" name="ca_zip_code" id="ca_zip_code" placeholder="Current Postal Code" value="<?php echo $row->ca_zip_code ?>">
                        <input type="number" name="ca_ph" id="ca_ph" placeholder="Current Phone" value="<?php echo $row->ca_ph ?>">
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo base_url(); ?>assets/icon/address.svg" alt=""/>&nbsp;<h5>Permanent Address *</h5>
                        <input type="text" name="per_address" id="per_address" placeholder="Permanent Address" value="<?php echo $row->per_address ?>">
                        <input type="text" name="per_district" id="per_district" placeholder="Permanent Sub District" value="<?php echo $row->per_district ?>">
                        <input type="text" name="pa_city" id="pa_city" placeholder="Permanent City" value="<?php echo $row->pa_city ?>">
                        <input type="number" name="pa_zip_code" id="pa_zip_code" placeholder="Permanent Postal Code" value="<?php echo $row->pa_zip_code ?>">
                        <input type="number" name="pa_ph" id="pa_ph" placeholder="Permanent Phone" value="<?php echo $row->pa_ph ?>">
                        <input type="checkbox" class="checkPerm" name="checkPerm" id="checkPerm"><label for="" class="currentAdd">Same as Current Address</label> 
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email"><img src="<?php echo base_url(); ?>assets/icon/email.svg" alt=""/>&nbsp;Email *</label>
                <input type="email" name="email" id="" placeholder="Email" value="<?php echo $row->candidat_email ?>">
                <label for="candidat_phone"><img src="<?php echo base_url(); ?>assets/icon/phone.svg" alt=""/>&nbsp;Phone Number *</label>
                <input type="number" name="candidat_phone" id="candidat_phone" placeholder="Phone Number" value="<?php echo $row->candidat_phone ?>">
                <label for="candidat_phone"><img src="<?php echo base_url(); ?>assets/icon/whatsapp.svg" alt=""/>&nbsp;Whatsapp</label>
                <input type="number" name="wa_number" placeholder="Whatsapp" value="<?php echo $row->candidat_whatsapp ?>">
            </div>
            <div class="form-group">
                <h5>Social Media</h5>
                <div class="row">
                    <div class="col-md-4">
                        <!-- <img src="<?php echo base_url(); ?>assets/icon/instagram.svg" alt=""/> -->
                        <input type="text" name="instagram" placeholder="Instagram" value="<?php echo $row->candidat_instagram ?>">
                    </div>
                    <div class="col-md-4">
                        <!-- <img src="<?php echo base_url(); ?>assets/icon/facebook.svg" alt=""/> -->
                        <input type="text" name="facebook" placeholder="Facebook" value="<?php echo $row->candidat_facebook ?>">
                    </div>
                    <div class="col-md-4">
                        <!-- <img src="<?php echo base_url(); ?>assets/icon/linkedin.svg" alt=""/> -->
                        <input type="text" name="linkedin" placeholder="LinkedIn" value="<?php echo $row->candidat_linkedin ?>">
                    </div>
                </div>
            </div>
            <?php 
        }
    } 
    ?>        
</section>   
<!-- ######################################################################################################################################## -->
<h3>Family Data</h3>
<section>
    <div class="tile">Family Data</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40"></th>
                <th>Name</th>
                <th>Relationship</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Education</th>
            </tr>
        </thead>
        <tbody id="familyContainer">
            <?php
            if (isset($applicant_family) and isset($applicant_children)) {
                if ($applicant_family == 0 and $applicant_children == 0) {
                 ?>
                 <tr class="">
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <img name="removeFam" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt=""/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_family[family_name][]" value="">
                                <input type="hidden" name="applicant_family[family_id][]" value="">
                            </div>
                        </div>
                    </td>
                    <td>
                        <select class="form-control show-tick" name="applicant_family[family_relation][]" data-container="body">
                            <option value="">- Choose -</option>
                            <option value="PARENT" >Parent</option>
                            <option value="SIBLING" >Sibling</option>
                            <option value="CHILD" >Child</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control show-tick" name="applicant_family[family_gender][]" data-container="body">
                            <option value="">- Choose -</option>
                            <option value="M" >Male</option>
                            <option value="F" >Female</option>                                 
                        </select>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="date" class="form-control date-picker" name="applicant_family[family_dob][]" value="">
                            </div>
                        </div>
                    </td>
                    <td>
                        <select class="form-control show-tick" name="applicant_family[family_edu][]" data-container="body">
                            <option value="">- Choose -</option>
                            <option value="S2" >S2</option>
                            <option value="S1" >S1</option>                                  
                            <option value="D3" >D3</option>                                  
                            <option value="SMU" >SMU</option>                             
                        </select>
                    </td>
                </tr>
                <?php 
            }else{
                if ($applicant_family != 0) {
                    for ($i = 0; $i < count($applicant_family); $i++) { 
                        ?>
                        <tr class="">
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <img name="removeFam" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt="" data-id="<?php echo $applicant_family[$i]->family_id ?>" data-name="FAMILY"/>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="applicant_family[family_name][<?=$i?>]" value="<?php echo $applicant_family[$i]->family_name ?>">
                                        <input type="hidden" name="applicant_family[family_id][<?=$i?>]" value="<?php echo $applicant_family[$i]->family_id ?>">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-control show-tick" name="applicant_family[family_relation][<?=$i?>]" data-container="body">
                                    <option value="">- Choose -</option>
                                    <option value="PARENT" <?=(ist($applicant_family[$i]->family_relation) == 'PARENT') ? 'selected' : ''  ?>>Parent</option>
                                    <option value="SIBLING"<?=(ist($applicant_family[$i]->family_relation) == 'SIBLING') ? 'selected' : ''  ?>>Sibling</option>
                                    <option value="CHILD">Child</option>}
                                    option
                                </select>
                            </td>
                            <td>
                                <select class="form-control show-tick" name="applicant_family[family_gender][<?=$i?>]" data-container="body">
                                    <option value="">- Choose -</option>
                                    <option value="M"<?=(ist($applicant_family[$i]->family_gender) == 'M') ? 'selected' : ''  ?>>Male</option>
                                    <option value="F"<?=(ist($applicant_family[$i]->family_gender) == 'F') ? 'selected' : ''  ?>>Female</option>                                 
                                </select>
                            </td>
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <input type="date" class="form-control date-picker" name="applicant_family[family_dob][<?=$i?>]" value="<?php echo date('Y-m-d' ,strtotime($applicant_family[$i]->family_dob)) ?>">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-control show-tick" name="applicant_family[family_edu][<?=$i?>]" data-container="body">
                                    <option value="">- Choose -</option>
                                    <option value="S2" <?=(ist($applicant_family[$i]->family_edu) == 'S2') ? 'selected' : ''  ?>>S2</option>
                                    <option value="S1" <?=(ist($applicant_family[$i]->family_edu) == 'S1') ? 'selected' : ''  ?>>S1</option>                                  
                                    <option value="D3" <?=(ist($applicant_family[$i]->family_edu) == 'D3') ? 'selected' : ''  ?>>D3</option>                                  
                                    <option value="SMU" <?=(ist($applicant_family[$i]->family_edu) == 'SMU') ? 'selected' : ''  ?>>SMU</option>                                   
                                </select>
                            </td>
                        </tr>
                        <?php
                    }
                }
                if ($applicant_children != 0) {
                    for ($j=0; $j < count($applicant_children); $j++) {
                        ?>
                        <tr class="">
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <img name="removeFam" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt="" data-id="<?php echo $applicant_children[$j]->child_id ?>" data-name="CHILD"/>
                                    </div>
                                </div>
                            </td>
                            <td style="width:20%">
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="applicant_family[family_name][<?=$j?>]" value="<?php echo $applicant_children[$j]->child_name ?>">
                                        <input type="hidden" name="applicant_family[family_id][<?=$j?>]" value="<?php echo $applicant_children[$j]->child_id ?>">
                                    </div>
                                </div>
                            </td>
                            <td style="width:20%">
                                <select class="form-control show-tick" name="applicant_family[family_relation][<?=$j?>]" data-container="body">
                                    <option value="PARENT"> Parent</option>
                                    <option value="SIBLING"> Sibling</option>
                                    <option value="CHILD" selected=""> Child</option>
                                </select>
                            </td>
                            <td style="width:20%">
                                <select class="form-control show-tick" name="applicant_family[family_gender][<?=$j?>]" data-container="body">
                                    <option value="">- Choose -</option>
                                    <option value="M"<?=(ist($applicant_children[$j]->child_gender) == 'M') ? 'selected' : ''  ?>>Male</option>
                                    <option value="F"<?=(ist($applicant_children[$j]->child_gender) == 'F') ? 'selected' : ''  ?>>Female</option>                                 
                                </select>
                            </td>
                            <td style="width:20%">
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <input type="date" class="form-control date-picker" name="applicant_family[family_dob][<?=$j?>]" value="<?php echo date('Y-m-d' ,strtotime($applicant_children[$j]->child_dob)) ?>">
                                    </div>
                                </div>
                            </td>
                            <td style="width:20%">
                                <select class="form-control show-tick" name="applicant_family[family_edu][<?=$j?>]" data-container="body">
                                    <option value="">- Choose -</option>
                                    <option value="S2" <?=(ist($applicant_children[$j]->child_edu) == 'S2') ? 'selected' : ''  ?>>S2</option>
                                    <option value="S1" <?=(ist($applicant_children[$j]->child_edu) == 'S1') ? 'selected' : ''  ?>>S1</option>                                  
                                    <option value="D3" <?=(ist($applicant_children[$j]->child_edu) == 'D3') ? 'selected' : ''  ?>>D3</option>                                  
                                    <option value="SMU" <?=(ist($applicant_children[$j]->child_edu) == 'SMU') ? 'selected' : ''  ?>>SMU</option>                                   
                                </select>
                            </td>
                        </tr>
                        <?php 
                        $i++;
                    }
                }
            }
        } 
        ?>
    </tbody>
</table>

<label id="addFam" for="idnum"><img src="<?php echo base_url(); ?>assets/icon/plus.svg" alt=""/>&nbsp;&nbsp;ADD FAMILY MEMBER</label>
</section>
<!-- ######################################################################################################################################## -->
<h3>Work Experiences</h3>
<section>
    <div class="tile">Work Experiences</div>
    <?php
    if (isset($applicant_data) and $applicant_data != 0) {
        foreach ($applicant_data as $rows) {
            if (is_null($rows->candidat_latest_position)) {
             ?>
             <div class="form-group">
                <label for="work_bg">Have You Ever Worked With Us Before? *</label>
                <input class="workExp" type="radio" name="work_bg" value="Yes"><span class="rb">Yes</span>
                <input class="workExp" type="radio" name="work_bg" value="No" checked=""><span class="rb">No</span>
            </div>
            <div class="form-group" id="check2">
                <input type="text" name="latestPost" placeholder="Your Latest Position">
            </div>
            <?php 
        }else{
          ?>
            <div class="form-group" >
                <label for="latestPost">Your latest position when you worked with us </label>
                <input type="text" name="latestPost" placeholder="Your Latest Position" value="<?php echo $rows->candidat_latest_position ?>">
            </div>
          <?php 

      }
  }
} 
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="40"></th>
            <th>Company</th>
            <th>Job Title</th>
            <th>Last Salary</th>
            <th>Job Description</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody id="workContainer" class="workContainer">
        <?php 
        if (isset($applicant_employment) and $applicant_employment != 0) {
            for ($i = 0; $i < count($applicant_employment); $i++) {
                ?>
                <tr>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <img name="removeWork" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt="" data-id="<?php echo $applicant_employment[$i]->work_exp_id ?>"/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_employment[company_name][<?=$i?>]" placeholder="Company" value="<?php echo $applicant_employment[$i]->company_name ?>">
                                <input type="hidden" name="applicant_employment[work_exp_id][<?=$i?>]" value="<?php echo $applicant_employment[$i]->work_exp_id ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_employment[work_exp_title][<?=$i?>]" placeholder="Job Title" value="<?php echo $applicant_employment[$i]->work_exp_title ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_employment[last_salary][<?=$i?>]" placeholder="Last Salary" value="<?php echo $applicant_employment[$i]->last_salary ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_employment[job_desc][<?=$i?>]" placeholder="Job Desc" value="<?php echo $applicant_employment[$i]->job_desc ?>">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="date" class="form-control" name="applicant_employment[work_exp_from][<?=$i?>]" value="<?php echo date('Y-m-d', strtotime($applicant_employment[$i]->work_exp_from)) ?>">

                                    <!-- <div class="input-daterange input-group month-picker" id="" style="margin-bottom:4px">
                                        <input type="text" class="input-sm form-control" name="" value=""/>
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control" name="" value=""/>
                                    </div> -->
                                </div>
                            </div>
                        </td>
                        <td style="width: 30%">
                            <div class="form-group m-b-0">
                                <div class="form-line">
                                    <input type="date" class="form-control" name="applicant_employment[work_exp_to][<?=$i?>]" value="<?php echo date('Y-m-d', strtotime($applicant_employment[$i]->work_exp_to)) ?>">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php 
                }
            }else{
                ?>
                <tr>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <img name="removeWork" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt=""/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_employment[company_name][]" placeholder="Company" value="">
                                <input type="hidden" name="applicant_employment[work_exp_id][]" value="">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_employment[work_exp_title][]" placeholder="Job Title" value="">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_employment[last_salary][]" placeholder="Last Salary" value="">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_employment[job_desc][]" placeholder="Job Desc" value="">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="date" class="form-control" name="applicant_employment[work_exp_from][]" value="">
                            </div>
                        </div>
                    </td>
                    <td style="width: 30%">
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="date" class="form-control" name="applicant_employment[work_exp_to][]" value="">
                            </div>
                        </div>
                    </td>
                </tr>
                <?php 
            }
            ?>    
        </tbody>
    </table>
    <label for="idnum" id="addWExp"><img src="<?php echo base_url(); ?>assets/icon/plus.svg" alt=""/>&nbsp;&nbsp;ADD WORK EXPERIENCES</label>
</section>
<!-- ######################################################################################################################################## -->
<h3>Educational Backgrounds</h3>
<section>
    <div class="tile">Educational Backgrounds</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40"></th>
                <th>Institution</th>
                <th>Major</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>GPA</th>
            </tr>
        </thead>
        <tbody id="eduContainer" class="workContainer">
            <?php
            if (isset($applicant_edu) and $applicant_edu != 0) {
                for($i = 0; $i < count($applicant_edu) ; $i++){
                    ?>
                    <tr>
                        <td>
                            <div class="form-group m-b-0">
                                <div class="form-line">
                                    <img name="removeEdu" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt="" data-id="<?php echo $applicant_edu[$i]->cedu_id ?>"/>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group m-b-0">
                                <div class="form-line">
                                    <select id="eduInstitute" name="applicant_edu[edu_institute][<?=$i?>]" class="form-control show-tick" data-container="body">
                                        <option value="">- Choose -</option>
                                        <option value="OTHER"> Other </option>
                                        <?php
                                        if (isset($university) and $university != 0) {
                                            foreach ($university as $row) {
                                                ?>
                                                <option value="<?php echo $row->university_name ?>" <?=(ist($applicant_edu[$i]->edu_institute) == $row->university_name) ? 'selected' : ''  ?> ><?php echo $row->university_name; ?></option>
                                                <?php 
                                            }
                                        }
                                        ?>        
                                    </select>
                                    <!-- <input type="text" id="tempInstitute" name="applicant_edu[edu_institute][<?=$i?>]" style="display: none;"> -->
                                    <input type="hidden" name="applicant_edu[cedu_id][<?=$i?>]" value="<?php echo $applicant_edu[$i]->cedu_id ?>" >
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group m-b-0">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="applicant_edu[edu_major][<?=$i?>]" placeholder="Major" value="<?php echo $applicant_edu[$i]->edu_major ?>">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group m-b-0">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="applicant_edu[edu_title][<?=$i?>]" data-container="body">
                                        <option value="">- Choose -</option>
                                        <option value="S2" <?=(ist($applicant_edu[$i]->edu_title) == 'S2') ? 'selected' : ''  ?>>S2</option>
                                        <option value="S1" <?=(ist($applicant_edu[$i]->edu_title) == 'S1') ? 'selected' : ''  ?>>S1</option>                                  
                                        <option value="D3" <?=(ist($applicant_edu[$i]->edu_title) == 'D3') ? 'selected' : ''  ?>>D3</option>                                  
                                        <option value="SMU" <?=(ist($applicant_edu[$i]->edu_title) == 'SMU') ? 'selected' : ''  ?>>SMU</option>                                
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group m-b-0">
                                <div class="form-line">
                                    <input type="date" class="form-control" name="applicant_edu[edu_start][<?=$i?>]" value="<?php echo date('Y-m-d', strtotime($applicant_edu[$i]->edu_start)); ?>">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group m-b-0">
                                <div class="form-line">
                                    <input type="date" class="form-control" name="applicant_edu[edu_end][<?=$i?>]" value="<?php echo date('Y-m-d', strtotime($applicant_edu[$i]->edu_end)); ?>">
                                </div>
                            </div>
                        </td>
                        <td style="width: 30%">
                            <div class="form-group m-b-0">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="applicant_edu[gpa][<?=$i?>]" placeholder="GPA" value="<?php echo $applicant_edu[$i]->gpa ?>">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php 
                }
            }else{
                ?>
                <tr>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <img name="removeEdu" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt=""/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <select id="eduInstitute" name="applicant_edu[edu_institute][]" class="form-control show-tick" data-container="body">
                                    <option value="">- Choose -</option>
                                    <option value="OTHER"> Other </option>
                                    <?php
                                    if (isset($university) and $university != 0) {
                                        foreach ($university as $row) {
                                            ?>
                                            <option value="<?php echo $row->university_name ?>" ><?php echo $row->university_name; ?></option>
                                            <?php 
                                        }
                                    }
                                    ?>        
                                </select>
                                <!-- <input type="text" id="tempInstitute" name="applicant_edu[edu_institute][]" style="display: none;"> -->
                                <input type="hidden" name="applicant_edu[cedu_id][]" value="" >
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="applicant_edu[edu_major][]" placeholder="Major" value="">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <select class="form-control show-tick" name="applicant_edu[edu_title][]" data-container="body">
                                    <option value="">- Choose -</option>
                                    <option value="S2" >S2</option>
                                    <option value="S1" >S1</option>                                  
                                    <option value="D3" >D3</option>                                  
                                    <option value="SMU" >SMU</option>                                
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="date" class="form-control" name="applicant_edu[edu_start][]" value="">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="date" class="form-control" name="applicant_edu[edu_end][]" value="">
                            </div>
                        </div>
                    </td>
                    <td style="width: 30%">
                        <div class="form-group m-b-0">
                            <div class="form-line">
                                <input type="number" class="form-control" name="applicant_edu[gpa][]" placeholder="GPA" value="">
                            </div>
                        </div>
                    </td>
                </tr>
                <?php 
            }
            ?>    
        </tbody>
    </table>
    <label for="idnum" id="addEdu"><img src="<?php echo base_url(); ?>assets/icon/plus.svg" alt=""/>&nbsp;&nbsp;ADD EDUCATIONAL BACKGROUNDS
    </section>
    <h3>Organizational Experiences</h3>
    <section>
        <div class="tile">Organizational Experiences</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="40"></th>
                    <th>Organization Name</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody id="orgContainer" class="workContainer">
                <?php
                if (isset($applicant_organization) and $applicant_organization != 0) {
                    for($i = 0; $i < count($applicant_organization) ; $i++){
                        ?>
                        <tr>
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <img name="removeOrg" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt="" data-id="<?php echo $applicant_organization[$i]->org_id ?>"/>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <input type="hidden" name="applicant_organization[org_id][<?=$i?>]" value="<?php echo $applicant_organization[$i]->org_id ?>">
                                        <input type="text" name="applicant_organization[activities][<?=$i?>]" placeholder="Organization Name" value="<?php echo $applicant_organization[$i]->activities ?>">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <input type="text" name="applicant_organization[org_pos][<?=$i?>]" placeholder="Position" value="<?php echo $applicant_organization[$i]->org_pos ?>">
                                    </div>
                                </div>
                            </td>
                            <?php 
                        }
                    } else {
                        ?>
                        <tr>
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <img name="removeOrg" src="<?php echo base_url(); ?>assets/icon/minus.svg" alt=""/>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <input type="hidden" name="applicant_organization[org_id][]" value="">
                                        <input type="text" name="applicant_organization[activities][]" placeholder="Organization Name" value="">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group m-b-0">
                                    <div class="form-line">
                                        <input type="text" name="applicant_organization[org_pos][]" placeholder="Position" value="">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                </tbody>     
            </table>
            <label for="idnum" id="addOrg"><img src="<?php echo base_url(); ?>assets/icon/plus.svg" alt=""/>&nbsp;&nbsp;ADD ORGANIZATIONAL EXPERIENCES
            </section>
            <h3>Finish</h3>
            <section>
                <div class="tile">Finish</div>
                <?php
                if (isset($applicant_data)) {
                    foreach ($applicant_data as $row) {
                        ?>
                        <img src="<?php echo base_url(); ?>assets/icon/salary.svg" alt=""/>&nbsp;<label for="salary">Expected Salary *</label>
                        <input type="number" name="salary" id="salary" value="<?php echo $row->expect_salary ?>">
                        <img src="<?php echo base_url(); ?>assets/icon/file.svg" alt=""/>&nbsp;<label for="">Why Should We Hire You * (max. 1000 character)</label>
                        <textarea name="describe" id="" cols="30" rows="10"><?php echo $row->candidat_describe ?></textarea>
                        <?php 
                    }
                }
                ?>
            </section>
        </div>
    </form>
</div>
</div>
</div>

<script>var uri = "<?php echo base_url()?>/";</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/waves.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.steps.js"></script>