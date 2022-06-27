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
					<div class="box bg-primary-light-cust">
						<div class="box-body d-flex px-0">
							<div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md bg-style">
								<div class="row">
									<div class="col-12 col-xl-7">
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
									<div class="col-12 col-xl-5"></div>
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
									<?php echo date('d M', strtotime($tk->task_start_date));?>
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
				  	<li class="p-0 mb-10">
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
											echo date('d M', strtotime($evt->event_start_date)).' - '.date('d M', strtotime($evt->event_end_date));
										}else{
											echo date('d M', strtotime($evt->event_start_date));
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
					<button title="Delete event" type="button" class="waves-effect waves-circle btn btn-circle btn-light-blue btn-xs mb-5 delete-event"><i class="fa fa-trash"></i></button>
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
									<?php echo date('d M', strtotime($tk->task_start_date));
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
					<div class="form-group">
						<label>Title</label>
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="task_name" placeholder="Title" required="">
							<div class="input-group-append">
								<span class="input-group-text"><i class="ti-text"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Note</label>
						<div class="input-group mb-3">
							<textarea class="form-control" name="task_note" placeholder="Any Note..."></textarea>
							<div class="input-group-append">
								<span class="input-group-text"><i class="ti-info"></i></span>
							</div>
						</div>
					</div>
					<div class="row">
          	<div class="col-md-6">
	            <div class="form-group" style="width: 85%;">
								<label>Set Priority</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="selected-text4" name="priority" readonly="" placeholder="set priority" required="">
									<div class="input-group-append">
										<div class="input-group-text" id="my-icon-select4"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Add Reminder</label>
								<div class="input-group mb-3">
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
								  	<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
									</div>
								</div>
								  	<span id="task_reminderErr" class="text-danger"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Start date</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker2" required="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6" id="task-time-section1">
							<div class="form-group">
								<label>Start time</label>
								<div class="input-group mb-3">
									<select id="task_start_time" name="task_start_time" class="form-control task_update_event_start_time select2" style="width: 86%;" required="">
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
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>For Event (optional)</label>
								<div class="input-group mb-3">
									<select id="event_id" name="event_id" class="form-control select2" style="width: 86%;">
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
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mt-30">
								<input type="checkbox" name="task_allDay" id="task_allDay1" class="filled-in chk-col-success">
								<label class="control-label" for="task_allDay1">All Day</label>
								<span id="task_allDayErr" class="text-danger"></span>
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
									<!-- <div class="col-md-6">
										<div class="form-group">
											<div class="input-group mb-3">
												<select id="event_repeat_option" name="event_repeat_option" class="form-control">
												<option value="Does not repeat">Does not repeat</option>
												<option value="Daily">Daily</option>
												<option value="Weekly">Weekly</option>
												<option value="Monthly">Monthly</option>
												<option value="Annually">Annually</option>
												<option value="Every Weekday">Every Weekday</option>
											  	</select>
											  	<div class="input-group-append">
													<span class="input-group-text"><i class="fa fa-repeat"></i></span>
												</div>
											</div>
											  	<span id="event_repeat_optionErr" class="text-danger"></span>
										</div>
									</div> -->
									<div class="col-md-6">
										<div class="form-group mt-2">
											<input type="checkbox" name="event_allDay" id="event_allDay1" class="filled-in chk-col-success">
											<label class="control-label" for="event_allDay1">All Day</label>
											<span id="event_allDayErr" class="text-danger"></span>
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
							<div class="form-group">
								<label>Title</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="task_name" placeholder="Title">
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-text"></i></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Note</label>
								<div class="input-group mb-3">
									<textarea class="form-control" name="task_note" placeholder="Any Note..."></textarea>
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-info"></i></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
						    		<div class="form-group" style="width: 85%;">
										<label>Set Priority</label>
										<div class="input-group mb-3">
											<input type="text" class="form-control" id="selected-text2" name="priority" readonly="" placeholder="set priority">
											<div class="input-group-append">
												<div class="input-group-text" id="my-icon-select2"></div>
											</div>
										</div>
									</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Add Reminder</label>
											<div class="input-group mb-3">
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
										  	<div class="input-group-append">
													<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
												</div>
											</div>
											<span id="task_reminderErr" class="text-danger"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Start date</label>
											<div class="input-group mb-3">
												<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker">
												<div class="input-group-append">
													<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6" id="task-time-section2">
										<div class="form-group">
											<label>Start time</label>
											<div class="input-group mb-3">
												<select id="task_start_time" name="task_start_time" class="form-control task_create_event_start_time select2" style="width: 85%;">
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
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<input type="checkbox" name="task_allDay" id="task_allDay2" class="filled-in chk-col-success">
											<label class="control-label" for="task_allDay2">All Day</label>
											<span id="task_allDayErr" class="text-danger"></span>
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
					<div class="form-group">
						<label>Title</label>
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="task_name" placeholder="Title" required="">
							<div class="input-group-append">
								<span class="input-group-text"><i class="ti-text"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Note</label>
						<div class="input-group mb-3">
							<textarea class="form-control" name="task_note" placeholder="Any Note..."></textarea>
							<div class="input-group-append">
								<span class="input-group-text"><i class="ti-info"></i></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
	            <div class="form-group" style="width: 85%;">
								<label>Set Priority</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="selected-text1" name="priority" readonly="" placeholder="set priority" required="">
									<div class="input-group-append">
										<div class="input-group-text" id="my-icon-select1"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Add Reminder</label>
								<div class="input-group mb-3">
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
							  	<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
									</div>
								</div>
								<span id="task_reminderErr" class="text-danger"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Start date</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker1" required="">
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6" id="task-time-section">
							<div class="form-group">
								<label>Start time</label>
								<div class="input-group mb-3">
									<select id="task_start_time" name="task_start_time" class="form-control task_create_event_start_time select2" style="width: 86%;" required="">
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
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>For Event (optional)</label>
								<div class="input-group mb-3">
									<select id="event_id" name="event_id" class="form-control select2" style="width: 86%;">
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
									<div class="input-group-append">
										<span class="input-group-text"><i class="ti-alarm-clock"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mt-30">
								<input type="checkbox" name="task_allDay" id="task_allDay" class="filled-in chk-col-success">
								<label class="control-label" for="task_allDay">All Day</label>
								<span id="task_allDayErr" class="text-danger"></span>
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
<!-- Modal -->
  <div class="modal fade" data-backdrop="static" data-keyboard="false"data-backdrop="static" id="modal-module" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Select Module</h5>
			<a href="javascript:void(0);" title="Logout" class="close" onclick="logout();"><i class="fa fa-sign-out text-dark mr-2"></i></a>
		  </div>
		  <form method="POST" name="module_form" id="module_form" class="module_form" autocomplete="off">
		  	<div class="modal-body" style="background-color: #fafbfd;">		
			  	<div class="box-body">	
					<div class="row student-module">			
						<!-- <div class="col-xl-1 col-md-1 col-12"></div>			 -->
						<div class="col-xl-4 col-md-4 col-12">
							<input type="radio" name="module" id="allocator" value="1">
							<!-- <br>
							<span name="module" id="allocator" value="1"></span> -->
							<div class="allocator-div box bt-5 border-success rounded pull-up module-div">							
								<div class="box-body module-tooltip">	
										<div class="rounded">
											<center><img class="module-image" src="<?php echo base_url('assets/images/module/allocator.png');?>"></center>
										</div>
										<p class="mb-0 font-size-14 text-center text-dark">Study Allocator</p>							
									 <span class="module-tooltiptext">Computes a personal breakdown of EXACTLY how much time you should spend on each topic.</span>
								</div>					
							</div>
						</div>
						<div class="col-xl-4 col-md-4 col-12">
							<input type="radio" name="module" id="scheduler" value="2" required="">
							<div class="scheduler-div box bt-5 border-success rounded pull-up module-div">							
								<div class="box-body module-tooltip">	
										<div class="rounded">
											<center><img class="module-image" src="<?php echo base_url('assets/images/module/scheduler.ico');?>"></center>
										</div>
										<p class="mb-0 font-size-14 text-center text-dark">Scheduler</p>								
									<span class="module-tooltiptext">Study Scheduler is a tool designed for planning and tracking learning activities.</span>
								</div>					
							</div>
						</div>
						<div class="col-xl-4 col-md-4 col-12">
							<!-- <input type="radio" name="module" id="cv" value="3"> -->
							<br>
							<span name="module" id="cv" value="3"></span>
							<div class="cv-div box bt-5 border-success rounded pull-up module-div">							
								<div class="box-body module-tooltip">	
										<div class="rounded">
											<center><img class="module-image" src="<?php echo base_url('assets/images/module/cv-builder.png');?>"></center>
										</div>
										<p class="mb-0 font-size-14 text-center text-dark">CV Builder</p>								
									<span class="module-tooltiptext">CV Builder will create an eye-catching CV ready to send to employers.</span>
								</div>					
							</div>
						</div>
						<!-- <div class="col-xl-1 col-md-1 col-12"></div> -->
						<div class="col-xl-12 col-md-12 col-12">
							<span id="moduleErr" class="text-danger"></span>
						</div>
					</div>
				</div>
				<div class="box-footer text-right">
				<button type="submit" class="btn btn-primary">
				  Submit
				</button>
			</div> 
		  	</div>	
		  </form>
		</div>
	  </div>
	</div>
  <!-- /.modal -->

<!-- Modal -->
  <div class="modal fade bs-example-modal-lg" data-backdrop="static" data-keyboard="false"data-backdrop="static" id="modal-profile" tabindex="-1">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Complete the Profile</h5>
			<a href="javascript:void(0);" title="Logout" class="close" onclick="logout();"><i class="fa fa-sign-out text-dark mr-2"></i></a>
		  </div>
		  <form method="POST" name="profile_form" id="profile_form" class="profile_form" autocomplete="off" enctype="multipart/form-data">
		  	<input type="hidden" name="profile_visit_id" id="profile_visit_id" value="1">
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
						<input class="form-control" type="text" name="phone_number" id="phone_number" required="" value="<?php if($stud_del->phone_number){ echo $stud_del->phone_number; } ?>" >
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
						<select onchange="showOtherbox(this.value);" name="school_attend" id="school_attend" value="" class="form-control select2" required="" style="width: 95%;">
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
							<input name="is_graduated" type="radio" id="is_graduated_yes" required="" value="yes" <?php if($stud_del->is_graduated == 'yes'){ echo 'checked'; } ?>>
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
							<input name="usmle_before" type="radio" id="usmle_before_yes" required="" value="yes" <?php if($stud_del->usmle_before == 'yes'){ echo 'checked'; } ?>>
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
							<input name="review_programs" type="radio" id="review_programs_yes" required="" value="yes" <?php if($stud_del->review_programs == 'yes'){ echo 'checked'; } ?>>
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
				<input type="hidden" name="page" value="complete_process">
				<button onclick="skipProfile(1);" type="button" class="btn btn-primary-cust">Do it later</button>
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
		  <form method="POST" name="course_form" id="course_form" class="course_form" autocomplete="off">
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
						<label>Confidence level <span class="text-danger">*</span></label>
						<div class="input-group mb-3">
							<select id="confidence_level" name="confidence_level" class="form-control" required="">
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
            hideAfter: 5500,
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
var iconSelect;
var iconSelect1;
var selectedText;
var selectedText1;
window.onload = function(){
    selectedText = document.getElementById('selected-text');
    selectedText1 = document.getElementById('selected-text1');
    
    document.getElementById('my-icon-select').addEventListener('changed', function(e){
       selectedText.value = iconSelect.getSelectedValue();
    });

    document.getElementById('my-icon-select1').addEventListener('changed', function(e){
       selectedText1.value = iconSelect1.getSelectedValue();
    });

    iconSelect = new IconSelect("my-icon-select", 
        {'selectedIconWidth':30,
        'selectedIconHeight':30,
        'selectedBoxPadding':1,
        'iconsWidth':23,
        'iconsHeight':23,
        'boxIconSpace':1,
        'vectoralIconNumber':4,
        'horizontalIconNumber':4});

    iconSelect1 = new IconSelect("my-icon-select1", 
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
    iconSelect1.refresh(icons);
};    
</script>
<!--ends custom js-->
<?php
if($stud_mod_count <= 0){
?>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#modal-module').modal('show');
    });
</script>
<?php
}else if($stud_del->profile_visit == 0){
?>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#modal-profile').modal('show');
    });
</script>
<?php
}else if($stud_del->course_visit == 0){
	if($allocator_mod > 0 && $scheduler_mod <= 0){
		?>
		<script type="text/javascript">
		    $(window).on('load', function() {
		        $('#modal-course').modal('show');
		    });
		</script>
		<?php
	}else{
		redirect(base_url());
	}
}else{
	redirect(base_url());
}
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
