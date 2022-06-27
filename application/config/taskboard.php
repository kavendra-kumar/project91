<!DOCTYPE html>
<html lang="en">
<?php 
$title_name = 'Todo'; 
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
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/vendor_components/bootstrap/dist/css/bootstrap.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/vendor_components/perfect-scrollbar/css/perfect-scrollbar.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/vendor_components/sweetalert/sweetalert.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/vendor_components/select2/dist/css/select2.min.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/vendor_components/bootstrap-daterangepicker/daterangepicker.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/vendor_components/fullcalendar/fullcalendar.min.css');?>"> 
    <!-- Style-->  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/css/checkbox_style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/css/skin_color.css');?>">
    <!--custom css-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/taskboard/css/lib/control/iconselect.css');?>">
    <!--custom css-->
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script> 
</head>
<body class="hold-transition light-skin sidebar-mini theme-primary fixed" id="calendar-panel">
	
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
				  <h4 class="box-title">Today <small><?php echo date('D d M');?></small></h4>
				 	<br>
				 	<span class="total-task-count pull-left font-size-16 mt-10">
					 	<span class="font-weight-bold">
					 		<?php
						 	if($this->uri->segment(2) == 'completed-tasks'){
						 		echo 'Total Completed Tasks : ';
						 	}else if($this->uri->segment(2) == 'overdue-tasks'){
						 		echo 'Total Overdue Tasks : ';
						 	}else if($this->uri->segment(2) == 'open-tasks'){
						 		echo 'Total Open Tasks : ';
						 	}else{
						 		echo 'Total Tasks : ';
						 	}
						 	?>
					 	</span>
					 	<span class="out-off"><?php echo count($tasks);?></span><span class="total-task">/<?php echo count($tasks);?></span>
					</span>
					<?php
				if($tasks){
					?>
					<button type="button" title="Refresh" onclick="window.location.reload();" class="waves-effect btn btn-light mb-5 pull-right">Refresh tasks</button>
					<button type="button" data-toggle="modal" data-target="#add-task" onclick="showPriority(1);" class="mr-5 btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Task</button>
					<?php
				}
				?>					
				</div>
				<?php
				if($tasks){
					?>
					<div class="box-header with-border" style="text-align:right;">
						<input type="radio" id="basic_checkbox_4" name="view_priority" value="All" checked=""><label for="basic_checkbox_4" class="mb-0 h-15 ml-5">All</label>

						<input type="radio" id="basic_checkbox_0" name="view_priority" value="High Priority"><label for="basic_checkbox_0" class="mb-0 h-15 ml-5">High Priority</label>

						<input type="radio" id="basic_checkbox_1" name="view_priority" value="Medium Priority"><label for="basic_checkbox_1" class="mb-0 h-15 ml-5">Medium Priority</label>

						<input type="radio" id="basic_checkbox_2" name="view_priority" value="Low Priority"><label for="basic_checkbox_2" class="mb-0 h-15 ml-5">Low Priority</label>

						<input type="radio" id="basic_checkbox_3" name="view_priority" value="None"><label for="basic_checkbox_3" class="mb-0 h-15 ml-5">None</label>
					</div>
					<?php
				}
				?>				

				<div class="box-body p-10 task-section0">
				  <ul class="todo-list all-tasks filter-data" id="slimtest5">
				  	<input type="hidden" name="complete_task" id="complete_task" value="">
				  	<?php
				  	if($tasks){
				  		foreach ($tasks as $tk) {
				  			$evt = $this->Front_model->getEventById($tk->event_id);
				  			?>
				  	<li class="p-0 mb-10 show-task<?php echo $tk->id; ?> all-data" id="<?php echo $tk->priority;?>">
					  <div class="box p-15 mb-0 d-block bb-2 border-lightgray <?php if($tk->is_completed == 'yes'){ echo 'done'; } ?>">
						  <input type="hidden" class="task_id" value="<?php echo $tk->id; ?>">
						  <!-- checkbox -->
						  <?php
							if($this->uri->segment(2) == 'completed-tasks'){
								?>
								<input type="checkbox" id="basic_checkbox_<?php echo $tk->id; ?>" class="filled-in chk-col-success" onclick="incompleteTask('#basic_checkbox_',<?php echo $tk->id; ?>);" checked>
						  	<label for="basic_checkbox_<?php echo $tk->id; ?>" class="mb-0 h-15 ml-15"></label>
								<?php
							}else{
								if($tk->is_completed == 'yes'){
								?>
									<input type="checkbox" id="basic_checkbox_<?php echo $tk->id; ?>" class="filled-in chk-col-success" onclick="incompleteTask('#basic_checkbox_',<?php echo $tk->id; ?>);" checked>
						  	<label for="basic_checkbox_<?php echo $tk->id; ?>" class="mb-0 h-15 ml-15"></label>
									<?php
								}else{
									?>
									<input type="checkbox" id="basic_checkbox_<?php echo $tk->id; ?>" class="filled-in chk-col-success" onclick="completeTask('#basic_checkbox_',<?php echo $tk->id; ?>);">
							  	<label for="basic_checkbox_<?php echo $tk->id; ?>" class="mb-0 h-15 ml-15"></label>
									<?php
								}
							}
							?>
						  
						  <!-- todo text -->
						  <span title="Title" class="text-line text-success font-size-14 font-weight-500"><a href="#" onclick="return viewTask(<?php echo $tk->id; ?>);">
						  <?php 
						  if(strlen($tk->task_name)>80)
							{
								print(substr($tk->task_name,0,80)."..");
							}
							else
							{
								print($tk->task_name);
							}
							?>
							</a></span>
						  <!-- General tools such as edit or delete-->
						  <div class="tools">
							<a class="text-fade" href="#" onclick="editModalTask(<?php echo $tk->id; ?>); showPriority(4);" data-toggle="tooltip" data-container="body" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
							&nbsp;<a class="text-fade" href="#" onclick="deleteTask(<?php echo $tk->id; ?>);" data-toggle="tooltip" data-container="body" title="" data-original-title="Remove"><i class="fa fa-trash-o"></i></a>
						  </div>
						  <ul class="list-inline mb-0 mt-5 ml-30">
								<span class="pull-right text-light font-size-12 mb-0">
								<?php 
								if($tk->task_category){
										  if(strlen($tk->task_category)>50)
											{
												echo substr($tk->task_category,0,50).'.. <i class="fa fa-star"></i>';
											}
											else
											{
												echo $tk->task_category.' <i class="fa fa-star"></i>';
											}
								}
								?>
								</span>
							</ul>
							<div class="mt-5 ml-50 pl-5 text-dark font-size-12" title="<?php echo $tk->task_note;?>"><?php 
						  if(strlen($tk->task_note)>90)
							{
								print(substr($tk->task_note,0,90)."..");
							}
							else
							{
								print($tk->task_note);
							}
							?></div>
						  <ul class="list-inline mb-0 mt-5 ml-30">
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
									<li class="status<?php echo $tk->id;?>">
										<span class="badge badge-pill badge-success font-size-12 mb-0">Completed</span>
									</li>
									<?php
							}else{
								if(strtotime(date('Y-m-d')) > strtotime($tk->task_start_date)){
									?>
									<li class="status<?php echo $tk->id;?>">
										<span class="badge badge-pill badge-danger font-size-12 mb-0">Overdue</span>
									</li>
									<?php
								}else{
									?>
									<li class="status<?php echo $tk->id;?>">
										<span class="badge badge-pill badge-warning font-size-12 mb-0">Pending</span>
									</li>
									<?php
								}
							}							
							?>
							<span class="pull-right text-light font-size-12 mb-0">
							<?php 
							if($evt){
									  if(strlen($evt->event_name)>50)
										{
											echo substr($evt->event_name,0,50).'.. <i class="fa fa-circle"></i>';
										}
										else
										{
											echo $evt->event_name.' <i class="fa fa-circle"></i>';
										}
							}
							?>
							</span>
						  </ul>

						</div>
					</li>
				  			<?php
				  		}
				  	}else{
							?>
				  			<div class="row">
				  				<div class="col-md-12">
					  				<div class="mt-40 text-center">
					  					<img class="w-p40" src="<?php echo base_url('assets/images/course.png'); ?>">
					  					<h4 class="mt-20 text-success">You don't have any task created yet.</h4>
					  					<button type="button" data-toggle="modal" data-target="#add-task" onclick="showPriority(1);" class="mr-5 btn btn-primary"><i class="fa fa-plus"></i> Add Task</button>
					  				</div>
					  			</div>
				  			</div>
				  		<?php
						}
				  	?>
				  </ul>
				</div>

				<!-- /.box-body -->
			  </div>
			</div>
			<div class="col-xl-3 col-lg-4 col-12"> 
				<?php
				include 'right_sidebar.php';
				?>
			</div>
		 </div>
	<!--Start Modal Add Task-->
	<div id="add-task" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form method="POST" name="add-task-form" id="add-task-form" class="add-task-form" autocomplete="off">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Add Task</h4>
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
								<label class="control-label" for="task_allDay1">All Day</label>
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
<!-- ./side demo panel -->
<!-- <div class="sticky-toolbar">        
    <a href="#calendar-panel" data-toggle="tooltip" data-placement="left" title="Calendar" class="waves-effect waves-light btn btn-success btn-flat mb-5 btn-sm">
        <span class="fa fa-calendar"></span>
    </a>
    <a href="#tasks-panel" data-toggle="tooltip" data-placement="left" title="Portfolio" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm">
        <span class="icon-Clipboard-check"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
    </a>
</div> -->
<?php
// include 'chatbox.php';
?>	
<script src="<?php echo base_url('assets/js/vendors.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/select2/dist/js/select2.full.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/jquery-ui/jquery-ui.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/moment/min/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/fullcalendar/fullcalendar.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/fullcalendar/lib/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/fullcalendar/fullcalendar.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/sweetalert/sweetalert.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/template.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/js/pages/custom-scroll.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/taskboard/js/pages/advanced-form-element.js');?>"></script>
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
</body>
</html>
