<!DOCTYPE html>
<html lang="en">
<?php 
$title_name = 'Subscribe'; 
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('assets/images/project91_Round_logo.png');?>">
    <title>Study Allocator | <?php echo $title_name; ?> | project91</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/bootstrap/dist/css/bootstrap.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/perfect-scrollbar/css/perfect-scrollbar.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/sweetalert/sweetalert.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/select2/dist/css/select2.min.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/fullcalendar/fullcalendar.min.css');?>"> 
    <!-- Style-->  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/css/checkbox_style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/css/skin_color.css');?>">
    <!--custom css-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/css/lib/control/iconselect.css');?>">
    <!--custom css-->
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script> 
</head>
<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">
	<div id="loader"></div>

<?php
include 'nav_header.php';
include 'sidebar.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		</div>  

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-xl-9 col-lg-8 col-12">
			</div>
			<div class="col-xl-3 col-12">
				<?php
				include 'right_sidebar.php';
				?>
			</div>
	  </div>	
	</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
<?php
include 'footer_bar.php';
?>

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Modal -->
  <div class="modal fade bs-example-modal-lg" data-backdrop="static" data-keyboard="false"data-backdrop="static" id="modal-profile" tabindex="-1">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Update Your Profile</h5>
			<a href="javascript:void(0);" title="Logout" class="close" onclick="logout();"><i class="fa fa-sign-out text-dark mr-2"></i></a>
		  </div>
		  <form method="POST" name="module_profile_form" id="module_profile_form" class="module_profile_form" autocomplete="off" enctype="multipart/form-data">
		  	<input type="hidden" name="profile_visit_id" id="profile_visit_id" value="2">
		  	<div class="modal-body" style="background-color: #fafbfd;">		
			<div class="box-body">
				<div class="row">
				<div class="col-md-4">
				<div class="form-group">
					<label>First Name <span class="text-danger">*</span></label>
					<div class="input-group mb-3">
						<input type="text" name="first_name" id="first_name" value="<?php if($stud_del->first_name){ echo $stud_del->first_name; } ?>" class="form-control" placeholder="First Name" required="">
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-user"></i></span>
						</div>
					</div>
					<span id="first_nameErr" class="text-danger"></span>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group">
					<label>Middle Name</label>
					<div class="input-group mb-3">
						<input type="text" name="middle_name" id="middle_name" value="<?php if($stud_del->middle_name){ echo $stud_del->middle_name; } ?>" class="form-control" placeholder="Middle Name">
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-user"></i></span>
						</div>
					</div>
					<span id="middle_nameErr" class="text-danger"></span>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group">
					<label>Last Name <span class="text-danger">*</span></label>
					<div class="input-group mb-3">
						<input type="text" name="last_name" id="last_name" value="<?php if($stud_del->last_name){ echo $stud_del->last_name; } ?>" class="form-control" placeholder="Last Name" required="">
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-user"></i></span>
						</div>
					</div>
					<span id="last_nameErr" class="text-danger"></span>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label>Email Address <span class="text-danger">*</span></label>
					<div class="input-group mb-3">
						<input type="text" name="email_address" id="email_address" value="<?php if($stud_del->email_address){ echo $stud_del->email_address; } ?>" class="form-control" placeholder="Email Address" readonly="" required="">
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-email"></i></span>
						</div>
					</div>
					<span id="email_addressErr" class="text-danger"></span>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label>Module <span class="text-danger">*</span></label>
					<div class="input-group mb-3">
						<?php
						if($stud_mod){
							foreach ($stud_mod as $sm) {
								$mod_del = $this->Front_model->getModuleById($sm->module_id);
								?>
								<input type="text" value="<?php if($mod_del->names){ echo $mod_del->names; } ?>" class="form-control" placeholder="Module" readonly="" required="" disabled="">
								<?php
							}
						}
						?>
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-view-grid"></i></span>
						</div>
					</div>
					<span id="moduleErr" class="text-danger"></span>
				</div>
				</div>
				</div>
				<div class="form-group">
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					<label>Gender</label>
						<div class="c-inputs-stacked">
							<input onclick="return showOtherGender(1,this.value);" name="gender" type="radio" id="male" value="male" <?php if($stud_del->gender == 'male'){ echo 'checked'; } ?>>
							<label for="male" class="mr-30">Male</label>
							<input onclick="return showOtherGender(2,this.value);" name="gender" type="radio" id="female" value="female" <?php if($stud_del->gender == 'female'){ echo 'checked'; } ?>>
							<label for="female" class="mr-30">Female</label>
							<input onclick="return showOtherGender(3,this.value);" name="gender" type="radio" id="other" value="other" <?php if($stud_del->gender == 'other'){ echo 'checked'; } ?>>
							<label for="other" class="mr-30">Other</label>
							<input onclick="return showOtherGender(4,this.value);" name="gender" type="radio" id="not_prefer" value="not_prefer" <?php if($stud_del->gender == 'not_prefer'){ echo 'checked'; } ?>>
							<label for="not_prefer" class="mr-30">Prefer not to say</label>
						</div>
						<span id="genderErr" class="text-danger"></span>
					</div>
					</div>
				</div>
				<div class="row" id="other_gender" <?php if($stud_del->gender == 'other'){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?>>
				<div class="col-md-6">
				<div class="form-group">
					<div class="input-group mb-3">
						<input type="text" name="gender_other" id="gender_other" value="<?php if($stud_del->gender_other){ echo $stud_del->gender_other; } ?>" class="form-control" placeholder="Other Gender">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fa fa-transgender"></i></span>
						</div>
					</div>
					<span id="gender_otherErr" class="text-danger"></span>
				</div>
				</div>
				</div>
				</div>
				<div class="form-group">
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
					<label>Phone Number <span class="text-danger">*</span></label>
					<div class="input-group mb-3">
						<input class="form-control" type="text" name="phone_number" id="phone_number" value="<?php if($stud_del->phone_number){ echo $stud_del->phone_number; } ?>" required>
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-mobile"></i></span>
						</div>
					</div>
					<span id="phone_numberErr" class="text-danger"></span>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
					<label>DOB</label>
					<div class="input-group mb-3">
						<input class="form-control" type="date" name="dob" id="dob" value="<?php if($stud_del->dob){ echo $stud_del->dob; } ?>" >
					</div>
					<span id="dobErr" class="text-danger"></span>
					</div>
					</div>
				</div>
				</div>
				<div class="form-group">
				<label>HOW DID YOU HEAR ABOUT US ?</label>
				<?php 
				if($hear_from){
					$hf_cnt=1;
					foreach ($hear_from as $hf) {
						if($hf->name != 'Other'){
							?>
						<div class="radio">
							<input onchange="showUniversity(<?php echo $hf_cnt;?>,this.value);" name="hear_from" type="radio" value="<?php echo $hf->name;?>" id="Option_<?php echo $hf_cnt;?>" <?php if($stud_del->hear_from == $hf->name){ echo 'checked'; } ?>>
							<label for="Option_<?php echo $hf_cnt;?>"><?php echo $hf->name;?></label>
						</div>
						<?php
						if($hf->name == 'University referral'){
							?>
						<div class="row" id="university_div" <?php if($stud_del->hear_from == 'University referral'){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?>>
							<div class="col-md-12">
							<div class="form-group">
								<div class="input-group mb-3">
									<select onchange="showOtherUniv(this.value);" name="university" id="university" value="" class="form-control select2" style="width: 95%;">
										<option value="">Select University</option>
										<?php											
										if($schools){
											foreach ($schools as $sch) {
												?>
												<option value="<?php echo $sch->id; ?>" <?php if($stud_del->university == $sch->id){ echo 'selected'; } ?>><?php echo $sch->names; ?></option>
												<?php
											}
											?><option value="9999" <?php if($stud_del->university == '9999'){ echo 'selected'; } ?>>Other</option><?php
										}
										?>
									</select>
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-medall-alt"></i></span>
									</div>
								</div>
								<span id="universityErr" class="text-danger"></span>
							</div>
							</div>
							</div>
							<div class="row" id="other_university" <?php if($stud_del->university == '9999'){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?>>
							<div class="col-md-12">
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="text" name="university_other" id="university_other" value="<?php if($stud_del->university_other){ echo $stud_del->university_other; } ?>" class="form-control" placeholder="Other University">
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-medall-alt"></i></span>
									</div>
								</div>
								<span id="university_otherErr" class="text-danger"></span>
							</div>
							</div>
							</div>
							<?php
							}
						}else if($hf->name == 'Other'){
							?>
							<div class="row">
							<div class="col-lg-12">
							  <div class="input-group">
									<span class="input-group-addon">
									  <input onchange="showUniversity(<?php echo $hf_cnt;?>,this.value);" name="hear_from" type="radio" value="Other" id="addon_Option_1" <?php if($stud_del->hear_from == 'Other'){ echo 'checked'; } ?>>
									  <label for="addon_Option_1" style="padding-left: 20px;height: 13px;"></label>
									</span>
								<input type="text" name="hear_from_other" id="hear_from_other" value="<?php if($stud_del->hear_from_other){ echo $stud_del->hear_from_other; } ?>" class="form-control" placeholder="Other">
							  </div>
							  <!-- /input-group -->
							</div>
							<!-- /.col-lg-6 -->
						  </div>
						  <span id="hear_from_otherErr" class="text-danger"></span>
							<?php
						}
						$hf_cnt++;
					}
				}
				?>
				<span id="hear_fromErr" class="text-danger"></span>
			</div>
				<?php
				if($allocator_mod > 0){
					//if taken scheduler module start
				?>							
				<div class="row">
				<div class="col-md-12">
				<div class="form-group">
					<label>WHAT MEDICAL SCHOOL DID YOU ATTEND <span class="text-danger">*</span></label>
					<div class="input-group mb-3">
						<select onchange="showOtherbox(this.value);" name="school_attend" id="school_attend" value="" class="form-control select2" style="width: 95%;" required>
							<option value="">Select School</option>
							<?php							
							if($schools){
								foreach ($schools as $sch) {
									?>
									<option value="<?php echo $sch->id; ?>" <?php if($stud_del->school_attend == $sch->id){ echo 'selected'; } ?>><?php echo $sch->names; ?></option>
									<?php
								}
								?><option value="9999" <?php if($stud_del->school_attend == '9999'){ echo 'selected'; } ?>>Other</option><?php
							}
							?>
						</select>
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-medall-alt"></i></span>
						</div>
					</div>
					<span id="school_attendErr" class="text-danger"></span>
				</div>
				</div>
				</div>
				<div class="row" id="other_school" <?php if($stud_del->school_attend == '9999'){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?>>
				<div class="col-md-12">
				<div class="form-group">
					<div class="input-group mb-3">
						<input type="text" name="school_attend_other" id="school_attend_other" value="<?php if($stud_del->school_attend_other){ echo $stud_del->school_attend_other; } ?>" class="form-control" placeholder="Other School Name">
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-medall-alt"></i></span>
						</div>
					</div>
					<span id="school_attend_otherErr" class="text-danger"></span>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label>HAVE YOU GRADUATED? IF SO, WHEN? <span class="text-danger">*</span></label>
						<div class="c-inputs-stacked">
							<input name="is_graduated" type="radio" id="is_graduated_yes" value="yes" required <?php if($stud_del->is_graduated == 'yes'){ echo 'checked'; } ?>>
							<label for="is_graduated_yes" class="mr-30">Yes</label>
							<input name="is_graduated" type="radio" id="is_graduated_no" value="no" <?php if($stud_del->is_graduated == 'no'){ echo 'checked'; } ?>>
							<label for="is_graduated_no" class="mr-30">No</label>
						</div>
						<span id="is_graduatedErr" class="text-danger"></span>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label>If yes, when?</label>
					<div class="input-group mb-3">
						<input type="date" name="graduated_when" id="graduated_when" value="<?php if($stud_del->graduated_when){ echo $stud_del->graduated_when; } ?>" class="form-control">
					</div>
					<span id="graduated_whenErr" class="text-danger"></span>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label>HAVE YOU TAKEN THE USMLE EXAMS BEFORE: <span class="text-danger">*</span></label>
						<div class="c-inputs-stacked">
							<input name="usmle_before" type="radio" id="usmle_before_yes" value="yes" required <?php if($stud_del->usmle_before == 'yes'){ echo 'checked'; } ?>>
							<label for="usmle_before_yes" class="mr-30">Yes</label>
							<input name="usmle_before" type="radio" id="usmle_before_no" value="no" <?php if($stud_del->usmle_before == 'no'){ echo 'checked'; } ?>>
							<label for="usmle_before_no" class="mr-30">No</label>
						</div>
						<span id="usmle_beforeErr" class="text-danger"></span>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label>If yes, when?</label>
					<div class="input-group mb-3">
						<input type="date" name="usmle_when" id="usmle_when" value="<?php if($stud_del->usmle_when){ echo $stud_del->usmle_when; } ?>" class="form-control">
					</div>
					<span id="usmle_whenErr" class="text-danger"></span>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="form-group">
					<label>HAVE YOU TAKEN PART IN ANY OTHER REVIEW PROGRAMS: <span class="text-danger">*</span></label>
						<div class="c-inputs-stacked">
							<input name="review_programs" type="radio" id="review_programs_yes" value="yes" required <?php if($stud_del->review_programs == 'yes'){ echo 'checked'; } ?>>
							<label for="review_programs_yes" class="mr-30">Yes</label>
							<input name="review_programs" type="radio" id="review_programs_no" value="no" <?php if($stud_del->review_programs == 'no'){ echo 'checked'; } ?>>
							<label for="review_programs_no" class="mr-30">No</label>
						</div>
						<span id="review_programsErr" class="text-danger"></span>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label>If yes, which one(s) and when:</label>
					<div class="input-group mb-3">
						<input type="date" name="review_programs_when" id="review_programs_when" value="<?php if($stud_del->review_programs_when){ echo $stud_del->review_programs_when; } ?>" class="form-control">
					</div>
					<span id="review_programs_whenErr" class="text-danger"></span>
					<div class="input-group mb-3">
						<input type="text" name="review_programs_which" id="review_programs_which" value="<?php if($stud_del->review_programs_which){ echo $stud_del->review_programs_which; } ?>" placeholder="Which one" class="form-control">
						<div class="input-group-append">
							<span class="input-group-text"><i class="ti-hand-open"></i></span>
						</div>
					</div>
					<span id="review_programs_whichErr" class="text-danger"></span>
				</div>
				</div>
				</div>
				<?php
				//if taken scheduler module end
				}else{
					//if not taken scheduler module start
				?>
				<input type="hidden" name="school_attend" id="school_attend" value="<?php echo $stud_del->school_attend;?>">
				<input type="hidden" name="school_attend_other" id="school_attend_other" value="<?php echo $stud_del->school_attend_other;?>">
				<input type="hidden" name="is_graduated" id="is_graduated" value="<?php echo $stud_del->is_graduated;?>">
				<input type="hidden" name="graduated_when" id="graduated_when" value="<?php echo $stud_del->graduated_when;?>">
				<input type="hidden" name="usmle_before" id="usmle_before" value="<?php echo $stud_del->usmle_before;?>">
				<input type="hidden" name="usmle_when" id="usmle_when" value="<?php echo $stud_del->usmle_when;?>">
				<input type="hidden" name="review_programs" id="review_programs" value="<?php echo $stud_del->review_programs;?>">
				<input type="hidden" name="review_programs_when" id="review_programs_when" value="<?php echo $stud_del->review_programs_when;?>">
				<input type="hidden" name="review_programs_which" id="review_programs_which" value="<?php echo $stud_del->review_programs_which;?>">
				<?php
					//if not taken scheduler module end
				}
				?>
				<div class="form-group">
					<div class="row">
					<div class="col-md-12">
					<div class="form-group">
					  <label>Upload Picture</label>
					  <div class="input-group mb-3">
					  <label class="file">
						<input type="file" name="photo" id="photo">
					  </label>
					</div>
					<span id="photoErr" class="text-danger"></span>									
					</div>
					</div>
				</div>
				</div>
				<div class="form-group">
						<?php 
						if($stud_del->photo){ 
							?>
							<div class="student-section">
								<img class="student-photo" src="<?php echo base_url('assets/student_photos/'.$stud_del->photo);?>" alt="<?php echo $stud_del->first_name; ?>">
							</div>
							<?php
						} 
						?>
				</div>
				
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">
				<input type="hidden" name="page" value="subscribe">
				<button onclick="unSubscribeModule(1);" type="button" class="btn btn-danger">
				  <i class="ti-close"></i> Cancel
				</button>
				<button type="submit" id="profile_submit" class="btn btn-primary">Save</button>
				<img id="profile_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
			</div>  
		  	</div>
		  </form>
		</div>
	  </div>
	</div>
  <!-- /.Profile modal end -->

  <!-- Select Course Modal start -->
  <div class="modal center-modal fade" data-backdrop="static" data-keyboard="false"data-backdrop="static" id="modal-course" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Select Exam, Exam Date and Confidence Level</h5>
			<a href="javascript:void(0);" title="Logout" class="close" onclick="logout();"><i class="fa fa-sign-out text-dark mr-2"></i></a>
		  </div>
		  <form method="POST" name="module_course_form" id="module_course_form" class="module_course_form" autocomplete="off">
		  	<div class="modal-body" style="background-color: #fafbfd;">		
			  	<div class="box-body">
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label>Exam <span class="text-danger">*</span></label>
						<div class="input-group mb-3">
							<select id="course" name="course" class="form-control" required="">
							<option value="">Select Exam</option>
							<?php
							if($active_courses){
								foreach ($active_courses as $ac) {
									?><option value="<?php echo $ac->id;?>"><?php echo $ac->name;?></option><?php
								}
							}
							?>
						  	</select>
							<div class="input-group-append">
								<span class="input-group-text"><i class="ti-agenda"></i></span>
							</div>
						</div>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						<label>Is Exam Date Scheduled</label>
						<div class="input-group mb-3">
							<select id="option" name="is_scheduled" class="form-control" onchange="dateoption()">
							<option value="">Select Yes / No</option>
							<option value="yes">Yes</option>
							<option value="no">No</option>
						  	</select>
							<div class="input-group-append">
								<span class="input-group-text"><i class="ti-marker-alt"></i></span>
							</div>
						</div>
					</div>
					</div>
					</div>
					<div class="form-group" id="exam_date_field" style="display: none;">
						<label>Exam Date <span class="text-danger">*</span></label>
						<div class="input-group mb-3">
							<input class="form-control exam_date_class" type="text" value="<?php echo date('m/d/Y');?>" id="example-date-input" name="exam_date">
						</div>
					</div>
					<div class="form-group">
						<label>Confidence level</label>
						<div class="input-group mb-3">
							<select id="confidence_level" name="confidence_level" class="form-control">
							<option value="">Select level</option>
							<?php
							if($active_conf_level){
								foreach ($active_conf_level as $acl) {
									?><option value="<?php echo $acl->id;?>"><?php echo $acl->level;?></option><?php
								}
							}
							?>
						  	</select>
							<div class="input-group-append">
								<span class="input-group-text"><i class="ti-panel"></i></span>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
		  	</div>	
		  </form>
		</div>
	  </div>
	</div>
  <!-- /.Select Course modal end-->

<?php
// include 'chatbox.php';
?>	
<script src="<?php echo base_url('assets/js/vendors.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/select2/dist/js/select2.full.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/jquery-ui/jquery-ui.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/moment/min/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/fullcalendar/fullcalendar.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/fullcalendar/lib/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/fullcalendar/fullcalendar.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/sweetalert/sweetalert.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/template.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/js/pages/custom-scroll.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/planner/js/pages/advanced-form-element.js');?>"></script>
<script src="<?php echo base_url('assets/js/pages/calendar-1.js');?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<?php
if(($this->session->flashdata('message')) && ($this->session->flashdata('message') != ""))
{
?>
<script type="text/javascript">
    $.toast({
            heading: 'project91',
            text: '<?php echo $this->session->flashdata('message'); ?>',
            position: 'top-right',
            loaderBg: '#9fcd53',
            icon: 'success',
            hideAfter: 4500,
            stack: 6
        });
</script>
<?php
}
?>
<?php
if(($allocator_mod > 0) && ($stud_del->profile_visit != 2)){
?>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#modal-profile').modal('show');
    });
</script>
<?php
}else if(($allocator_mod > 0) && ($stud_del->profile_visit == 2) && ($stud_del->course_visit == 0)){
?>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#modal-course').modal('show');
    });
</script>
<?php
}else if(($allocator_mod > 0) && ($stud_del->profile_visit == 2) && ($stud_del->course_visit == 1)){
	$this->session->set_flashdata('message', 'Successfully Subscribed for Study Allocator');
	redirect(base_url());
}
else{}
?>
<script type="text/javascript">
	$(".allocator-div").click(function () {  
      $("#allocator").prop("checked" , true)  
     });

	$(".scheduler-div").click(function () { 
      $("#scheduler").prop("checked" , true)  
     });

	$(".cv-div").click(function () { 
      $("#cv").prop("checked" , true)  
     });
 
function dateoption(){
 	var option = document.getElementById("option").value;
 	if (option == 'yes') 
 	{
 		$(".exam_date_class").prop('required',true);
 		document.getElementById("exam_date_field").style.display = "block";
	}
	else
	{
		$(".exam_date_class").prop('required',false);
	 	document.getElementById("exam_date_field").style.display = "none";
	}
}

function showOtherbox(val){
	if (val == '9999') 
	{
		document.getElementById("other_school").style.display = "block";
		$("#school_attend_other").prop('required',true);
	}
	else
	{
		document.getElementById("other_school").style.display = "none";
		document.getElementById("school_attend_other").value = "";
		$("#school_attend_other").prop('required',false);
	}
}

function showUniversity(cnt,val){
	if (val == 'University referral') 
	{
		document.getElementById("university_div").style.display = "block";
		$("#university").prop('required',true);
		document.getElementById("hear_from_other").value = "";	
	}
	else if(val == 'Other') 
	{
		document.getElementById("university_div").style.display = "none";
		document.getElementById("university").value = "";
		$("#university").prop('required',false);
		document.getElementById("other_university").style.display = "none";
		document.getElementById("university_other").value = "";
		$("#university_other").prop('required',false);
	}
	else
	{
		document.getElementById("university_div").style.display = "none";
		document.getElementById("university").value = "";
		$("#university").prop('required',false);
		document.getElementById("other_university").style.display = "none";
		document.getElementById("university_other").value = "";
		$("#university_other").prop('required',false);
		document.getElementById("hear_from_other").value = "";
	}
}

function showOtherUniv(val){
	if (val == '9999') 
	{
		document.getElementById("other_university").style.display = "block";
		$("#university_other").prop('required',true);
	}
	else
	{
		document.getElementById("other_university").style.display = "none";
		document.getElementById("university_other").value = "";
		$("#university_other").prop('required',false);
	}
}

function showOtherGender(cnt,val){
	if (val == 'other') 
	{
		document.getElementById("other_gender").style.display = "block";
		$("#gender_other").prop('required',true);
	}
	else
	{
		document.getElementById("other_gender").style.display = "none";
		document.getElementById("gender_other").value = "";
		$("#gender_other").prop('required',false);
	}
}
</script> 
</body>
</html>
