<!DOCTYPE html>
<html lang="en">
<?php 
$title_name = 'Study Allocator'; 
$student_id = $this->session->userdata('student_id');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('assets/images/project91_Round_logo.png');?>">
    <title>My Plans | <?php echo $title_name; ?> | project91</title>
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
    <style type="text/css">
    	.select2-results__options > li[id$='9999']{
    		color: #ffffff;
    		font-weight: 600;
    		background-color: #336e6a;
    	}
    </style> 
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
			<div class="col-xl-9 col-12">
			  <div class="box">
				<div class="box-header with-border">
				 	<span class="total-task-count pull-left font-size-16 mt-10">
					 	<span class="font-weight-bold">
					 		<h5 class="box-title">My Plans</h5>
					 	</span>
					</span>
					<?php
					if($planner){
						?>
					<button type="button" title="Refresh" onclick="window.location.reload();" class="waves-effect btn btn-light mb-5 pull-right">Refresh</button>
					<button type="button" data-toggle="modal" data-target="#create-planner" class="mr-5 btn btn-primary pull-right"><i class="fa fa-plus"></i> Create a Plan</button>
					<?php
					}
					?>					
					</div>		
					<?php
					if($planner){
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
						<!-- Start Card View -->
						<div class="box-body p-10 tab-pane active" id="card-view">
							<div class="row">		
								<?php
				  	if($planner){
				  		foreach ($planner as $pln) {
				  			$planner_id = $pln->id;
				  			$course_name = $this->Front_model->getCourseById($pln->course_id);
				  			?>
								<div class="col-md-12 col-lg-4 show-planner<?php echo $planner_id;?>">		
									<div class="card">
									  <div class="card-body">
											<h4 class="card-title">
												<span title="<?php echo $pln->title; ?>" class="text-line text-success font-size-14 font-weight-500"><a href="<?php echo base_url('study-blocks/'.$planner_id); ?>">
													<?php 
												  if(strlen($pln->title)>26)
													{
														print(substr($pln->title,0,26)."..");
													}
													else
													{
														print($pln->title);
													}
													?>
												</a></span>
											</h4>
											<div class="tools pull-right">
												<a class="text-fade" href="<?php echo base_url('study-blocks/'.$planner_id); ?>" title="Open Planner"><i class="fa fa-external-link"></i></a>
												&nbsp;<a class="text-fade" data-toggle="modal" data-target="#edit-planner<?php echo $planner_id;?>" href="#" title="Edit"><i class="fa fa-edit"></i></a>
												&nbsp;<a class="text-fade" href="#" onclick="deletePlanner(<?php echo $planner_id; ?>);" title="Remove"><i class="fa fa-trash-o"></i></a>
											</div>
											<div class="d-flex">
											<?php
											if($pln->mentor_id && ($pln->mentor_request == 'accept')){
												?>
													<span class="avatar-group mr-10">
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
											<p class="card-text text-fade"><?php echo $course_name->name; ?></p>
										</div>
										<!--Start Modal Edit planner Details-->
<div id="edit-planner<?php echo $planner_id;?>" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 title="Edit Planner" class="modal-title planner" id="myModalLabel"><strong>Edit Planner</strong></h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		</div>
		<form method="POST" name="edit_planner_form" id="edit_planner_form<?php echo $planner_id;?>" class="edit_planner_form" onsubmit="return editPlanner(<?php echo $planner_id;?>);" autocomplete="off" enctype="multipart/form-data">				
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Title <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input type="text" name="title" value="<?php echo $pln->title; ?>" id="title" class="form-control" placeholder="Add Title" required="">
								<div class="input-group-append">
									<span class="input-group-text"><i class="ti-info"></i></span>
								</div>
							</div>
							<span id="titleErr" class="text-danger"></span>
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Exam <span class="text-danger">*</span></label>
							<div class="input-group">
								<input type="text" value="<?php echo $course_name->name; ?>" class="form-control" readonly>
									<input type="hidden" name="course_id" id="course_id" value="<?php echo $pln->course_id; ?>" required="" >
								<div class="input-group-append">
									<span class="input-group-text"><i class="ti-agenda"></i></span>
								</div>
							</div>
							<span id="course_idErr" class="text-danger"></span>
						</div>
					</div>
				</div>		
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Mentor </label>
							<div class="input-group mb-3">
								<select id="mentor_id" name="mentor_id" class="form-control select2" onchange="inviteBox(this.value, <?php echo $planner_id;?>);" style="width:93%;">
									<option value="">Select Mentor</option>
									<?php
									if($mentor){
										foreach ($mentor as $mn) {
											?><option value="<?php echo $mn->reg_id;?>" <?php if($mn->reg_id == $pln->mentor_id){ echo "selected"; } ?>><?php echo $mn->first_name.' '.$mn->last_name;?></option><?php
										}
									}
									?>
									<!-- <option value="9999">Invite Mentor</option> -->
								</select>
								<div class="input-group-append">
									<span class="input-group-text"><i class="ti-user"></i></span>
								</div>
							</div>
							<span id="mentor_idErr" class="text-danger"></span>
						</div>
					</div>
				</div>				
				<div class="row invite_div<?php echo $planner_id;?>" style="display: none;">
					<div class="col-md-12">
						<div class="form-group">
							<label>Mentor Email Address <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input type="text" name="email_address" id="email_address" class="form-control" placeholder="Enter Mentor Email Address">
								<div class="input-group-append">
									<span class="input-group-text"><i class="ti-email"></i></span>
								</div>
							</div>
							<span id="email_addressErr" class="text-danger"></span>
						</div>
					</div>
				</div>				
			</div>
			<div class="box-footer text-center">
				<input type="hidden" name="planner_id" id="planner_id" value="<?php echo $pln->id; ?>" class="form-control">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" id="edit_planner_submit<?php echo $planner_id; ?>" class="btn btn-primary">Update</button>
				<img id="edit_planner_loader<?php echo $planner_id; ?>" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
			</div>	
		</form>	
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- End Modal Edit planner Details-->
									  </div>
									</div>
								</div>
								<!-- /.col -->

								<?php
							}
						}else{
							?>
				  			<div class="col-md-12">
				  				<div class="mt-40 text-center">
				  					<img class="w-p40" src="<?php echo base_url('assets/images/no-plan.png'); ?>">
				  					<h4 class="mt-20 text-success">You don't have any plans created yet.</h4>
				  					<button type="button" data-toggle="modal" data-target="#create-planner" class="mr-5 btn btn-primary"><i class="fa fa-plus"></i> Create a Plan</button>
				  				</div>
				  			</div>
				  		<?php
						}
								?>
							  </div>
						</div>
						<!-- End Card View -->

						<!-- Start List View -->
						<div class="box-body p-10 tab-pane" id="list-view">
				  		<ul class="todo-list">
				  	<?php
				  	if($planner){
				  		foreach ($planner as $pln) {
				  			$planner_id = $pln->id;
				  			$course_name = $this->Front_model->getCourseById($pln->course_id);
				  			?>
				  	<li class="p-0 mb-10 show-planner<?php echo $planner_id;?>">
					  <div class="box p-15 mb-0 d-block bb-2 border-lightgray">
						  <i class="bg-primary fa fa-square-o mb-0 mr-5 ml-15"></i>
						  <span title="Open Planner" class="text-line text-success font-size-14 font-weight-500"> 
							  <a href="<?php echo base_url('study-blocks/'.$planner_id); ?>">
						  	<?php echo $pln->title; ?>
							</a></span>	
							<div class="tools">
							<a class="text-fade" href="<?php echo base_url('study-blocks/'.$planner_id); ?>" title="Open Planner"><i class="fa fa-external-link"></i></a>
							&nbsp;<a class="text-fade" data-toggle="modal" data-target="#edit-planner<?php echo $planner_id;?>" href="#" title="Edit"><i class="fa fa-edit"></i></a>
							&nbsp;<a class="text-fade" href="#" onclick="deletePlanner(<?php echo $planner_id; ?>);" title="Remove"><i class="fa fa-trash-o"></i></a>
						  </div>
						</div>
					</li>
<!--Start Modal Edit planner Details-->
<div id="edit-planner<?php echo $planner_id;?>" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 title="Edit Planner" class="modal-title planner" id="myModalLabel"><strong>Edit Planner</strong></h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		</div>
		<form method="POST" name="edit_planner_form" id="edit_planner_form<?php echo $planner_id;?>" class="edit_planner_form" onsubmit="return editPlanner(<?php echo $planner_id;?>);" autocomplete="off" enctype="multipart/form-data">				
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Title <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input type="text" name="title" value="<?php echo $pln->title; ?>" id="title" class="form-control" placeholder="Add Title" required="">
								<div class="input-group-append">
									<span class="input-group-text"><i class="ti-info"></i></span>
								</div>
							</div>
							<span id="titleErr" class="text-danger"></span>
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Exam <span class="text-danger">*</span></label>
							<div class="input-group">
								<input type="text" value="<?php echo $course_name->name; ?>" class="form-control" readonly>
									<input type="hidden" name="course_id" id="course_id" value="<?php echo $pln->course_id; ?>" required="" >
								<div class="input-group-append">
									<span class="input-group-text"><i class="ti-agenda"></i></span>
								</div>
							</div>
							<span id="course_idErr" class="text-danger"></span>
						</div>
					</div>
				</div>		
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Mentor </label>
							<div class="input-group mb-3">
								<select id="mentor_id" name="mentor_id" class="form-control select2" onchange="inviteBox(this.value, <?php echo $planner_id;?>);" style="width:93%;">
									<option value="">Select Mentor</option>
									<?php
									if($mentor){
										foreach ($mentor as $mn) {
											?><option value="<?php echo $mn->reg_id;?>" <?php if($mn->reg_id == $pln->mentor_id){ echo "selected"; } ?>><?php echo $mn->first_name.' '.$mn->last_name;?></option><?php
										}
									}
									?>
									<!-- <option value="9999">Invite Mentor</option> -->
								</select>
								<div class="input-group-append">
									<span class="input-group-text"><i class="ti-user"></i></span>
								</div>
							</div>
							<span id="mentor_idErr" class="text-danger"></span>
						</div>
					</div>
				</div>				
				<div class="row invite_div<?php echo $planner_id;?>" style="display: none;">
					<div class="col-md-12">
						<div class="form-group">
							<label>Mentor Email Address <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input type="text" name="email_address" id="email_address" class="form-control" placeholder="Enter Mentor Email Address">
								<div class="input-group-append">
									<span class="input-group-text"><i class="ti-email"></i></span>
								</div>
							</div>
							<span id="email_addressErr" class="text-danger"></span>
						</div>
					</div>
				</div>				
			</div>
			<div class="box-footer text-center">
				<input type="hidden" name="planner_id" id="planner_id" value="<?php echo $pln->id; ?>" class="form-control">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="submit" id="edit_planner_submit<?php echo $planner_id; ?>" class="btn btn-primary">Update</button>
				<img id="edit_planner_loader<?php echo $planner_id; ?>" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
			</div>	
		</form>	
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- End Modal Edit planner Details-->
				  			<?php
				  		}
				  	}else{
				  		?>
				  		<div class="col-md-12">
				  				<div class="mt-40 text-center">
				  					<img class="w-p40" src="<?php echo base_url('assets/images/no-plan.png'); ?>">
				  					<h4 class="mt-20 text-success">You don't have any plans created yet.</h4>
				  					<button type="button" data-toggle="modal" data-target="#create-planner" class="mr-5 btn btn-primary"><i class="fa fa-plus"></i> Create a Plan</button>
				  				</div>
				  			</div>
				  		<?php
				  	}
				  	?>
				  </ul>
				</div>
				<!-- /.End List View -->
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
	<!--Start Modal Add planner Details-->
	<div id="create-planner" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 title="Planner" class="modal-title planner" id="myModalLabel"><strong>Create Planner</strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form method="POST" name="planner_form" id="planner_form" class="planner_form" autocomplete="off" enctype="multipart/form-data">				
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Title <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<input type="text" name="title" id="title" class="form-control" placeholder="Add Title" required="">
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-info"></i></span>
										</div>
									</div>
									<span id="titleErr" class="text-danger"></span>
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Exam <span class="text-danger">*</span></label>
									<div class="input-group">
										<input type="text" value="<?php echo $sb_course->name; ?>" class="form-control course_name_class" readonly>
											<input class="course_id_class" type="hidden" name="course_id" id="course_id" value="<?php echo $sb_course->id; ?>" required="" >
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-agenda"></i></span>
										</div>
									</div>
									<a class="text-primary font-weight-bold" href="#" onclick="showHideExamPanel();">Change Exam</a>
									<span id="course_idErr" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="modal-body b-2 border-lightgray mb-10" id="exam-panel" style="background-color: #fafbfd; display: none;">
							<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label>Exam <span class="text-danger">*</span></label>
								<div class="input-group mb-3">
									<select id="course" name="course" class="form-control" required="" onchange="changeExam(this.value);">
									<option value="">Select Exam</option>
									<?php
									if($active_courses){
										foreach ($active_courses as $ac) {
											?><option name="<?php echo $ac->name;?>" value="<?php echo $ac->id;?>" <?php if($sc->course_id == $ac->id){ echo 'selected'; } ?>><?php echo $ac->name;?></option><?php
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
									<option value="yes" <?php if($sc->is_scheduled == 'yes'){ echo 'selected'; } ?>>Yes</option>
									<option value="no" <?php if($sc->is_scheduled == 'no'){ echo 'selected'; } ?>>No</option>
								  	</select>
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-marker-alt"></i></span>
									</div>
								</div>
							</div>
							</div>
							</div>
							<?php 
							if($sc->is_scheduled == 'yes')
							{ 
								$exam_date = $sc->exam_date; //  Y-m-d          
							    $exam_date = date("m/d/Y", strtotime($exam_date)); // m/d/Y
							}else{
								$exam_date = date('m/d/Y');
							} 
							?>
							<div class="form-group" id="exam_date_field" <?php if($sc->is_scheduled == 'no'){ echo 'style="display: none;"'; } ?>>
								<label>Exam Date <span class="text-danger">*</span></label>
								<div class="input-group mb-3">
									<input class="form-control exam_date_class" type="text" value="<?php echo $exam_date; ?>" id="example-date-input" name="exam_date">
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
											?><option value="<?php echo $acl->id;?>" <?php if($sc->confidence_level_id == $acl->id){ echo 'selected'; } ?>><?php echo $acl->level;?></option><?php
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
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Mentor </label>
									<div class="input-group mb-3">
										<select id="mentor_id" name="mentor_id" class="form-control select2" style="width:93%;" onchange="inviteBox(this.value,9999);">
											<option value="">Select Mentor</option>
											<?php
											if($mentor){
												foreach ($mentor as $mn) {
													?><option value="<?php echo $mn->reg_id;?>"><?php echo $mn->first_name.' '.$mn->last_name;?></option><?php
												}
											}
											?>
											<!-- <option value="9999">Invite Mentor</option> -->
										</select>
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-user"></i></span>
										</div>
									</div>
									<span id="mentor_idErr" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="row invite_div9999" style="display: none;">
							<div class="col-md-12">
								<div class="form-group">
									<label>Mentor Email Address <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<input type="text" name="email_address" id="email_address" class="form-control" placeholder="Enter Mentor Email Address">
										<div class="input-group-append">
											<span class="input-group-text"><i class="ti-email"></i></span>
										</div>
									</div>
									<span id="email_addressErr" class="text-danger"></span>
								</div>
							</div>
						</div>					
					</div>
					<div class="box-footer text-center">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="submit" id="planner_submit" class="btn btn-primary">Save</button>
						<img id="planner_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
					</div>	
				</form>	
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal Add planner Details-->
<!-- <?php
include 'footer_bar.php';
?> -->

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
<script type="text/javascript">
	function showHideExamPanel() 
	{
		if($('#exam-panel').is(":hidden")){
			$('#exam-panel').css('display','block');
		}
	}

	function changeExam(value) 
	{
		if(value){
			var name = $('#course').find('option:selected').attr("name");		
		$('.course_id_class').val(value);
		$('.course_name_class').val(name);
	}		
	}
</script>
</body>
</html>
