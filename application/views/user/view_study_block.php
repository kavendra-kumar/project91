<!DOCTYPE html>
<html lang="en">
<?php 
$title_name = 'Study Allocator';
$study_block_id = $this->uri->segment(2);
$planner_id = $sb->planner_id;
$pln = $this->Front_model->getPlannerById($planner_id); 
$student_id = $this->session->userdata('student_id');
$pln_mentor = $this->Front_model->getStudentById($pln->mentor_id);
$sb_stud = $this->Front_model->getStudentById($sb->student_id);
$sb_course = $this->Front_model->getCourseById($pln->course_id);
$sb_subject = $this->Front_model->getSubjectByid($sb->subject_id);
$sb_planner_task = $this->Front_model->getPlannerTaskById($sb->planner_task_id);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('assets/images/project91_Round_logo.png');?>">
    <title>View Study Block | <?php echo $pln->title; ?> | <?php echo $title_name; ?> | project91</title>
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
			  <div class="box">
				<div class="box-header with-border">
				 	<h5 class="box-title"><a href="<?php echo base_url('study-blocks/'.$planner_id); ?>"><?php echo $pln->title; ?></a></h5>
				 	&nbsp; <i class="fa fa-angle-double-right"></i> &nbsp;
				 	<h5 class="box-title">Study Block</h5>
					</div>					
				<div class="box-body p-10">
				  	<ul class="todo-list">
					  	<li class="p-0 mb-10">
						  	<div class="box p-15 mb-0 d-block bb-2 border-lightgray">
						  		<div class="pull-right">
								&nbsp;<a class="text-fade" href="#" data-toggle="modal" data-target="#edit-study-block<?php echo $study_block_id;?>" title="Edit Study Block"><i class="fa fa-edit"></i></a>
								&nbsp;<a class="text-fade" href="#" onclick="deleteStudyBlock(<?php echo $study_block_id; ?>,<?php echo $planner_id; ?>,'view');" title="Remove"><i class="fa fa-trash-o"></i></a>
								</div>
							  	<h4><i class="bg-primary fa fa-square-o mb-0 mr-5 ml-15"></i>
							  	<span title="Title" class="text-line text-success font-weight-500">
							  	<?php echo $sb_subject->name; ?>
								</span>	</h4>
								<div class="mt-5 ml-30 pl-5 text-fade font-size-14 planner-note" title="<?php echo $sb->notes;?>"><?php echo $sb->notes; ?>
								</div>
								<ul class="list-inline mb-0 mt-15 ml-30 mr-5">
									<li>
										<i class="planner-reminder text-fade" title="Reminder"><?php
										if($sb->reminder != 'No reminder'){
											?>
											<li>
												<i title="<?php echo $sb->reminder; ?>" class="mdi mdi-alarm text-fade"></i> <?php echo $sb->reminder; ?>
											</li>
											<?php
										}
										?></i>
									</li>
									<li>
										<span title="task" class="badge badge-primary-light font-size-12 mb-0"><?php echo $sb_planner_task->name; ?></span>
									</li>
									<?php
									if($sb->is_completed == 'yes'){
										?>
										<li class="status<?php echo $study_block_id; ?>">
											<span class="badge badge-pill badge-success font-size-12">Completed</span>
										</li>
										<?php
									}else{
										$datetime = $sb->start_date.' '.$sb->start_time;
										$dur = explode(' ', $sb->duration);
										if($dur[1] == 'mins')
										{
											$convertedDuration = $dur[0].' minutes';
										}
										else if($dur[1] == 'hr' || $dur[1] == 'hrs')
										{
											$min = intval($dur[0]*60);
											$convertedDuration = $min.' minutes';
										}
										$convertedTime = date('Y-m-d H:i:s',strtotime('+'.$convertedDuration, strtotime($datetime)));
										if(($sb->is_completed != 'yes') && (strtotime(date('Y-m-d H:i:s')) > strtotime($convertedTime))){
											?>
											<li class="status<?php echo $study_block_id; ?>">
												<span class="badge badge-pill badge-danger font-size-12">Overdue</span>
											</li>
										<?php
										}else{
											?>
											<li class="status<?php echo $study_block_id; ?>">
												<span class="badge badge-pill badge-warning font-size-12">Pending</span>
											</li>
										<?php
										}
									}
									?>
									<span class="pull-right text-fade font-size-12 mb-0">
								<?php echo $sb_course->name.' <i class="fa fa-circle"></i>'; ?>
							</span>
							  	</ul>
								<br>
								<hr class="my-0">
								<br>
								<div class="row mt-0 mb-25 px-30">
									<div class="col-xl-5 col-lg-5 col-5">
										<span class="text-primary">
											<i class="fa fa-calendar"></i>&nbsp; Created On :
										</span>
										<br>
										<span class="ml-15">
											<?php echo date('h:i A', strtotime($sb->start_time)); ?>, 
											<?php echo date('d M Y', strtotime($sb->start_date)); ?>
										</span>
									</div>
									<div class="col-xl-7 col-lg-7 col-7">
										<span class="text-primary">
											<i class="fa fa-calendar"></i>&nbsp; Due On :
										</span>
										<br>
										<span class="ml-15">
											<?php
											$datetime = $sb->start_date.' '.$sb->start_time;
											$dur = explode(' ', $sb->duration);
											if($dur[1] == 'mins')
											{
												$convertedDuration = $dur[0].' minutes';
											}
											else if($dur[1] == 'hr' || $dur[1] == 'hrs')
											{
												$min = intval($dur[0]*60);
												$convertedDuration = $min.' minutes';
											}
											$convertedTime = date('Y-m-d H:i:s',strtotime('+'.$convertedDuration, strtotime($datetime)));
											?>
											<?php echo date('h:i A', strtotime($convertedTime)); ?>, 
											<?php echo date('d M Y', strtotime($convertedTime)); ?>
										</span>
									</div>
								</div>
								<div class="row mt-0 mb-25 px-30">									
									<div class="col-xl-5 col-lg-5 col-5">									<span class="text-primary">
										<i class="fa fa-user"></i>&nbsp; Created By :
									</span>
										<br>
										<span class="ml-15">&nbsp;<?php echo $sb_stud->first_name.' '.$sb_stud->last_name; ?></span>	
									</div>
									<div class="col-xl-7 col-lg-7 col-7">
										<span class="text-primary">
											<i class="fa fa-user"></i>&nbsp; Mentor :
										</span>
										<br>
										<span class="ml-15">
										<?php
										if($pln_mentor && ($pln->mentor_request == 'accept')){
											$men_fullname = $pln_mentor->first_name.' '.$pln_mentor->last_name;
											echo $men_fullname; 
										}else if($pln_mentor && ($pln->mentor_request == 'reject')){
											$men_fullname = $pln_mentor->first_name.' '.$pln_mentor->last_name;
											echo $men_fullname.' (Request Rejected)'; 
										}else if($pln_mentor && ($pln->mentor_request == '')){
											$men_fullname = $pln_mentor->first_name.' '.$pln_mentor->last_name;
											echo $men_fullname.' (Request Pending)'; 
										}else{
											echo 'No Mentor Assigned';
										}
										?>
									</span>											
									</div>
								</div>
							</div>
						</li>
						<li class="p-0 mb-10">
						  	<div class="box p-15 mb-0 d-block bb-2 border-lightgray">
						  		<br>
							  	<?php
								  if($sb->files){
								  	$files = explode(', ', $sb->files);
								  	if($files){
								  		?>
										<ul class="list-inline mb-0 ml-10 mr-5">
											<i class="fa fa-files-o font-size-16 font-weight-bold"></i>&nbsp;<span class="text-success font-size-16 planner-files">
										  	<strong>Attached Files : </strong></span>	
										</ul>
									  	<ul class="list-unstyled ml-30 mr-5 files-block<?php echo $study_block_id; ?>">
								  		<?php
								  		$fcnt=0;
								  		foreach ($files as $study_block_files) {
								  			?>
								  			<li title="Files" id="files<?php echo $study_block_id; ?><?php echo $fcnt;?>">
								  				<div class="row">
								  					<div class="col-md-9 pull-left">
										  				<i class="fa fa-check text-danger float-none mr-5"></i> 
										  				<a href="#" onclick="previewFile(<?php echo $study_block_id; ?>,<?php echo $fcnt; ?>);" class="text-dark">
										  					<?php echo $study_block_files; ?>
										  				</a>
									  				</div>
									  				<div class="col-md-3 font-size-18">
									  					<a href="#" class="text-fade mr-15" title="Preview" onclick="previewFile(<?php echo $study_block_id; ?>,<?php echo $fcnt; ?>);"><i class="mdi mdi-eye"></i></a>
										  				<a href="<?php echo base_url('front/download_file/'.$study_block_id.'/'.$fcnt); ?>" class="text-fade mr-15" title="Download"><i class="fa fa-download"></i></a>
									  					<a href="#" class="text-fade mr-15" title="Delete" onclick='deleteFile(<?php echo $study_block_id; ?>,<?php echo $fcnt; ?>,"view");'><i class="mdi mdi-delete"></i></a>
										  			</div>
								  				</div>
								  			</li>
								  			<?php
								  			$fcnt++;
								  		}
								  		?>
									  	</ul>
									  	<?php
								  	}						  	
								  }
								  ?>
							</div>
						</li>
				  	</ul>
				</div>
				<!-- /.box-body -->
			  </div>
			</div>
			
		</div>	
	</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  <!--Start Modal Edit Study Block Details-->
	<div id="edit-study-block<?php echo $study_block_id;?>" class="modal fade bs-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		<form method="POST" name="edit_study_block_form<?php echo $study_block_id;?>" id="edit_study_block_form<?php echo $study_block_id;?>" class="edit_study_block_form" onsubmit="return editStudyBlock(<?php echo $study_block_id;?>);" autocomplete="off" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 title="Study Block" class="modal-title study-block" id="myLargeModalLabel"><strong>Edit Study Block</strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Exam <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<input type="text" value="<?php echo $sb_course->name; ?>" class="form-control" readonly>
										<input type="hidden" name="course_id" id="course_id" value="<?php echo $pln->course_id; ?>" required="">
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-agenda"></i></span>
										</div>
									</div>
									<span id="course_idErr" class="text-danger"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Subject <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
						        <select name="subject_id" id="subject_id" class="form-control" required="">
						            <option value="">Select Subject</option>
						            <?php 
						            $subjects = $this->Front_model->getSubjectByCid($pln->course_id);
						            if($subjects){
						                foreach ($subjects as $sbj) {
						                    ?>
						                    <option <?php if($sb->subject_id == $sbj->id){ echo 'selected'; } ?> value="<?php echo $sbj->id; ?>"><?php echo $sbj->name; ?></option>
						                    <?php
						                }
						            }
						            ?>
						        </select>
						        <div class="input-group-append">
						            <span class="input-group-text"><i class="ti-book"></i></span>
						        </div>
									</div>
									<span id="subject_idErr" class="text-danger"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Task <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<select name="planner_task_id" id="planner_task_id" class="form-control" required="">
											<option value="">Select Task</option>
											<?php
											if($planner_task){
												foreach ($planner_task as $pt) {
													?><option <?php if($sb->planner_task_id == $pt->id){ echo 'selected'; } ?> value="<?php echo $pt->id; ?>"><?php echo $pt->name; ?></option><?php
												}
											}
											?>
										</select>
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-layout-list-thumb"></i></span>
										</div>
									</div>
									<span id="planner_task_idErr" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Add Notes </label>
									<div class="input-group mb-3">
										<textarea name="notes" id="notes" class="form-control" placeholder="Notes.."><?php echo $sb->notes; ?></textarea>
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-info"></i></span>
										</div>
									</div>
									<span id="notesErr" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Start Date <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<?php
											$db_start_date = $sb->start_date; //  Y-m-d          
								            $start_date = date("m/d/Y", strtotime($db_start_date)); // m/d/Y
							            ?>
										<input type="text" name="start_date" value="<?php echo $start_date;?>" id="start_date" class="form-control create_start_date" placeholder="Start date" required="">
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
										</div>
									</div>
									<span id="start_dateErr" class="text-danger"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Start Time <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<select id="start_time" name="start_time" class="form-control select2" style="width: 84%;" required="">
										<?php
					          			$start_time  = date("h:i A", strtotime($sb->start_time));
										if($time_12hrs){
											foreach ($time_12hrs as $t12hrs) {
												?>
												<option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == $start_time){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
												<?php
											}
										}
										?>
								  	</select>
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
										</div>
									</div>
									<span id="start_timeErr" class="text-danger"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Duration <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<select id="duration" name="duration" class="form-control select2" style="width: 84%;" required="">
										<?php
										if($duration){
											foreach ($duration as $dur) {
												?>
												<option value="<?php echo $dur->time; ?>" <?php if($dur->time == $sb->duration){ echo 'selected'; } ?> ><?php echo $dur->time; ?></option>
												<?php
											}
										}
										?>
								  	</select>
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
										</div>
									</div>
									<span id="durationErr" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Timer</label>
									<div class="input-group mb-3">
										<select name="timer" id="timer" class="form-control">
											<option value="">Choose</option>
											<option value="1" <?php if($sb->timer == '1'){ echo 'selected'; } ?> >Yes</option>
											<option value="0" <?php if($sb->timer == '0'){ echo 'selected'; } ?> >No</option>
										</select>
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-timer"></i></span>
										</div>
									</div>
									<span id="timerErr" class="text-danger"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Reminder</label>
									<div class="input-group mb-3">
										<select id="reminder" name="reminder" class="form-control">
											<option value="No reminder">No reminder</option>
											<option value="5 minutes before" <?php if($sb->reminder == '5 minutes before'){ echo 'selected'; } ?> >5 minutes before</option>
											<option value="15 minutes before" <?php if($sb->reminder == '15 minutes before'){ echo 'selected'; } ?> >15 minutes before</option>
											<option value="30 minutes before" <?php if($sb->reminder == '30 minutes before'){ echo 'selected'; } ?> >30 minutes before</option>
											<option value="1 hour before" <?php if($sb->reminder == '1 hour before'){ echo 'selected'; } ?> >1 hour before</option>
											<option value="4 hours before" <?php if($sb->reminder == '4 hours before'){ echo 'selected'; } ?>>4 hours before</option>
											<option value="1 day before" <?php if($sb->reminder == '1 day before'){ echo 'selected'; } ?> >1 day before</option>
											<option value="2 days before" <?php if($sb->reminder == '2 days before'){ echo 'selected'; } ?> >2 days before</option>
											<option value="1 week before" <?php if($sb->reminder == '1 week before'){ echo 'selected'; } ?> >1 week before</option>
										</select>
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-bell"></i></span>
										</div>
									</div>
									<span id="reminderErr" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Mentor</label>
									<div class="input-group mb-3">											
										<?php 
										if($pln_mentor && ($pln->mentor_request == 'accept')){
											?>
											<input type="hidden" name="mentor_id" id="mentor_id" value="<?php echo $pln->mentor_id; ?>">
											<input type="text" class="form-control" value="<?php echo $pln_mentor->first_name.' '.$pln_mentor->last_name; ?>" readonly>
											<?php
										}else if($pln_mentor && ($pln->mentor_request == 'reject')){
											?><input type="text" class="form-control" value="Request Rejected" readonly><?php
										}else if($pln_mentor && ($pln->mentor_request == '')){
											?><input type="text" class="form-control" value="Request Pending" readonly><?php
										}else{
											?>
											<input type="hidden" name="mentor_id" id="mentor_id" value="0">
											<input type="text" class="form-control" name="mentor_name" id="mentor_name" value="No Mentor Assigned" readonly>
											<?php
										}
										?>
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-user"></i></span>
										</div>
									</div>
									<span id="mentor_idErr" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Attach Files</label>
									<div class="input-group mb-3">
										<input type="file" name="files[]" id="files" class="form-control" placeholder="files" multiple="">
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-upload"></i></span>
										</div>
									</div>										
										<?php
										  if($sb->files){
										  	$files = explode(',', $sb->files);
										  	if($files){
										  		?>
										  		<div>
												  <ul class="list-inline mb-0 ml-10 mr-5">
													  <span class="text-success font-size-16 planner-files">Attached Files : </span>	
													</ul>
											  	<ul class="list-files-block<?php echo $study_block_id; ?>">
											  		<?php
											  		$cnt=0;
											  		foreach ($files as $study_block_files) {
											  			?>
											  			<li title="Files" id="list_files<?php echo $study_block_id; ?><?php echo $cnt;?>">
											  				<?php echo $study_block_files; ?>
																&nbsp;&nbsp;<a class="text-fade font-size-16" href="#" onclick='deleteFile(<?php echo $study_block_id; ?>,<?php echo $cnt; ?>,"view");' title="Delete"><i class="fa fa-trash-o"></i></a>
											  			</li>
											  			<?php
											  			$cnt++;
											  		}
											  		?>
											  	</ul>
											  	</div>
											  	<?php
										  	}						  	
										  }
										?>									
									<span id="filesErr" class="text-danger"></span>
								</div>
							</div>
						</div>	
							
						</div>
						<!-- /.box-body -->
						<div class="box-footer text-center">
							<input type="hidden" name="planner_id" id="planner_id" value="<?php echo $planner_id; ?>">
							<input type="hidden" name="study_block_id" id="study_block_id" value="<?php echo $study_block_id; ?>">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" id="edit_study_block_submit<?php echo $study_block_id;?>" class="btn btn-primary">Save</button>
							<img id="edit_study_block_loader<?php echo $study_block_id;?>" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
						</div> 
			</div>
			<!-- /.modal-content --> 
		</form>
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal Edit Study Block Details-->
<!--Start Modal Preview File-->
	<div id="preview-file-modal" class="modal fade bs-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal Preview File-->

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

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
</body>
</html>
