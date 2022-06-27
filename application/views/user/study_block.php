<!DOCTYPE html>
<html lang="en">
<?php 
$title_name = 'Study Allocator'; 
$planner_id = $this->uri->segment(2);
$pln = $this->Front_model->getPlannerById($planner_id); 
$student_id = $this->session->userdata('student_id');
$pln_mentor = $this->Front_model->getStudentById($pln->mentor_id);
$sb_course = $this->Front_model->getCourseById($pln->course_id);
$subjects = $this->Front_model->getSubjectByCid($sb_course->id);
$planner_task = $this->Front_model->getPlannerTask();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('assets/images/project91_Round_logo.png');?>">
    <title>Study Blocks | <?php echo $pln->title; ?> | <?php echo $title_name; ?> | project91</title>
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
				 	<span class="total-task-count pull-left font-size-16 mt-10">
					 	<span class="font-weight-bold">
					 		<h5 class="box-title"><a href="<?php echo base_url('planner'); ?>">Planner</a></h5>
					 		&nbsp; <i class="fa fa-angle-double-right"></i> &nbsp;
					 		<h5 class="box-title"><?php echo $pln->title; ?></h5>
					 		&nbsp; <i class="fa fa-angle-double-right"></i> &nbsp;
					 		<h5 class="box-title">Study Blocks</h5>
					 	</span>
					</span>
					<?php
					if($study_block){
					?>
					<button type="button" title="Refresh" onclick="window.location.reload();" class="waves-effect btn btn-light mb-5 pull-right">Refresh</button>
					<button type="button" data-toggle="modal" data-target="#add-study-block" class="mr-5 btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Study Block</button>
					<?php
					}
					?>					
					</div>
					<?php
					if($study_block){
					?>
					<div class="p-5">
						<ul class="nav nav-pills nav-pills-sm" role="tablist">
							<li class="nav-item">
								<a class="nav-link py-2 px-4 b-0 active" data-toggle="tab" href="#card-view">
									<span class="nav-text base-font"><i class="mdi mdi-view-grid"></i></span>
								</a>
							<li class="nav-item">
								<a class="nav-link py-2 px-4 b-0" data-toggle="tab" href="#list-view">
									<span class="nav-text base-font"><i class="mdi mdi-view-list"></i></span>
								</a>
							</li>
							</li>
						</ul>
					</div>
					<?php
					}
					?>          
			<div class="tab-content" id="slimtest5">				
				<div class="box-body p-20 tab-pane active" id="card-view">
					<div class="row">						
							<?php
							if($study_block){
								?>
								<div class="col-12">
							<div class="card-columns">
								<?php
								foreach ($study_block as $sb) {
									$study_block_id = $sb->id;
					  			$sb_subject = $this->Front_model->getSubjectById($sb->subject_id);
					  			$sb_task = $this->Front_model->getPlannerTaskById($sb->planner_task_id);
								?>
								<div class="card show-study_block<?php echo $study_block_id;?> bb-2 border-lightgray">
									<div class="card-body p-10" style="height: 130px;">
										<span class="card-title b-0 px-0 <?php if($sb->is_completed == 'yes'){ echo 'done'; } ?>">
											<?php
									  	if($sb->is_completed == 'yes'){
									  		?>
									  		<input type="checkbox" id="basic2_checkbox_<?php echo $study_block_id;?>" class="filled-in chk-col-success" onclick="completeStudyBlock('#basic2_checkbox_',<?php echo $study_block_id;?>);" checked>
											 <label for="basic2_checkbox_<?php echo $study_block_id;?>" class="mb-0 h-15"></label>
											 <?php
									  	}else{
									  		?><input type="checkbox" id="basic2_checkbox_<?php echo $study_block_id;?>" class="filled-in chk-col-success" onclick="completeStudyBlock('#basic2_checkbox_',<?php echo $study_block_id;?>);">
											 <label for="basic2_checkbox_<?php echo $study_block_id;?>" class="mb-0 h-15"></label>
											 <?php
									  	}
									  	?>
										  <span title="Subject" class="text-line text-success font-size-14 font-weight-500"> <a href="#" data-toggle="modal" data-target="#view-card_study_block<?php echo $study_block_id;?>">
										  <?php echo $sb_subject->name; ?>
											</a></span>	
										</span>
										<div class="pull-right">
											<a class="text-fade" href="<?php echo base_url('view-study-block/'.$study_block_id); ?>" title="Open Study Block"><i class="fa fa-external-link"></i></a>
											&nbsp;<a class="text-fade" href="#" data-toggle="modal" data-target="#edit-card_study-block<?php echo $study_block_id;?>" title="Edit"><i class="fa fa-edit"></i></a>
											&nbsp;<a class="text-fade" href="#" onclick="deleteStudyBlock(<?php echo $study_block_id; ?>,<?php echo $planner_id; ?>,'all');" title="Remove"><i class="fa fa-trash-o"></i></a>
										</div>
										<?php
										if($sb->notes){
											?><div class="text-dark mt-5" title="<?php echo $sb->notes;?>"><?php 
										  if(strlen($sb->notes)>90)
											{
												print(substr($sb->notes,0,90)."..");
											}
											else
											{
												print($sb->notes);
											}
											?></div><?php
										}else{
											?><div class="text-fade mt-5">When you have a dream, you've got to grab it and never let go.</div><?php
										}
										?>
										
									</div>
									<div class="card-footer p-10">
										<div class="justify-content-between d-flex">
										<span title="task" class="badge badge-primary-light font-size-12 mb-0"><?php echo $sb_task->name; ?></span>
										<?php
							if($sb->reminder != 'No reminder'){
								?>
								<span>
									<i title="<?php echo $sb->reminder; ?>" class="mdi mdi-alarm text-fade"></i>
								</span>
								<?php
							}
							?>
										<?php
							if($pln->mentor_id && ($pln->mentor_request == 'accept')){
								?>
									<span class="avatar-group">
									  <?php
									  	$sd = $this->Front_model->getStudentById($pln->mentor_id);	
									  	$men_fullname = $sd->first_name.' '.$sd->last_name;
									  	if(!empty($sd->photo)){
									  		?>
									  		<span class="avatar-group-item">
													<a href="javascript: void(0);" class="d-inline-block">
														<img src="<?php echo base_url('assets/student_photos/'.$sd->photo);?>" alt="" class="rounded-circle avatar-xs bg-dark-green" title="<?php echo $men_fullname; ?>">
													</a>
												</span>
									  		<?php
									  	}else{									  		
							   	  		$mentor_name = explode(" ", $men_fullname);
												$photo_name = "";
												foreach ($mentor_name as $mn) {
												  $photo_name .= $mn[0];
												}
												?>
												<span class="avatar-group-item">
													<a href="javascript: void(0);" class="d-inline-block">
														<div class="avatar-xss">
															<span class="avatar-title rounded-circle bg-dark-green text-white font-size-14" title="<?php echo $men_fullname; ?>"> <?php echo strtoupper($photo_name);?> </span>
														</div>
													</a>
												</span>
												<?php
									  	}					  	
									  ?>
									</span>
								<?php
							}
							?>
										<span class="status<?php echo $study_block_id; ?>">
											<?php
							if($sb->is_completed == 'yes'){
								?>
									<span class="badge badge-pill badge-success font-size-12">Completed</span>
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
										<span class="badge badge-pill badge-danger font-size-12">Overdue</span>
								<?php
								}else{
									?>
										<span class="badge badge-pill badge-warning font-size-12">Pending</span>
								<?php
								}
							}
							?>
										</span>
									</div>
									<br>
									<div class="justify-content-between d-flex">
										<span class="text-muted">
											<a class="text-dark font-weight-bold font-size-12" href="#" data-toggle="tooltip" data-container="body" title="Start Date" data-original-title="Start Date">
												<i class="mdi mdi-calendar"></i> 
													<?php echo date('d M Y', strtotime($sb->start_date)); ?>									
											</a>
										</span>
										<span class="text-fade"><i class="fa fa-circle"></i> <?php echo $sb_course->name; ?></span>
									</div>
									</div>
								</div>
	<!--Start Modal View Study Block Details-->
	<div id="view-card_study_block<?php echo $study_block_id;?>" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color: #fbfbfb">
				<div class="modal-header">
					<h4 title="Study Block" class="modal-title study-block" id="myModalLabel"><strong><?php echo $sb_course->name; ?></strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>				
				<div class="modal-body">
					<!-- checkbox -->
					<ul class="todo-list-2">
						<li class="p-0 mb-15">
						  <ul class="list-inline mb-0 ml-10 mr-5">
						  	<span title="Subject" class="text-primary font-weight-bold font-size-18 study_block-subject"><?php echo $sb_subject->name; ?></span>	
						  	<div style="float: right;">
						  		<a class="text-fade" href="<?php echo base_url('view-study-block/'.$study_block_id); ?>" title="Open Study Block"><i class="fa fa-external-link"></i></a>
							  	&nbsp;<a class="text-fade" href="#" data-toggle="modal" data-target="#edit-card_study-block<?php echo $study_block_id;?>" title="Edit Study Block"><i class="fa fa-edit"></i></a>
							  	&nbsp;<a class="text-fade" href="#" onclick="deleteStudyBlock(<?php echo $study_block_id; ?>,<?php echo $planner_id; ?>,'all');" title="Delete Study Block"><i class="fa fa-trash-o"></i></a>
							  </div>
						  </ul>
						  <ul class="list-inline mb-0 mt-10 ml-10 mr-5">
						  	<?php
								if($sb->notes){
									?><span title="Note" class="text-fade font-size-14">
						  		<?php 
									  if(strlen($sb->notes)>305)
										{
											$typee = "'study_block_notes'";
											echo substr($sb->notes,0,305).'<a class="readmore read-morestudy_block_notes'.$sb->id.'" onclick="return readMoreContent('.$typee.','.$sb->id.');"> Read more</a><span class="show-morestudy_block_notes'.$sb->id.'" style="display: none;">'.substr($sb->notes,80).' <a class="readless read-lessstudy_block_notes'.$sb->id.'" onclick="return readLess('.$typee.','.$sb->id.');">Read less</a></span>';
										}
										else
										{
											print($sb->notes);
										}
						  		?>
						  		</span><?php
								}else{
									?><span class="text-fade font-size-14">When you have a dream, you've got to grab it and never let go.</span><?php
								}
								?>
						  </ul> 						  
						  <?php
						  if($sb->files){
						  	$files = explode(', ', $sb->files);
						  	if($files){
						  		?>
						  		<br><br>
								  <ul class="list-inline mb-0 ml-10 mr-5">
									  <span class="text-success font-size-16 study_block-files">Attached Files : </span>	
									</ul>
							  	<ul>
							  		<?php
							  		foreach ($files as $study_block_files) {
							  			?>
							  			<li title="Files"><?php echo $study_block_files; ?></li>
							  			<?php
							  		}
							  		?>
							  	</ul>
							  	<?php
						  	}						  	
						  }
						  ?>
						  <ul class="list-inline mb-0 mt-15 ml-30 mr-5 pull-right">
								<li>
									<i class="study_block-reminder text-fade" title="Reminder"><?php
							if($sb->reminder != 'No reminder'){
								?>
								<li>
									<i title="<?php echo $sb->reminder; ?>" class="mdi mdi-alarm text-fade"></i>
								</li>
								<?php
							}
							?></i>
								</li>
								<li>
									<a class="text-dark font-weight-bold study_block-start-date" href="#" data-toggle="tooltip" data-container="body" title="Start Date Time" data-original-title="Start Date Time"><?php echo date('h:i A', strtotime($sb->start_time)); ?>, <?php echo date('d M Y', strtotime($sb->start_date)); ?></a>
								</li>
								<li>
									<span title="task" class="badge badge-pill badge-success font-size-12 mb-0"><?php echo $sb_task->name; ?></span>
								</li>
						  </ul>
						</li>
					</ul>
				</div>				
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal View Study Block Details-->
	<!--Start Modal Edit Study Block Details-->
	<div id="edit-card_study-block<?php echo $study_block_id;?>" class="modal fade bs-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 title="Study Block" class="modal-title study-block" id="myLargeModalLabel"><strong>Edit Study Block</strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form method="POST" name="edit_card_study_block_form<?php echo $study_block_id;?>" id="edit_card_study_block_form<?php echo $study_block_id;?>" class="edit_card_study_block_form" onsubmit="return editCardStudyBlock(<?php echo $study_block_id;?>);" autocomplete="off" enctype="multipart/form-data">
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
						            $subjects1 = $this->Front_model->getSubjectByCid($pln->course_id);
						            if($subjects1){
						                foreach ($subjects1 as $sbj) {
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
											  	<ul class="card-files-block<?php echo $sb->id;?>">
											  		<?php
											  		$cnt=0;
											  		foreach ($files as $study_block_files) {
											  			?>
											  			<li title="Files" id="card_files<?php echo $sb->id;?><?php echo $cnt;?>">
											  				<?php echo $study_block_files; ?>
																&nbsp;&nbsp;<a class="text-fade font-size-16" href="#" onclick='deleteFile(<?php echo $sb->id.','.$cnt; ?>,"card");' title="Delete"><i class="fa fa-trash-o"></i></a>
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
							<button type="submit" id="edit_card_study_block_submit<?php echo $study_block_id;?>" class="btn btn-primary">Save</button>
							<img id="edit_card_study_block_loader<?php echo $study_block_id;?>" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
						</div> 
					</div> 
					</form>			
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal Edit Study Block Details-->
								<?php
								}
								?>
								</div>	
						</div>
								<?php
							}else{
							?>
				  			<div class="col-md-12">
				  				<div class="mt-40 text-center">
				  					<img class="w-p40" src="<?php echo base_url('assets/images/no-plan.png'); ?>">
				  					<h4 class="mt-20 text-success">You don't have any study block created yet.</h4>
				  					<button type="button" data-toggle="modal" data-target="#add-study-block" class="mr-5 btn btn-primary"><i class="fa fa-plus"></i> Add Study Block</button>
				  				</div>
				  			</div>
				  		<?php
						}
							?>							
					</div>
				</div>
				<!-- /.box-body end card View-->
				<div class="box-body p-10 tab-pane" id="list-view">				  
				  	<?php
				  	if($study_block){
				  		?>
				  		<ul class="todo-list">
				  		<?php
				  		foreach ($study_block as $sb) {
				  			$study_block_id = $sb->id;
				  			$sb_subject = $this->Front_model->getSubjectById($sb->subject_id);
				  			$sb_task = $this->Front_model->getPlannerTaskById($sb->planner_task_id);

				  			?>
				  	<li class="p-0 mb-10 show-study_block<?php echo $study_block_id;?>">
					  <div class="box p-15 mb-0 d-block bb-2 border-lightgray <?php if($sb->is_completed == 'yes'){ echo 'done'; } ?>">
					  	<?php
					  	if($sb->is_completed == 'yes'){
					  		?>
					  		<input type="checkbox" id="basic_checkbox_<?php echo $study_block_id;?>" class="filled-in chk-col-success" onclick="completeStudyBlock('#basic_checkbox_',<?php echo $study_block_id;?>);" checked>
							 <label for="basic_checkbox_<?php echo $study_block_id;?>" class="mb-0 h-15 ml-15"></label>
							 <?php
					  	}else{
					  		?><input type="checkbox" id="basic_checkbox_<?php echo $study_block_id;?>" class="filled-in chk-col-success" onclick="completeStudyBlock('#basic_checkbox_',<?php echo $study_block_id;?>);">
							 <label for="basic_checkbox_<?php echo $study_block_id;?>" class="mb-0 h-15 ml-15"></label>
							 <?php
					  	}
					  	?>
						  <!-- <i class="bg-primary fa fa-square-o mb-0 mr-5 ml-15"></i> -->
						  <span title="Subject" class="text-line text-success font-size-14 font-weight-500"> <a href="#" data-toggle="modal" data-target="#view-study_block<?php echo $study_block_id;?>">
						  <?php echo $sb_subject->name; ?>
							</a></span>	
							<div class="tools">
							<a class="text-fade" href="<?php echo base_url('view-study-block/'.$study_block_id); ?>" title="Open Study Block"><i class="fa fa-external-link"></i></a>
							&nbsp;<a class="text-fade" href="#" data-toggle="modal" data-target="#edit-study-block<?php echo $study_block_id;?>" title="Edit"><i class="fa fa-edit"></i></a>
							&nbsp;<a class="text-fade" href="#" onclick="deleteStudyBlock(<?php echo $study_block_id; ?>,<?php echo $planner_id; ?>,'all');" title="Remove"><i class="fa fa-trash-o"></i></a>
						  </div>
						  <?php
								if($sb->notes){
									?><div class="mt-5 ml-50 pl-5 text-dark font-size-12" title="<?php echo $sb->notes;?>"><?php 
									  if(strlen($sb->notes)>90)
										{
											print(substr($sb->notes,0,90)."..");
										}
										else
										{
											print($sb->notes);
										}
										?></div><?php
								}else{
									?><div class="text-fade mt-5 ml-50 pl-5 font-size-12">When you have a dream, you've got to grab it and never let go.</div><?php
								}
								?>							
								  
						  <ul class="list-inline mb-0 mt-5 ml-30">						  	
							<li>
								<a class="text-dark font-weight-bold font-size-12" href="#" data-toggle="tooltip" data-container="body" title="Start Date" data-original-title="Start Date">
									<i class="mdi mdi-calendar"></i> 
										<?php echo date('d M Y', strtotime($sb->start_date)); ?>									
								</a>
							</li>
							<?php
							if($sb->reminder != 'No reminder'){
								?>
								<li>
									<i title="<?php echo $sb->reminder; ?>" class="mdi mdi-alarm text-fade"></i>
								</li>
								<?php
							}
							?>
							<li>
								<span title="task" class="badge badge-primary-light font-size-12 mb-0"><?php echo $sb_task->name; ?></span>
							</li>
							<li class="status<?php echo $study_block_id; ?>">
							<?php
							if($sb->is_completed == 'yes'){
								?>
								<span class="badge badge-pill badge-success font-size-12">Completed</span>
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
									<span class="badge badge-pill badge-danger font-size-12">Overdue</span>
								<?php
								}else{
									?>
									<span class="badge badge-pill badge-warning font-size-12">Pending</span>
								<?php
								}
							}
							?>
							</li>
							
							<?php
							if($pln->mentor_id && ($pln->mentor_request == 'accept')){
								?>
								<li>
									<div class="avatar-group">
									  <?php
									  	$sd = $this->Front_model->getStudentById($pln->mentor_id);	
									  	$men_fullname = $sd->first_name.' '.$sd->last_name;
									  	if(!empty($sd->photo)){
									  		?>
									  		<div class="avatar-group-item">
													<a href="javascript: void(0);" class="d-inline-block">
														<img src="<?php echo base_url('assets/student_photos/'.$sd->photo);?>" alt="" class="rounded-circle avatar-xs bg-dark-green" title="<?php echo $men_fullname; ?>">
													</a>
												</div>
									  		<?php
									  	}else{									  		
							   	  		$mentor_name = explode(" ", $men_fullname);
												$photo_name = "";
												foreach ($mentor_name as $mn) {
												  $photo_name .= $mn[0];
												}
												?>
												<div class="avatar-group-item">
													<a href="javascript: void(0);" class="d-inline-block">
														<div class="avatar-xs">
															<span class="avatar-title rounded-circle bg-dark-green text-white font-size-14" title="<?php echo $men_fullname; ?>"> <?php echo strtoupper($photo_name);?> </span>
														</div>
													</a>
												</div>
												<?php
									  	}					  	
									  ?>
									</div>
						  </li>	
								<?php
							}
							?>
							<span class="pull-right text-fade font-size-12 mb-0">
								<?php echo $sb_course->name.' <i class="fa fa-circle"></i>'; ?>
							</span>
						  </ul>
						</div>
					</li>
						<!--Start Modal View Study Block Details-->
	<div id="view-study_block<?php echo $study_block_id;?>" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color: #fbfbfb">
				<div class="modal-header">
					<h4 title="Study Block" class="modal-title study-block" id="myModalLabel"><strong><?php echo $sb_course->name; ?></strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>				
				<div class="modal-body">
					<!-- checkbox -->
					<ul class="todo-list-2">
						<li class="p-0 mb-15">
						  <ul class="list-inline mb-0 ml-10 mr-5">
						  	<span title="Subject" class="text-primary font-weight-bold font-size-18 study_block-subject"><?php echo $sb_subject->name; ?></span>	
						  	<div style="float: right;">
						  		<a class="text-fade" href="<?php echo base_url('view-study-block/'.$study_block_id); ?>" title="Open Study Block"><i class="fa fa-external-link"></i></a>
							  	&nbsp;<a class="text-fade" href="#" data-toggle="modal" data-target="#edit-study-block<?php echo $study_block_id;?>" title="Edit Study Block"><i class="fa fa-edit"></i></a>
							  	&nbsp;<a class="text-fade" href="#" onclick="deleteStudyBlock(<?php echo $study_block_id; ?>,<?php echo $planner_id; ?>,'all');" title="Delete Study Block"><i class="fa fa-trash-o"></i></a>
							  </div>
						  </ul>
						  <ul class="list-inline mb-0 mt-10 ml-10 mr-5">
						  	<?php
								if($sb->notes){
									?><span title="Note" class="text-fade font-size-14">
						  		<?php 
									  if(strlen($sb->notes)>305)
										{
											$typee = "'study_block_notes'";
											echo substr($sb->notes,0,305).'<a class="readmore read-morestudy_block_notes'.$sb->id.'" onclick="return readMoreContent('.$typee.','.$sb->id.');"> Read more</a><span class="show-morestudy_block_notes'.$sb->id.'" style="display: none;">'.substr($sb->notes,80).' <a class="readless read-lessstudy_block_notes'.$sb->id.'" onclick="return readLess('.$typee.','.$sb->id.');">Read less</a></span>';
										}
										else
										{
											print($sb->notes);
										}
						  		?>
						  		</span><?php
								}else{
									?><span class="text-fade font-size-14">When you have a dream, you've got to grab it and never let go.</span><?php
								}
								?>						  	
						  </ul> 						  
						  <?php
						  if($sb->files){
						  	$files = explode(', ', $sb->files);
						  	if($files){
						  		?>
						  		<br><br>
								  <ul class="list-inline mb-0 ml-10 mr-5">
									  <span class="text-success font-size-16 study_block-files">Attached Files : </span>	
									</ul>
							  	<ul>
							  		<?php
							  		foreach ($files as $study_block_files) {
							  			?>
							  			<li title="Files"><?php echo $study_block_files; ?></li>
							  			<?php
							  		}
							  		?>
							  	</ul>
							  	<?php
						  	}						  	
						  }
						  ?>
						  <ul class="list-inline mb-0 mt-15 ml-30 mr-5 pull-right">
								<li>
									<i class="study_block-reminder text-fade" title="Reminder"><?php
							if($sb->reminder != 'No reminder'){
								?>
								<li>
									<i title="<?php echo $sb->reminder; ?>" class="mdi mdi-alarm text-fade"></i>
								</li>
								<?php
							}
							?></i>
								</li>
								<li>
									<a class="text-dark font-weight-bold study_block-start-date" href="#" data-toggle="tooltip" data-container="body" title="Start Date Time" data-original-title="Start Date Time"><?php echo date('h:i A', strtotime($sb->start_time)); ?>, <?php echo date('d M Y', strtotime($sb->start_date)); ?></a>
								</li>
								<li>
									<span title="task" class="badge badge-pill badge-success font-size-12 mb-0"><?php echo $sb_task->name; ?></span>
								</li>
						  </ul>
						</li>
					</ul>
				</div>				
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal View Study Block Details-->
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
						            $subjects1 = $this->Front_model->getSubjectByCid($pln->course_id);
						            if($subjects1){
						                foreach ($subjects1 as $sbj) {
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
											  	<ul class="list-files-block<?php echo $sb->id;?>">
											  		<?php
											  		$cnt=0;
											  		foreach ($files as $study_block_files) {
											  			?>
											  			<li title="Files" id="list_files<?php echo $sb->id;?><?php echo $cnt;?>">
											  				<?php echo $study_block_files; ?>
																&nbsp;&nbsp;<a class="text-fade font-size-16" href="#" onclick='deleteFile(<?php echo $sb->id.','.$cnt; ?>,"list");' title="Delete"><i class="fa fa-trash-o"></i></a>
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
			</form>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal Edit Study Block Details-->
				  			<?php
				  		}
				  		?>
				  		</ul>
				  		<?php
				  	}else{
							?>
				  			<div class="row">
				  				<div class="col-md-12">
					  				<div class="mt-40 text-center">
					  					<img class="w-p40" src="<?php echo base_url('assets/images/no-plan.png'); ?>">
					  					<h4 class="mt-20 text-success">You don't have any study block created yet.</h4>
					  					<button type="button" data-toggle="modal" data-target="#add-study-block" class="mr-5 btn btn-primary"><i class="fa fa-plus"></i> Add Study Block</button>
					  				</div>
					  			</div>
				  			</div>
				  		<?php
						}
				  	?>				  
				</div>
				<!-- /.box-body end list view -->
			</div>
			  </div>
			</div>
			<!-- <div class="col-xl-3 col-12">
					<?php
					include 'right_sidebar.php';
					?>
				</div> -->
		  </div>	
	</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
<!--Start Modal Add Study Block Details-->
	<div id="add-study-block" class="modal fade bs-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<form method="POST" name="study_block_form" id="study_block_form" class="study_block_form" autocomplete="off" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 title="Study Block" class="modal-title study-block" id="myLargeModalLabel"><strong>Add Study Block</strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
							<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Exam <span class="text-danger">*</span></label>
										<div class="input-group mb-3">
											<input type="text" value="<?php echo $sb_course->name; ?>" class="form-control" readonly>
											<input type="hidden" name="course_id" id="course_id" value="<?php echo $sb_course->id; ?>" required="">
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
							            if($subjects){
							                foreach ($subjects as $sbj) {
							                    ?>
							                    <option value="<?php echo $sbj->id; ?>"><?php echo $sbj->name; ?></option>
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
														?><option value="<?php echo $pt->id; ?>"><?php echo $pt->name; ?></option><?php
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
											<textarea name="notes" id="notes" class="form-control" placeholder="Notes.."></textarea>
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
											<input type="text" name="start_date" value="<?php echo date('m/d/Y');?>" id="start_date" class="form-control create_start_date" placeholder="Start date" required="">
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
											if($time_12hrs){
												foreach ($time_12hrs as $t12hrs) {
													?>
													<option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == '11:00 AM'){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
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
													<option value="<?php echo $dur->time; ?>"><?php echo $dur->time; ?></option>
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
												<option value="1">Yes</option>
												<option value="0">No</option>
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
												<option value="5 minutes before">5 minutes before</option>
												<option value="15 minutes before">15 minutes before</option>
												<option value="30 minutes before">30 minutes before</option>
												<option value="1 hour before">1 hour before</option>
												<option value="4 hours before">4 hours before</option>
												<option value="1 day before">1 day before</option>
												<option value="2 days before">2 days before</option>
												<option value="1 week before">1 week before</option>
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
											<input type="hidden" name="mentor_id" id="mentor_id" value="<?php echo $pln->mentor_id; ?>">
											<?php 
											if($pln_mentor && ($pln->mentor_request == 'accept')){
												?><input type="text" class="form-control" value="<?php echo $pln_mentor->first_name.' '.$pln_mentor->last_name; ?>" readonly><?php
											}else if($pln_mentor && ($pln->mentor_request == 'reject')){
												?><input type="text" class="form-control" value="Request Rejected" readonly><?php
											}else if($pln_mentor && ($pln->mentor_request == '')){
												?><input type="text" class="form-control" value="Request Pending" readonly><?php
											}else{
												?><input type="text" class="form-control" value="No Mentor Assigned" readonly><?php
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
										<span id="filesErr" class="text-danger"></span>
									</div>
								</div>
							</div>	
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer text-center">
								<input type="hidden" name="planner_id" id="planner_id" value="<?php echo $planner_id; ?>">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button type="submit" id="study_block_submit" class="btn btn-primary">Save</button>
								<img id="study_block_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
							</div>  
					</div>
				<!-- /.modal-content -->
				</form>
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal Add Study Block Details-->
<?php
include 'footer_bar.php';
?>

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
<script type="text/javascript">
    $(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});
</script>
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
