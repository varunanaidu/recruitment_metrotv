<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	$cnd_id = "";
	$cnd_name = "";
	$cnd_email = "";
	if ( isset($data) and $data != '0' ){
		foreach($data as $row){
			$cnd_id = $row->candidat_id;
			$cnd_name = $row->candidat_name;
			$cnd_email = $row->candidat_email;
		}
	}
?>
	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <ol class="breadcrumb breadcrumb-bg-teal">
					<li><a href="javascript:void(0);"><i class="material-icons">fiber_new</i> New</a></li>
					<li class="active"><a href="javascript:void(0);"><i class="material-icons">person_pin</i> Candidat</a></li>
				</ol>
            </div>
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
							<div class="row clearfix">								
								<!--panel-->
								<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">                                    
                                    <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
										<!-- panel personal information -->
                                        <div class="panel panel-primary">											
											<div class="panel-heading" role="tab" id="headingOne_1">
												<h4 class="panel-title">
													<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1">
														#1. Candidat Personal Information														
													</a>
												</h4>
											</div>											
											<div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1">
												<form method="post" role="form" id="cpi-form">
													<input type="hidden" name="cnd_id_cpi" value="<?php echo $cnd_id?>" />
													<div class="panel-body">
														<div class="row clearfix">
															<!--NAMA-->
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="nama" class="form-control" required placeholder="Enter Name *" value="<?php echo $cnd_name?>" maxlength="150" />
																	</div>
																</div>
															</div>
															<!--Email-->
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="email" name="email" class="form-control" required placeholder="Enter Email *" value="<?php echo $cnd_email?>" readonly="readonly" maxlength="150" />
																	</div>
																</div>
															</div>
														</div>
														<div class="row clearfix">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="ktp" class="form-control" required placeholder="Enter ID Card *" maxlength="50" />
																	</div>
																</div>
															</div>
														</div>
														<!--current address-->
														<div class="row clearfix">
															<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<textarea name="curr_address" class="form-control" placeholder="Enter Current Address *" required style="resize:none;"></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<select name="curr_city" class="form-control show-tick"  data-live-search="true" required>
																			<option value="">- Choose Current City * -</option>
																			<?php
																				if ( isset($data_city) and $data_city != '0' ){
																					foreach($data_city as $row){
																						echo "<option value=\"{$row->nama_kota}\">{$row->nama_kota}</option>";
																					}
																				}
																			?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="curr_zipcode" class="form-control" placeholder="Enter Postal Code *" required maxlength="10" />
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="curr_phone" class="form-control" placeholder="Enter Phone *" required maxlength="20" />
																	</div>
																</div>
															</div>
														</div>
														<!--#current address-->
														<!--permanent address-->
														<div class="row clearfix">
															<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<textarea name="per_address" class="form-control" placeholder="Enter Permanent Address *" required style="resize:none;"></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<select name="per_city" class="form-control show-tick"  data-live-search="true" required>
																			<option value="">- Choose Permanent City * -</option>
																			<?php
																				if ( isset($data_city) and $data_city != '0' ){
																					foreach($data_city as $row){
																						echo "<option value=\"{$row->nama_kota}\">{$row->nama_kota}</option>";
																					}
																				}
																			?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="per_zipcode" class="form-control" placeholder="Enter Postal Code *" required maxlength="10" />
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="per_phone" class="form-control" placeholder="Enter Phone *" required maxlength="20" />
																	</div>
																</div>
															</div>
														</div>
														<!--#permanent address-->
														<div class="row clearfix">
															<!-- Phone -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="hp" class="form-control" placeholder="Enter Mobile Phone *" required maxlength="50" />
																	</div>
																</div>
															</div>
															<!-- POB -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="pob" class="form-control" placeholder="Enter Place of Birth *" required />
																	</div>
																</div>
															</div>
															<!-- DOB -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="dob" class="form-control dpicker" placeholder="Choose Date of Birth *" required readonly="readonly" />
																	</div>
																</div>
															</div>
															<!-- AGAMA -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<select name="agama" class="form-control show-tick" required>
																			<option value="">- Choose Religion * -</option>
																			<option value="I">Islam</option>
																			<option value="H">Hindu</option>
																			<option value="B">Budha</option>
																			<option value="K">Katolik</option>
																			<option value="P">Protestan</option>
																		</select>
																	</div>
																</div>
															</div>
															<!-- GOLONGAN DARAH -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<select name="gol_darah" class="form-control show-tick">
																			<option value="">- Choose Blood Type -</option>
																			<option value="A">A</option>
																			<option value="B">B</option>
																			<option value="AB">AB</option>
																			<option value="O">O</option>
																		</select>
																	</div>
																</div>
															</div>
															<!-- KEBANGSAAN -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<select name="nation" class="form-control show-tick" required>
																			<option value="">- Choose Nationality * -</option>
																			<option value="WNI">WNI</option>
																			<option value="WNA">WNA</option>
																		</select>
																	</div>
																</div>
															</div>
															<!-- JENIS KELAMIN -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<select name="gender" class="form-control show-tick" required>
																			<option value="">- Choose Gender * -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</div>
																</div>
															</div>
															<!-- BERAT -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="number" name="berat" class="form-control" placeholder="Enter Weight *" min="1" required />
																	</div>
																</div>
															</div>
															<!-- TINGGI -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="number" name="tinggi" class="form-control" placeholder="Enter Height *" min="1" required />
																	</div>
																</div>
															</div>														
															<!-- STATUS MERIT -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<select name="status_married" id="status_married" class="form-control show-tick" required>
																			<option value="">- Choose Marital Status * -</option>
																			<option value="Single">Single</option>
																			<option value="Married">Married</option>
																		</select>
																	</div>
																</div>
															</div>
															<!-- TANGGAL PERNIKAHAN -->
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 collapse for-married">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="married_date" class="form-control dpicker" placeholder="Choose Marital Date *" readonly="readonly" />
																	</div>
																</div>
															</div>
														</div>
														<!-- if married -->
														<div class="row clearfix for-married collapse">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																<h4>Spouse (If married)</h4>															
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="spouse_name" class="form-control" placeholder="Spouse Name *" />
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="spouse_dob" class="form-control dpicker" readonly="readonly" placeholder="Date of Birth *" />
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="spouse_edu" class="form-control" placeholder="Education *" />
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="spouse_occu" class="form-control" placeholder="Occupation *" />
																	</div>
																</div>
															</div>
														</div>
														<!--button save and update cpi -->
														<div class="row clearfix">
															<div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5 col-xs-2 col-xs-offset-2">
																<button type="submit" class="btn btn-primary" id="btn-cpi">Save & Update</button>
															</div>
														</div>
													</div>
												</form>
											</div>											
                                        </div>
										<!-- panel family information -->
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingTwo_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false"
                                                       aria-controls="collapseTwo_1">
                                                        #2. Candidat Family Information
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_1">
												<form method="POST" id="cfi-form" role="form">
													<input type="hidden" name="cnd_id_cfi" value="<?php echo $cnd_id?>" />
													<div class="panel-body">
														<!-- children -->
														<table class="table table-bordered table-striped table-hover">
															<thead>
																<tr>
																	<th>#</th>
																	<th><label>Children</label></th>
																	<th><label>Date of Birth</label></th>
																	<th><label>Sex</label></th>
																	<th><label>Education</label></th>
																</tr>																
															</thead>
															<tbody>
																<tr>
																	<td>1.</td>
																	<td><input type="text" name="child_name[]" class="form-control" /></td>
																	<td><input type="text" name="child_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="child_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="child_edu[]" class="form-control" /></td>
																</tr>
																<tr>
																	<td>2.</td>
																	<td><input type="text" name="child_name[]" class="form-control" /></td>
																	<td><input type="text" name="child_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="child_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="child_edu[]" class="form-control" /></td>
																</tr>
																<tr>
																	<td>3.</td>
																	<td><input type="text" name="child_name[]" class="form-control" /></td>
																	<td><input type="text" name="child_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="child_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="child_edu[]" class="form-control" /></td>
																</tr>
																<tr>
																	<td>4.</td>
																	<td><input type="text" name="child_name[]" class="form-control" /></td>
																	<td><input type="text" name="child_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="child_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="child_edu[]" class="form-control" /></td>
																</tr>
															</tbody>
														</table>
														<br />
														<!-- parents, siblings -->
														<table class="table table-bordered table-striped table-hover">
															<thead>
																<tr>
																	<th>#</th>
																	<th><label>Family (parents, siblings)</label></th>
																	<th><label>Relation</label></th>
																	<th><label>Date of Birth</label></th>
																	<th><label>Sex</label></th>
																	<th><label>Education</label></th>
																</tr>																
															</thead>
															<tbody>
																<tr>
																	<td>1.</td>
																	<td><input type="text" name="family_name[]" class="form-control" /></td>
																	<td>
																		<select name="family_relation[]" class="form-control show-tick">
																			<option value="">- Choose Family Relationship -</option>
																			<option value="PARENT">Parent</option>
																			<option value="SIBLING">Siblings</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="family_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_edu[]" class="form-control" /></td>
																</tr>
																<tr>
																	<td>2.</td>
																	<td><input type="text" name="family_name[]" class="form-control" /></td>
																	<td>
																		<select name="family_relation[]" class="form-control show-tick">
																			<option value="">- Choose Family Relationship -</option>
																			<option value="PARENT">Parent</option>
																			<option value="SIBLING">Siblings</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="family_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_edu[]" class="form-control" /></td>
																</tr>
																<tr>
																	<td>3.</td>
																	<td><input type="text" name="family_name[]" class="form-control" /></td>
																	<td>
																		<select name="family_relation[]" class="form-control show-tick">
																			<option value="">- Choose Family Relationship -</option>
																			<option value="PARENT">Parent</option>
																			<option value="SIBLING">Siblings</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="family_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_edu[]" class="form-control" /></td>
																</tr>
																<tr>
																	<td>4.</td>
																	<td><input type="text" name="family_name[]" class="form-control" /></td>
																	<td>
																		<select name="family_relation[]" class="form-control show-tick">
																			<option value="">- Choose Family Relationship -</option>
																			<option value="PARENT">Parent</option>
																			<option value="SIBLING">Siblings</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="family_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_edu[]" class="form-control" /></td>
																</tr>
																<tr>
																	<td>5.</td>
																	<td><input type="text" name="family_name[]" class="form-control" /></td>
																	<td>
																		<select name="family_relation[]" class="form-control show-tick">
																			<option value="">- Choose Family Relationship -</option>
																			<option value="PARENT">Parent</option>
																			<option value="SIBLING">Siblings</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="family_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_edu[]" class="form-control" /></td>
																</tr>
																<tr>
																	<td>6.</td>
																	<td><input type="text" name="family_name[]" class="form-control" /></td>
																	<td>
																		<select name="family_relation[]" class="form-control show-tick">
																			<option value="">- Choose Family Relationship -</option>
																			<option value="PARENT">Parent</option>
																			<option value="SIBLING">Siblings</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_dob[]" class="form-control dpicker" readonly="readonly" /></td>
																	<td>
																		<select name="family_gender[]" class="form-control show-tick">
																			<option value="">- Choose Gender -</option>
																			<option value="M">Men</option>
																			<option value="F">Women</option>
																		</select>
																	</td>
																	<td><input type="text" name="family_edu[]" class="form-control" /></td>
																</tr>
															</tbody>
														</table>
														<!--button save and update cfi -->
														<div class="row clearfix">
															<div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5 col-xs-2 col-xs-offset-2">
																<button type="submit" class="btn btn-primary" id="btn-cfi">Save & Update</button>
															</div>
														</div>
													</div>
												</form>
                                            </div>
                                        </div>
										<!--panel education information -->
                                        <div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingThree_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseThree_1" aria-expanded="false"
                                                       aria-controls="collapseThree_1">
                                                        #3. Candidat Education Information
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1">
												<form method="POST" role="form" id="cei-form">
													<input type="hidden" name="cnd_id_cei" value="<?php echo $cnd_id?>" />
													<div class="panel-body">
														<h4>Formal Education</h4>
														<table class="table table-bordered table-striped table-hover">
															<thead>
																<tr>
																	<th>#</th>
																	<th><label>School / Institution</label></th>
																	<th><label>Major</label></th>
																	<th><label>Start(From-to)</label></th>
																	<th><label>Remark/GPA</label></th>
																</tr>																
															</thead>
															<tbody>
																<tr>
																	<td><input type="hidden" name="edu_title[]" value="S2" />S2</td>
																	<td><input type="text" name="edu_school_name[]" maxlength="150" class="form-control" /></td>
																	<td><input type="text" name="edu_major[]" maxlength="100" class="form-control" /></td>
																	<td><input type="text" name="edu_date[]" readonly="readonly" class="form-control edu-picker" /></td>
																	<td><input type="text" name="edu_remark[]" maxlength="100" class="form-control" /></td>
																</tr>
																<tr>
																	<td><input type="hidden" name="edu_title[]" value="S1" />S1</td>
																	<td><input type="text" name="edu_school_name[]" maxlength="150" class="form-control" /></td>
																	<td><input type="text" name="edu_major[]" maxlength="100" class="form-control" /></td>
																	<td><input type="text" name="edu_date[]" readonly="readonly" class="form-control edu-picker" /></td>
																	<td><input type="text" name="edu_remark[]" maxlength="100" class="form-control" /></td>
																</tr>
																<tr>
																	<td><input type="hidden" name="edu_title[]" value="D3" />D3</td>
																	<td><input type="text" name="edu_school_name[]" maxlength="150" class="form-control" /></td>
																	<td><input type="text" name="edu_major[]" maxlength="100" class="form-control" /></td>
																	<td><input type="text" name="edu_date[]" readonly="readonly" class="form-control edu-picker" /></td>
																	<td><input type="text" name="edu_remark[]" maxlength="100" class="form-control" /></td>
																</tr>
																<tr>
																	<td><input type="hidden" name="edu_title[]" value="SMU" />SMU</td>
																	<td><input type="text" name="edu_school_name[]" maxlength="150" class="form-control" /></td>
																	<td><input type="text" name="edu_major[]" maxlength="100" class="form-control" /></td>
																	<td><input type="text" name="edu_date[]" readonly="readonly" class="form-control edu-picker" /></td>
																	<td><input type="text" name="edu_remark[]" maxlength="100" class="form-control" /></td>
																</tr>
															</tbody>
														</table>
														<br />
														<h4>Informal Education</h4>
														<table class="table table-bordered table-striped table-hover">
															<thead>
																<tr>
																	<th>#</th>
																	<th><label>Training</label></th>
																	<th><label>Certification / Proficiency</label></th>
																	<th><label>Year</label></th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1.</td>
																	<td><input type="text" name="training_name[]" maxlength="200" class="form-control" /></td>
																	<td><input type="text" name="training_cert[]" maxlength="200" class="form-control" /></td>
																	<td>
																		<select name="training_year[]" class="form-control show-tick" data-live-search="true">
																			<option value="">- Choose Year -</option>
																			<?php
																				for($i = 1980; $i <= date('Y'); $i++)
																					echo "<option value=\"{$i}\">{$i}</option>";
																			?>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td>2.</td>
																	<td><input type="text" name="training_name[]" maxlength="200" class="form-control" /></td>
																	<td><input type="text" name="training_cert[]" maxlength="200" class="form-control" /></td>
																	<td>
																		<select name="training_year[]" class="form-control show-tick" data-live-search="true">
																			<option value="">- Choose Year -</option>
																			<?php
																				for($i = 1980; $i <= date('Y'); $i++)
																					echo "<option value=\"{$i}\">{$i}</option>";
																			?>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td>3.</td>
																	<td><input type="text" name="training_name[]" maxlength="200" class="form-control" /></td>
																	<td><input type="text" name="training_cert[]" maxlength="200" class="form-control" /></td>
																	<td>
																		<select name="training_year[]" class="form-control show-tick" data-live-search="true">
																			<option value="">- Choose Year -</option>
																			<?php
																				for($i = 1980; $i <= date('Y'); $i++)
																					echo "<option value=\"{$i}\">{$i}</option>";
																			?>
																		</select>
																	</td>
																</tr>
															</tbody>
														</table>
														<br />
														<h4>Foreign Language Skills</h4>
														<table class="table table-bordered table-striped table-hover">
															<thead>
																<tr>
																	<th rowspan="2">#</th>
																	<th rowspan="2"><label>Language</label></th>
																	<th colspan="2"><label>Capabilities</label></th>
																	<th colspan="2"><label>TOEFL</label></th>																	
																</tr>
																<tr>																	
																	<th><label>Spoken</label></th>
																	<th><label>Written</label></th>
																	<th><label>Score</label></th>
																	<th><label>Year</label></th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1.</td>
																	<td><input type="text" name="lang_name[]" maxlength="50" class="form-control" /></td>
																	<td>
																		<select name="lang_spoken[]" class="form-control show-tick">
																			<option value="">- Choose Spoken -</option>
																			<option value="Basic">Basic</option>
																			<option value="Intermediate">Intermediate</option>
																			<option value="Advance">Advance</option>
																		</select>
																	</td>
																	<td>
																		<select name="lang_written[]" class="form-control show-tick">
																			<option value="">- Choose Written -</option>
																			<option value="Basic">Basic</option>
																			<option value="Intermediate">Intermediate</option>
																			<option value="Advance">Advance</option>
																		</select>
																	</td>
																	<td><input type="number" name="toefl_score[]" min="1" class="form-control" /></td>
																	<td>
																		<select name="toefl_year[]" class="form-control show-tick" data-live-search="true">
																			<option value="">- Choose Year -</option>
																			<?php
																				for($i = 1980; $i <= date('Y'); $i++)
																					echo "<option value=\"{$i}\">{$i}</option>";
																			?>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td>2.</td>
																	<td><input type="text" name="lang_name[]" maxlength="50" class="form-control" /></td>
																	<td>
																		<select name="lang_spoken[]" class="form-control show-tick">
																			<option value="">- Choose Spoken -</option>
																			<option value="Basic">Basic</option>
																			<option value="Intermediate">Intermediate</option>
																			<option value="Advance">Advance</option>
																		</select>
																	</td>
																	<td>
																		<select name="lang_written[]" class="form-control show-tick">
																			<option value="">- Choose Written -</option>
																			<option value="Basic">Basic</option>
																			<option value="Intermediate">Intermediate</option>
																			<option value="Advance">Advance</option>
																		</select>
																	</td>
																	<td><input type="number" name="toefl_score[]" min="1" class="form-control" /></td>
																	<td>
																		<select name="toefl_year[]" class="form-control show-tick" data-live-search="true">
																			<option value="">- Choose Year -</option>
																			<?php
																				for($i = 1980; $i <= date('Y'); $i++)
																					echo "<option value=\"{$i}\">{$i}</option>";
																			?>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td>3.</td>
																	<td><input type="text" name="lang_name[]" maxlength="50" class="form-control" /></td>
																	<td>
																		<select name="lang_spoken[]" class="form-control show-tick">
																			<option value="">- Choose Spoken -</option>
																			<option value="Basic">Basic</option>
																			<option value="Intermediate">Intermediate</option>
																			<option value="Advance">Advance</option>
																		</select>
																	</td>
																	<td>
																		<select name="lang_written[]" class="form-control show-tick">
																			<option value="">- Choose Written -</option>
																			<option value="Basic">Basic</option>
																			<option value="Intermediate">Intermediate</option>
																			<option value="Advance">Advance</option>
																		</select>
																	</td>
																	<td><input type="number" name="toefl_score[]" min="1" class="form-control" /></td>
																	<td>
																		<select name="toefl_year[]" class="form-control show-tick" data-live-search="true">
																			<option value="">- Choose Year -</option>
																			<?php
																				for($i = 1980; $i <= date('Y'); $i++)
																					echo "<option value=\"{$i}\">{$i}</option>";
																			?>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td>4.</td>
																	<td><input type="text" name="lang_name[]" maxlength="50" class="form-control" /></td>
																	<td>
																		<select name="lang_spoken[]" class="form-control show-tick">
																			<option value="">- Choose Spoken -</option>
																			<option value="Basic">Basic</option>
																			<option value="Intermediate">Intermediate</option>
																			<option value="Advance">Advance</option>
																		</select>
																	</td>
																	<td>
																		<select name="lang_written[]" class="form-control show-tick">
																			<option value="">- Choose Written -</option>
																			<option value="Basic">Basic</option>
																			<option value="Intermediate">Intermediate</option>
																			<option value="Advance">Advance</option>
																		</select>
																	</td>
																	<td><input type="number" name="toefl_score[]" min="1" class="form-control" /></td>
																	<td>
																		<select name="toefl_year[]" class="form-control show-tick" data-live-search="true">
																			<option value="">- Choose Year -</option>
																			<?php
																				for($i = 1980; $i <= date('Y'); $i++)
																					echo "<option value=\"{$i}\">{$i}</option>";
																			?>
																		</select>
																	</td>
																</tr>
															</tbody>
														</table>
														<!--button save and update cei -->
														<div class="row clearfix">
															<div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5 col-xs-2 col-xs-offset-2">
																<button type="submit" class="btn btn-primary" id="btn-cei">Save & Update</button>
															</div>
														</div>
													</div>
												</form>
                                            </div>
                                        </div>
										<!-- panel employment background -->
										<div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingFour_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseFour_1" aria-expanded="false"
                                                       aria-controls="collapseFour_1">
                                                        #4. Candidat Employment Background
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour_1">
												<form method="POST" role="form" id="ceb-form">
													<input type="hidden" name="cnd_id_ceb" value="<?php echo $cnd_id?>" />
													<div class="panel-body">
														<h4>Employment Background</h4>
														<div class="row clearfix">
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_date[]" readonly="readonly" placeholder="From-To" class="form-control work-picker" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_company[]" placeholder="Company" class="form-control" maxlength="200" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_position[]" placeholder="Position" class="form-control" maxlength="150" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_report[]" placeholder="Report To" class="form-control" maxlength="100" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="number" name="employee_salary[]" placeholder="Last Salary" class="form-control" min="1" />
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<textarea name="job_desc[]" placeholder="Job Description" class="form-control" style="resize:none;"></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<textarea name="reason_leaving[]" placeholder="Reason Leaving" class="form-control" style="resize:none;"></textarea>
																	</div>
																</div>
															</div>
														</div>
														<hr />
														<div class="row clearfix">
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_date[]" readonly="readonly" placeholder="From-To" class="form-control work-picker" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_company[]" placeholder="Company" class="form-control" maxlength="200" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_position[]" placeholder="Position" class="form-control" maxlength="150" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_report[]" placeholder="Report To" class="form-control" maxlength="100" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="number" name="employee_salary[]" placeholder="Last Salary" class="form-control" min="1" />
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<textarea name="job_desc[]" placeholder="Job Description" class="form-control" style="resize:none;"></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<textarea name="reason_leaving[]" placeholder="Reason Leaving" class="form-control" style="resize:none;"></textarea>
																	</div>
																</div>
															</div>
														</div>
														<hr />
														<div class="row clearfix">
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_date[]" readonly="readonly" placeholder="From-To" class="form-control work-picker" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_company[]" placeholder="Company" class="form-control" maxlength="200" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_position[]" placeholder="Position" class="form-control" maxlength="150" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="text" name="employee_report[]" placeholder="Report To" class="form-control" maxlength="100" />
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<input type="number" name="employee_salary[]" placeholder="Last Salary" class="form-control" min="1" />
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<textarea name="job_desc[]" placeholder="Job Description" class="form-control" style="resize:none;"></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<div class="form-line">
																		<textarea name="reason_leaving[]" placeholder="Reason Leaving" class="form-control" style="resize:none;"></textarea>
																	</div>
																</div>
															</div>
														</div>
														<!--button save and update cei -->
														<div class="row clearfix">
															<div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5 col-xs-2 col-xs-offset-2">
																<button type="submit" class="btn btn-primary" id="btn-ceb">Save & Update</button>
															</div>
														</div>
													</div>
												</form>
                                            </div>
                                        </div>
										<!-- panel X -->
										<div class="panel panel-primary">
                                            <div class="panel-heading" role="tab" id="headingFive_1">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseFive_1" aria-expanded="false"
                                                       aria-controls="collapseFive_1">
                                                        #5. Additional Information
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFive_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive_1">
												<form method="POST" role="form" id="ai-form">
													<input type="hidden" name="cnd_id_ai" value="<?php echo $cnd_id?>" />
													<div class="panel-body">														
														<div class="row clearfix">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																<div class="form-line">										
																	<select name="vacant" id="vacant" class="form-control show-tick">
																		<option value="">- Choose Vacancy-</option>
																		<?php
																			if ( isset($data_vacant) and $data_vacant != '0' ){
																				foreach($data_vacant as $row)
																					echo "<option value=\"{$row->vacant_id}\">{$row->vacant_title} ({$row->a} s/d {$row->b})</option>";
																			}
																		?>
																	</select>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="dropzone" id="dz_file">
																	<div class="dz-message">
																		<div class="m-t-10 strong">Drop your CV here or click to upload.</div>
																		<div class="m-t-10 strong">Allowed file extension : docx, doc, pdf</div>
																	</div>
																	<div class="fallback">
																		<input name="fc_drop_file" type="file">
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="dropzone" id="dz_photo">
																	<div class="dz-message">
																		<div class="m-t-10 strong">Drop your foto here or click to upload.</div>
																		<div class="m-t-10 strong">Allowed file extension : jpg, jpeg, png</div>
																	</div>
																	<div class="fallback">
																		<input name="fc_drop_photo" type="file">
																	</div>
																</div>
															</div>
														</div>
														<!--button save and update ai -->
														<div class="row clearfix">
															<div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5 col-xs-2 col-xs-offset-2">
																<button type="submit" class="btn btn-primary" id="btn-ai">Save & Update</button>
															</div>
														</div>
													</div>
												</form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<!--panel-->
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </section>
	<script>var base_url = "<?php echo base_url().SYS_AUTH?>/";</script>
    <!-- Jquery Core Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/node-waves/waves.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url()?>media/backend/plugins/sweetalert/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url()?>media/backend/js/admin.js"></script>
	<script src="<?php echo base_url()?>media/backend/js/pages/applicant/new-candidat.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
    <!-- Demo Js -->
    <script src="<?php echo base_url()?>media/backend/js/demo.js"></script>