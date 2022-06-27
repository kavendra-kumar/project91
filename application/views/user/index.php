<!DOCTYPE html>
<html lang="en">
<?php
$title_name = 'Dashboard';  
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('assets/images/project91_Round_logo.png');?>">
    <title><?php echo $title_name; ?> | project91</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/vendor_components/bootstrap/dist/css/bootstrap.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/vendor_components/perfect-scrollbar/css/perfect-scrollbar.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/vendor_components/sweetalert/sweetalert.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/vendor_components/select2/dist/css/select2.min.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/vendor_components/bootstrap-daterangepicker/daterangepicker.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/vendor_components/fullcalendar/fullcalendar.min.css');?>">  
    <!-- Style-->  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/css/checkbox_style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/css/skin_color.css');?>">
    <!--custom css-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/dashboard/css/lib/control/iconselect.css');?>">
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
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-9 col-12">
					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="box bg-primary-light-cust">
								<div class="d-flex px-0">
									<div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md">
										<div class="row">
											<div class="col-12 col-xl-5">
												<h2>Welcome, <strong><?php echo $stud_del->first_name;?>!</strong></h2>
												<?php
												$student_id = $this->session->userdata('student_id');
												$total_tasks = $this->Front_model->getStudentTotalTasksCount($student_id);
												$comp_tasks = $this->Front_model->getStudentCompletedTasksCount($student_id);
												if($total_tasks){
													$task_percent = round(($comp_tasks/$total_tasks)*100);
													?>
													<p class="text-dark my-10 font-size-16">
														You completed <strong class="text-warning-cust">
														<?php echo $task_percent.'%'; ?>												
														</strong> of the tasks.
													</p>
													<?php
													$performance;
													if($task_percent<=29){
														$performance = 'Weak';
													}else if($task_percent>29 && $task_percent<=39){
														$performance = 'Average';
													}else if($task_percent>39 && $task_percent<=59){
														$performance = 'Satisfactory';
													}else if($task_percent>59 && $task_percent<=79){
														$performance = 'Good';
													}else if($task_percent>79 && $task_percent<=100){
														$performance = 'very Good';
													}
													?>
													<p class="text-dark my-10 font-size-16">
														Progress is <strong class="text-warning-cust"><?php echo $performance; ?>!</strong>
													</p>
												<?php
												}
												?>
											</div>
											<div class="col-12 col-xl-7">												
												<img class="dashboard-image" src="<?php echo base_url('assets/images/course.png'); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>						
					</div>
					<div class="row">
						<div class="col-12 col-xl-6">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">My tasks </h4>
									<ul class="box-controls pull-right d-md-flex d-none">
									  <li class="dropdown">
										<button class="btn btn-primary-cust px-10" onclick="window.location.href='<?php echo base_url("todo");?>'" >View All</button>
									  </li>
									</ul>
								</div>
								<div class="box-body p-10 task-section0">
				  <ul <?php if($this->uri->segment(2) != 'completed-tasks'){ echo 'class="todo-list all-tasks"'; }else{ echo 'class="todo-list-2 all-tasks"'; } ?>>
				  	<input type="hidden" name="complete_task" id="complete_task" value="">
				  	<?php
				  	if($tasks){
				  		foreach ($tasks as $tk) {
				  			$evt = $this->Front_model->getEventById($tk->event_id);
				  			?>
				  	<li class="p-0 mb-10 show-tasks<?php echo $tk->id; ?>">
					  <div class="box p-15 mb-0 d-block bb-2 border-lightgray">
						  <input type="hidden" class="task_id" value="<?php echo $tk->id; ?>">
						  <!-- checkbox -->
						  
						  
						  <!-- todo text -->
						  <span title="Title" class="text-line text-success font-size-14 font-weight-500"><a href="#" onclick="return viewTask(<?php echo $tk->id; ?>);">
						  <?php 
						  if(strlen($tk->task_name)>45)
							{
								print(substr($tk->task_name,0,45)."..");
							}
							else
							{
								print($tk->task_name);
							}
							?>
							</a></span>
						  <ul class="list-inline mb-0 mt-5">
							<li>
								<a class="text-fade font-size-12" href="#" data-toggle="tooltip" data-container="body" title="Start Date" data-original-title="Start Date">
									<i class="mdi mdi-calendar"></i> 
									<?php echo date('d M, Y', strtotime($tk->task_start_date));?>
								</a>
							</li>
							<li>
								<?php
								if($tk->priority == 'High Priority'){
									$badge_color = 'badge-danger';
									$badge_title = 'High Priority';
									$priority_icon = '2-removebg-preview.png';
								}else if($tk->priority == 'Medium Priority'){
									$badge_color = 'badge-warning';
									$badge_title = 'Medium Priority';
									$priority_icon = '3-removebg-preview.png';
								}else if($tk->priority == 'Low Priority'){
									$badge_color = 'badge-primary';
									$badge_title = 'Low Priority';
									$priority_icon = '4-removebg-preview.png';
								}else{
									$badge_color = 'badge-secondary';
									$badge_title = 'None';
									$priority_icon = '6-removebg-preview.png';
								}
								?>
								<span title="<?php echo $badge_title;?>"><img src="<?php echo base_url('assets/images/icons/'.$priority_icon);?>" width="15" height="15"></span>
							</li>
							<?php
							if($tk->task_reminder != 'No reminder'){
								?>
								<li>
									<i title="<?php echo $tk->task_reminder; ?>" class="mdi mdi-alarm text-fade"></i>
								</li>
								<?php
							}
							?>
							<li>
								<a class="text-fade" href="#" onclick="return viewTask(<?php echo $tk->id; ?>);" data-toggle="tooltip" data-container="body" title="" data-original-title="Comments">
									<i class="mdi mdi-comment"></i>
								</a>
							</li>
							<?php
							if($tk->is_completed == 'yes'){
								?>
									<li>
										<span class="badge badge-pill badge-success font-size-12 mb-0">Completed</span>
									</li>
									<?php
							}else{
								if(strtotime(date('Y-m-d')) > strtotime($tk->task_start_date)){
									?>
									<li>
										<span class="badge badge-pill badge-danger font-size-12 mb-0">Overdue</span>
									</li>
									<?php
								}else{
									?>
									<li>
										<span class="badge badge-pill badge-warning font-size-12 mb-0">Pending</span>
									</li>
									<?php
								}
							}							
							?>
						  </ul>

						</div>
					</li>
				  			<?php
				  		}
				  	}else{
				  		?>
				  		<h4 class="text-success text-center">No Tasks</h4>
				  		<?php
				  	}
				  	?>
				  </ul>
				</div>
							</div>
						</div>
						<div class="col-12 col-xl-6">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">My Events</h4>
									<ul class="box-controls pull-right d-md-flex d-none">
									  <li class="dropdown">
										<button class="btn btn-primary-cust px-10 " data-toggle="dropdown" type="button" onclick="window.location.href='<?php echo base_url("todo/events");?>'">View All</button>
									  </li>
									</ul>
								</div>
								<div class="box-body p-10">
				  <ul class="todo-list all-events">
				  	<input type="hidden" name="complete_task" id="complete_task" value="">
				  	<?php
				  	if($events5){
				  		foreach ($events5 as $evt) {
				  			?>
				  	<li class="p-0 mb-10 show-event<?php echo $evt->id;?>">
					  <div class="box p-15 mb-0 d-block bb-2 border-lightgray">
						 <!--  <input type="hidden" class="task_id" value="<?php echo $evt->id; ?>"> -->					  
						  <!-- todo text -->
						  <i class="<?php echo $evt->event_color?> fa fa-square-o mb-0 mr-5 ml-15"></i>
						  <span title="Title" class="text-line text-success font-size-14 font-weight-500"> <a href="#" data-toggle="modal" data-target="#view-event<?php echo $evt->id;?>">
						  <?php 
						  if(strlen($evt->event_name)>40)
							{
								print(substr($evt->event_name,0,40)."..");
							}
							else
							{
								print($evt->event_name);
							}
							?>
							</a></span>						  
						  <ul class="list-inline mb-0 mt-5 ml-30">						  	
							<li>
								<a class="text-fade font-size-12" href="#" data-toggle="tooltip" data-container="body" title="Start Date" data-original-title="Start Date">
									<i class="mdi mdi-calendar"></i> 
										<?php
										if($evt->event_start_date != $evt->event_end_date){
											echo date('d M, Y', strtotime($evt->event_start_date)).' - '.date('d M, Y', strtotime($evt->event_end_date));
										}else{
											echo date('d M, Y', strtotime($evt->event_start_date));
										}
									?>									
								</a>
							</li>
							<?php
							if($evt->event_reminder != 'No reminder'){
								?>
								<li>
									<i title="<?php echo $evt->event_reminder; ?>" class="mdi mdi-alarm text-fade"></i>
								</li>
								<?php
							}
							?>
							<span class="pull-right text-light font-size-12 mb-0">
							<?php 
							// if($evt->event_repeat_option){
							// 	echo $evt->event_repeat_option.' <i class="fa fa-circle"></i>';
							// }
							?>
							</span>
						  </ul>
						</div>
					</li>

<!--Start Modal View Event-->
	<div id="view-event<?php echo $evt->id;?>" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabelview-event<?php echo $evt->id;?>" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button title="Edit event" type="button" class="waves-effect waves-circle btn btn-circle btn-light-blue btn-xs mb-5" onclick="showeditEventModal(<?php echo $evt->id;?>);"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;
					<button title="Delete event" type="button" onclick="deleteEvent(<?php echo $evt->id;?>);" class="waves-effect waves-circle btn btn-circle btn-light-blue btn-xs mb-5 delete-event"><i class="fa fa-trash"></i></button>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>				
				<div class="modal-body">
						<div class="event-modal">
					    <div class="row first-row">
					        <div class="col-md-12">
					            <h3 class="event-title"><?php 
									  if(strlen($evt->event_name)>80)
										{
											$typee = "'event_name'";
											echo substr($evt->event_name,0,80).'<a class="readmore read-moreevent_name'.$evt->id.'" onclick="return readMoreContent('.$typee.','.$evt->id.');"> Read more</a><span class="show-moreevent_name'.$evt->id.'" style="display: none;">'.substr($evt->event_name,80).' <a class="readless read-lessevent_name'.$evt->id.'" onclick="return readLess('.$typee.','.$evt->id.');">Read less</a></span>';
										}
										else
										{
											print($evt->event_name);
										}
										?></h3>
					            <?php
									if($evt->event_allDay == 'true'){
										?>
										 <small class="event-datetime">
					            <i class="mdi mdi-calendar"></i> 
										<?php
										if($evt->event_start_date != $evt->event_end_date){
											echo date('l F d, Y', strtotime($evt->event_start_date)).' - '.date('l F d, Y', strtotime($evt->event_end_date));
										}else{
											echo date('l F d, Y', strtotime($evt->event_start_date));
										}
										?></small>
					            <br>
					            <br>
					            <small class="event-allday">All Day</small>
										<?php
									}else{
										?>
										 <small class="event-datetime">
					            <i class="mdi mdi-calendar"></i> 
										<?php
										if($evt->event_start_date != $evt->event_end_date){
											echo date('l F d, Y', strtotime($evt->event_start_date)).' '.date('h:i A', strtotime($evt->event_start_time)).' - '.date('l F d, Y', strtotime($evt->event_end_date)).' '.date('h:i A', strtotime($evt->event_end_time));
										}else{
											echo date('l F d, Y', strtotime($evt->event_start_date)).', '.date('h:i A', strtotime($evt->event_start_time)).' - '.date('h:i A', strtotime($evt->event_end_time));
										}
										?></small>
										<?php
									}
									?>
					        </div>
					    </div>
					    <br>
					    <br>
					    <div class="row second-row">
					        <?php
					        if($evt->event_note){
					        	?><div class="col-md-1"><i class="fa fa-align-left"></i></div>
					        <div class="col-md-11"><p class="event-note"><?php 
									  if(strlen($evt->event_note)>120)
										{
											$typee = "'event'";
											echo substr($evt->event_note,0,120).'<a class="readmore read-moreevent'.$evt->id.'" onclick="return readMoreContent('.$typee.','.$evt->id.');"> Read more</a><span class="show-moreevent'.$evt->id.'" style="display: none;">'.substr($evt->event_note,120).' <a class="readless read-lessevent'.$evt->id.'" onclick="return readLess('.$typee.','.$evt->id.');">Read less</a></span>';
										}
										else
										{
											print($evt->event_note);
										}
										?></p></div><?php
					        }
					        ?>
					        <div class="col-md-1"><i class="fa fa-bell-o"></i></div>
					        <div class="col-md-11"><p class="event-reminder"><?php echo $evt->event_reminder; ?></p></div>
					        <!-- <div class="col-md-1"><i class="fa fa-repeat"></i></div>
					        <div class="col-md-11"><p class="event-repeatoption"><?php echo $evt->event_repeat_option; ?></p></div> -->
					        <div class="col-md-1"><i class="fa fa-list"></i></div>
					        <div class="col-md-11"><p class="event-task">My event</p></div>
					        <input type="hidden" name="event_id" value="<?php echo $evt->id; ?>" />
					    </div>
						</div>
						<a type="button" data-toggle="modal" onclick="showEvent(<?php echo $evt->id; ?>); showPriority(1);" data-target="#add-task" class="btn btn-light pull-right my-10"> Add Task</a><br>
						<!-- Start Task Section of specific Event -->
						<div class="task-section<?php echo $evt->id;?>">
				  	<?php
				  	$student_id = $this->session->userdata('student_id');
				  	$tasks = $this->Front_model->getEventTasks($student_id,$evt->id);
				  	if($tasks){	
				  		$task_count = count($tasks);
				  		$comp_tasks = $this->Front_model->getCompletetaskCount($student_id,$evt->id);
				  		$task_percent = round(($comp_tasks/$task_count)*100);
				  		?>
				  		<hr>
				  		<h5 class="font-weight-500 ml-5">Tasks</h5>
				  		<div class="progress">
								<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated task-progress-bar<?php echo $evt->id;?>" role="progressbar" aria-valuenow="<?php echo $task_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $task_percent; ?>%">
								  <span class="sr-only<?php echo $evt->id;?>"><?php echo $task_percent; ?>% Complete</span>
								</div>
							</div>
				  <ul class="todo-list-2 slimtest5">
				  	<input type="hidden" name="complete_task" id="complete_task" value="">
				  		<?php
				  		$cnt=1;
				  		foreach ($tasks as $tk) {
				  			?>
				  	<li class="p-0 mb-10 show-task<?php echo $tk->id; ?>">
					  <div class="task-div box p-15 mb-0 d-block bb-2 border-lightgray">
						  <input type="hidden" class="task_id" value="<?php echo $tk->id; ?>">
						  <!-- checkbox -->
						  <?php
							if($tk->is_completed != 'yes'){
								?>
								<input type="checkbox" id="basic_checkbox_<?php echo $tk->id; ?>" class="filled-in chk-col-success" onclick="completeEventTask('#basic_checkbox_',<?php echo $tk->id; ?>,<?php echo $evt->id;?>);">
						  	<label for="basic_checkbox_<?php echo $tk->id; ?>" class="mb-0 h-15 ml-15"></label>
								<?php
							}else{
								?>
								<input type="checkbox" id="basic_checkbox_<?php echo $tk->id; ?>" class="filled-in chk-col-success" onclick="completeEventTask('#basic_checkbox_',<?php echo $tk->id; ?>,<?php echo $evt->id;?>);" checked>
						  	<label for="basic_checkbox_<?php echo $tk->id; ?>" class="mb-0 h-15 ml-15"></label>
								<?php
							}
							?>
						  <!-- todo text -->
						  <span title="<?php echo $tk->task_name;?>" class="text-line text-success font-size-14"><a href="#" onclick="return viewTask(<?php echo $tk->id; ?>);">
						  <?php 
						  if(strlen($tk->task_name)>38)
							{
								print(substr($tk->task_name,0,38)."..");
							}
							else
							{
								print($tk->task_name);
							}
							?>
							</a></span>
							<?php
							if($tk->is_completed == 'yes'){
								?>
								<span class="pull-right badge badge-pill badge-success font-size-12 mb-0">Completed</span>
								<?php
							}else{
								if(strtotime(date('Y-m-d')) > strtotime($tk->task_start_date)){
									?>
									<span class="pull-right badge badge-pill badge-danger font-size-12 mb-0">Overdue</span>
									<?php
								}else{
									?>
									<span class="pull-right badge badge-pill badge-warning font-size-12 mb-0">Pending</span>
									<?php
								}
							}
							?>
							<span class="pull-right mr-10">
							<span>
								<a class="text-fade" href="#" data-toggle="tooltip" data-container="body" title="Start Date" data-original-title="Start Date">
									<?php
									if($tk->task_allDay == 'true'){
										?>
										<i class="mdi mdi-calendar"></i> All day
										<?php
									}else{
										?>
									<i class="mdi mdi-calendar"></i> 
									<?php echo date('d M, Y', strtotime($tk->task_start_date));
									}
									?>
								</a>
						</span><span>
								<?php
								if($tk->priority == 'High Priority'){
									$badge_color = 'badge-danger';
									$badge_title = 'High Priority';
									$priority_icon = '2-removebg-preview.png';
								}else if($tk->priority == 'Medium Priority'){
									$badge_color = 'badge-warning';
									$badge_title = 'Medium Priority';
									$priority_icon = '3-removebg-preview.png';
								}else if($tk->priority == 'Low Priority'){
									$badge_color = 'badge-primary';
									$badge_title = 'Low Priority';
									$priority_icon = '4-removebg-preview.png';
								}else{
									$badge_color = 'badge-secondary';
									$badge_title = 'None';
									$priority_icon = '6-removebg-preview.png';
								}
								?>
								<span title="<?php echo $badge_title;?>"><img src="<?php echo base_url('/assets/images/icons/'.$priority_icon);?>" width="15" height="15"></span>
							</span>
							<span>
							<a class="text-fade" href="#" onclick="editModalTask(<?php echo $tk->id; ?>); showPriority(4);" data-toggle="tooltip" data-container="body" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
							&nbsp;<a class="text-fade" href="#" onclick="deleteTask(<?php echo $tk->id; ?>);" data-toggle="tooltip" data-container="body" title="" data-original-title="Remove"><i class="fa fa-trash-o"></i></a>
							</span>
						  </span>
						</div>
					</li>
				  			<?php
				  			$cnt++;
				  		}
				  		?>
				  </ul>
				  <?php
				  	}
				  	?>
				  </div>
				  <!-- End Task Section of specific Event -->
				</div>				
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<!-- End Modal View Event-->

				  			<?php
				  		}
				  	}else{
				  		?>
				  		<h4 class="text-success text-center">No Events</h4>
				  		<?php
				  	}
				  	?>
				  </ul>
				</div>
							</div>
						</div>
					</div>																			
				</div>
				<div class="col-xl-3 col-12">
					<?php
					include 'right_sidebar.php';
					?>
				</div>
				
			</div>
				<!--Start Modal View task Details-->
	<div id="view-task" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="background-color: #fbfbfb">
				<div class="modal-header">
					<h4 class="modal-title task-event" id="myModalLabel"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>				
				<div class="modal-body">
					<!-- checkbox -->
					<ul class="todo-list-2">
						<li class="p-0 mb-15">
						  <ul class="list-inline mb-0 ml-10 mr-5">
						  	<span title="Title" class="text-line font-size-16 task-name"></span>	
						  	<a class="edit-task-button text-fade pull-right" onclick="showEditModalTask(); showPriority(4);" href="#" title="Edit Task"><i class="fa fa-edit"></i></a>
						  </ul>
						  		<input type="hidden" name="task_id" id="task_id">			 
						  <ul class="list-inline mb-0 mt-10 ml-10 mr-5">
						  	<span title="note" class="text-fade font-size-14 task-note"></span>
						  </ul> 
						  <ul class="list-inline mb-0 mt-15 ml-30 mr-5 pull-right">
								<li>
									<i class="task-reminder text-fade" title=""></i>
								</li>
								<li>
									<a class="text-fade task-start-date" href="#" data-toggle="tooltip" data-container="body" title="Start Date" data-original-title="Start Date"></a>
								</li>
								<li>
									<span class="task-allday"></span>
								</li>
								<li>
									<span class="task-priority"></span>
								</li>
						  </ul>
						</li>
					</ul>
					<div class="box-footer no-border">
						<div class="box bt-3 border-success mb-10">
				  		<div class="box-body task-comment-div" id="task_comment_scroll"></div>
							</div>
						 	<form class="task-comment" id="task-comment" autocomplete="off">
						 		<div class="d-md-flex d-block justify-content-between align-items-center bg-white p-5 rounded10 b-1 overflow-hidden border-success">
						 			<input type="hidden" name="task_id" class="comment_task_id">
									<input type="text" name="comment" class="form-control b-0 py-10" placeholder="Write a comment" rows=1 style="width: 78%;" required="">
									<div class="d-flex justify-content-between align-items-center mt-md-0 mt-30">
										<button type="submit" class="btn btn-primary btn-sm">
											Add Comment
										</button>
									</div>
									<span class="text-danger" id="commentErr"></span>
								</div>
						 	</form>
						</div>
				</div>				
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal View task Details-->

	<!--Start Modal Edit Task-->
	<div id="edit-task" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form method="POST" name="edit-task-form" id="edit-task-form" class="edit-task-form" autocomplete="off">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Edit Task</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>				
				<div class="modal-body">
					<div class="panel b-1 p-5 mb-10 rounded10" style="border-color: #86a4c3 !important;">
						<div class="form-group form-element">
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="task_name" placeholder="Title" required="">
						</div>
					</div>
					<div class="form-group form-element">
						<div class="input-group mb-3">
							<textarea class="form-control" name="task_note" placeholder="Any Note..."></textarea>
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker2" required="">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group" id="task-time-section1">
								<div class="input-group mb-3">
									<select id="task_start_time" name="task_start_time" class="form-control task_update_event_start_time select2" style="width: 100%;" required="">
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
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mt-5">
								<input type="checkbox" name="task_allDay" id="task_allDay1" class="filled-in chk-col-success">
								<label class="control-label" for="task_allDay">All Day</label>
								<span id="task_allDayErr" class="text-danger"></span>
							</div>
						</div>
						<div class="col-md-3">
	            <div class="form-group" style="width: 85%; margin-left: -24px;">
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="selected-text4" name="priority" readonly="" placeholder="set priority" required="">
									<div class="input-group-append">
										<div class="input-group-text" id="my-icon-select4"></div>
									</div>
								</div>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<div class="input-group mb-3">
									<select id="event_id" name="event_id" class="form-control select2" style="width: 100%;">
										<option value="0">Select Event</option>
										<?php
										if($events){
											foreach ($events as $evt) {
												?>
												<option value="<?php echo $evt->id; ?>"><?php echo $evt->event_name; ?></option>
												<?php
											}
										}
										?>
								  	</select>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="task_category" placeholder="Category">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group mb-3">
							  	<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
									</div>
									<select id="task_reminder" name="task_reminder" class="form-control">
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
								</div>
								<span id="task_reminderErr" class="text-danger"></span>
							</div>
						</div>
					</div>	
					<input type="hidden" name="task_id">	
					<input type="hidden" name="hidden_event_id">					
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>				
			</div>
			</form>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal Edit Task-->

			<!-- Start Modal Update Event -->
<div class="modal fade none-border" data-backdrop="static" id="update-event">
		<div class="modal-dialog">
			<form class="update-category" method="post" autocomplete="off">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Update</strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Title <span class="text-danger">*</span></label>
									<div class="input-group">
										<input class="form-control form-white" placeholder="Enter name" type="text" name="event_name" required="" />
										<div class="input-group-addon">
											<i class="fa fa-tasks"></i>
										</div>
									</div>
									<span id="event_nameErr" class="text-danger"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Color <span class="text-danger">*</span></label>
									<div class="input-group">
										<select class="form-control form-white" data-placeholder="Choose a color..." name="event_color" required="">
											<option value="">Select</option>
											<option class="bg-success" value="bg-success">Green</option>
											<option class="bg-danger" value="bg-danger">Red</option>
											<option class="bg-info" value="bg-info">Light Blue</option>
											<option class="bg-primary" value="bg-primary">Dark Blue</option>
											<option class="bg-warning" value="bg-warning">Orange</option>
											<option class="bg-dark" value="bg-dark">None</option>
										</select>
										<div class="input-group-addon">
											<i class="fa fa-paint-brush"></i>
										</div>
									</div>
									<span id="event_colorErr" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="tab-content">
							<div id="event-1">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
												<textarea class="form-control form-white" placeholder="Add Note" name="event_note"></textarea>
												<div class="input-group-addon">
													<i class="fa fa-info"></i>
												  </div>
											</div>
											<span id="event_noteErr" class="text-danger"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
											  <input type="text" name="event_start_end_date" class="form-control" id="reservation1" required="">	
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>	
											</div>
											<span id="event_start_end_dateErr" class="text-danger"></span>
											<!-- /.input group -->
										 </div>
									</div>
								</div>
								<div class="row" id="date-time-section1">
									<div class="col-md-6">
										<div class="bootstrap-timepicker">
											<div class="form-group">
											<div class="input-group mb-3">
												<select id="event_start_time" name="event_start_time" class="form-control update_event_start_time select2" style="width: 86%;">
												<?php
													if($time_12hrs){
														foreach ($time_12hrs as $t12hrs) {
															?>
															<option value="<?php echo $t12hrs->time; ?>"><?php echo $t12hrs->time; ?></option>
															<?php
														}
													}
												?>
											  	</select>
											  <div class="input-group-addon">
												<i class="fa fa-clock-o"></i>
											  </div>
											</div>
											  <span id="event_start_timeErr" class="text-danger"></span>
											<!-- /.input group -->
										 </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="bootstrap-timepicker">
											<div class="form-group">
											<div class="input-group">
												<select id="event_end_time" name="event_end_time" class="form-control select2" style="width: 86%;">
												<?php
													if($time_12hrs){
														foreach ($time_12hrs as $t12hrs) {
															?>
															<option value="<?php echo $t12hrs->time; ?>"><?php echo $t12hrs->time; ?></option>
															<?php
														}
													}
												?>
											  	</select>
											  	<div class="input-group-addon">
													<i class="fa fa-clock-o"></i>
											  	</div>
											</div>
											  <span id="event_end_timeErr" class="text-danger"></span>
											<!-- /.input group -->
										 </div>
										</div>
									</div>
								</div>					
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group mb-3">
												<select id="event_repeat_option" name="event_repeat_option" class="form-control" onchange="showEndDate(this.value);">
												<option value="Does not repeat">Does not repeat</option>
												<option value="Daily">Daily</option>
												<!-- <option value="Weekly">Weekly</option>
												<option value="Monthly">Monthly</option>
												<option value="Annually">Annually</option>
												<option value="Every Weekday">Every Weekday</option> -->
											  	</select>
											  	<div class="input-group-append">
													<span class="input-group-text"><i class="fa fa-repeat"></i></span>
												</div>
											</div>
											  	<span id="event_repeat_optionErr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mt-2">
											<input type="checkbox" name="event_allDay" id="event_allDay1" class="filled-in chk-col-success">
											<label class="control-label" for="event_allDay1">All Day</label>
											<span id="event_allDayErr" class="text-danger"></span>
										</div>
									</div>
								</div>	
								<div class="row end-date-class" style="display: none;">
								<div class="col-md-12">
									<div class="form-group">
										<label>End date</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="end_date" id="datepicker">
											<div class="input-group-append">
												<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
											</div>
										</div>
									</div>
								</div>
							</div>						
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group mb-3">
												<select id="event_reminder" name="event_reminder" class="form-control">
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
													<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
												</div>
											</div>
											  	<span id="event_reminderErr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="checkbox" name="draggable_event" id="draggable_event1" class="filled-in chk-col-success" checked="">
											<label class="control-label" for="draggable_event1">Draggable Event</label>
											<span id="draggable_eventErr" class="text-danger"></span>
										</div>
									</div>
								</div>	
							</div>
						</div>
						<input type="hidden" name="draggable_id" id="draggable_id">
						<input type="hidden" name="type" id="type" value="event">
						<input type="hidden" name="event_id" id="event_id">		

				<br>
					<div class="event-task-panel">
						<button class="btn btn-light event-add-task" onclick="showPriority(2);" type="button">Add task</button>
						<div class="panel add-task-panel" style="display:none;">
							<div class="panel-body">
								<div class="panel b-1 p-5 mb-10 rounded10" style="border-color: #86a4c3 !important;">
									<div class="form-group form-element">
									<div class="input-group mb-3">
										<input type="text" class="form-control" name="task_name" placeholder="Title">
									</div>
								</div>
								<div class="form-group form-element">
									<div class="input-group mb-3">
										<textarea class="form-control" name="task_note" placeholder="Any Note..."></textarea>
									</div>
								</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<div class="input-group mb-3">
												<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group" id="task-time-section2">
											<div class="input-group mb-3">
												<select id="task_start_time" name="task_start_time" class="form-control task_create_event_start_time select2" style="width: 100%;">
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
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group mt-5">
											<input type="checkbox" name="task_allDay" id="task_allDay2" class="filled-in chk-col-success">
											<label class="control-label" for="task_allDay2">All Day</label>
											<span id="task_allDayErr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-md-3">
				            <div class="form-group" style="width: 85%; margin-left: -24px;">
											<div class="input-group mb-3">
												<input type="text" class="form-control" id="selected-text2" name="priority" readonly="" placeholder="set priority">
												<div class="input-group-append">
													<div class="input-group-text" id="my-icon-select2"></div>
												</div>
											</div>
										</div>
									</div>
								</div>					
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group mb-3">
												<input type="text" class="form-control" name="task_category" placeholder="Category">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group mb-3">
										  	<div class="input-group-append">
													<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
												</div>
												<select id="task_reminder" name="task_reminder" class="form-control">
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
											</div>
											<span id="task_reminderErr" class="text-danger"></span>
										</div>
									</div>
								</div>					
							</div>
						</div>
				</div>
			</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>					
					<button type="submit" class="btn btn-primary update-event-btn save-category">Update</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- END MODAL update event -->
		<!--Start Modal Add Task-->
	<div id="add-task" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabeladd-task" aria-hidden="true">
		<div class="modal-dialog">
			<form method="POST" name="add-task-form" id="add-task-form" class="add-task-form" autocomplete="off">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabeladd-task">Add Task</h4>
					<button type="button" class="close" onclick="closeModal('#add-task');" aria-hidden="true">×</button>
				</div>				
				<div class="modal-body">
					<div class="panel b-1 p-5 mb-10 rounded10" style="border-color: #86a4c3 !important;">
						<div class="form-group form-element">
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="task_name" placeholder="Title" required="">
						</div>
					</div>
					<div class="form-group form-element">
						<div class="input-group mb-3">
							<textarea class="form-control" name="task_note" placeholder="Any Note..."></textarea>
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker1" required="">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group" id="task-time-section">
								<div class="input-group mb-3">
									<select id="task_start_time" name="task_start_time" class="form-control task_create_event_start_time select2" style="width: 100%;" required="">
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
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group mt-5">
								<input type="checkbox" name="task_allDay" id="task_allDay" class="filled-in chk-col-success">
								<label class="control-label" for="task_allDay">All Day</label>
								<span id="task_allDayErr" class="text-danger"></span>
							</div>
						</div>
						<div class="col-md-3">
	            <div class="form-group" style="width: 85%; margin-left: -24px;">
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="selected-text1" name="priority" readonly="" placeholder="set priority" required="">
									<div class="input-group-append">
										<div class="input-group-text" id="my-icon-select1"></div>
									</div>
								</div>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<div class="input-group mb-3">
									<select id="event_id" name="event_id" class="form-control select2" style="width: 100%;">
										<option value="0">Select Event</option>
										<?php
										if($events){
											foreach ($events as $evt) {
												?>
												<option value="<?php echo $evt->id; ?>"><?php echo $evt->event_name; ?></option>
												<?php
											}
										}
										?>
								  	</select>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="task_category" placeholder="Category">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group mb-3">
							  	<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
									</div>
									<select id="task_reminder" name="task_reminder" class="form-control">
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
								</div>
								<span id="task_reminderErr" class="text-danger"></span>
							</div>
						</div>
					</div>					
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default" onclick="closeModal('#add-task');">Cancel</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>				
			</div>
			</form>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- End Modal Add Task-->
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

<?php
// include 'chatbox.php';
?>	
<script src="<?php echo base_url('assets/js/vendors.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/select2/dist/js/select2.full.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/jquery-ui/jquery-ui.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/moment/min/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/fullcalendar/fullcalendar.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/fullcalendar/lib/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/fullcalendar/fullcalendar.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/sweetalert/sweetalert.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/template.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/js/pages/custom-scroll.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/dashboard/js/pages/advanced-form-element.js');?>"></script>
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
<!--custom js-->
<script src="<?php echo base_url('assets/js/lib/control/iconselect.js');?>"></script>
<script src="<?php echo base_url('assets/js/lib/iscroll.js');?>"></script>
<script type="text/javascript">      
function showPriority(i){
		var iconSelect;
		var selectedText;
    selectedText = document.getElementById('selected-text'+i);
    
    document.getElementById('my-icon-select'+i).addEventListener('changed', function(e){
       selectedText.value = iconSelect.getSelectedValue();
    });

    iconSelect = new IconSelect("my-icon-select"+i, 
        {'selectedIconWidth':30,
        'selectedIconHeight':30,
        'selectedBoxPadding':1,
        'iconsWidth':23,
        'iconsHeight':23,
        'boxIconSpace':1,
        'vectoralIconNumber':4,
        'horizontalIconNumber':4});

    var icons = [];
    icons.push({'iconFilePath':'<?php echo base_url('assets/images/icons/2-removebg-preview.png');?>', 'iconValue':'High Priority'});
    icons.push({'iconFilePath':'<?php echo base_url('assets/images/icons/3-removebg-preview.png');?>', 'iconValue':'Medium Priority'});
    icons.push({'iconFilePath':'<?php echo base_url('assets/images/icons/4-removebg-preview.png');?>', 'iconValue':'Low Priority'});
    icons.push({'iconFilePath':'<?php echo base_url('assets/images/icons/6-removebg-preview.png');?>', 'iconValue':'None'});
    
    iconSelect.refresh(icons);
};    
</script>
<!--ends custom js-->
<script type="text/javascript">
	function showEndDate(value) 
	{
		if(value == 'Daily'){
			$('.end-date-class').css('display','block');
		}else{
			$('.end-date-class').css('display','none');
		}
	}
</script>	
</body>
</html>
