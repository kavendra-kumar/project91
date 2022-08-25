<!DOCTYPE html>
<html lang="en">
<?php 
if($this->uri->segment(2) == 'myday'){
    $title_name = 'My Day - Calendar';
}else if($this->uri->segment(2) == 'myweek'){
    $title_name = 'My Week - Calendar';
}else if($this->uri->segment(2) == 'mylist'){
    $title_name = 'My List - Calendar';
}else{
    $title_name = 'Calendar';
}
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
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/vendor_components/bootstrap/dist/css/bootstrap.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/vendor_components/perfect-scrollbar/css/perfect-scrollbar.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/vendor_components/sweetalert/sweetalert.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/vendor_components/select2/dist/css/select2.min.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/vendor_components/bootstrap-daterangepicker/daterangepicker.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css');?>">  
	<link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/vendor_components/fullcalendar/fullcalendar.min.css');?>"> 
    <!-- Style-->  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/css/checkbox_style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/css/skin_color.css');?>">
    <!--custom css-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/calendar/css/lib/control/iconselect.css');?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--custom css-->
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script> 
    <script src="<?php echo base_url('assets/js/pages/date.js');?>"></script> 

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.rawgit.com/kodie/moment-holiday/v1.2.0/moment-holiday.js"></script>
<style type="text/css">
		
.selector{
    position:relative;
}
.selecotr-item{
    position:relative;
    display: inline-block;
    width: 30px;
    height: 30px;
}
.selector-item_radio{
    appearance:none;
    display:none;
}
.selector-item_label{
	height: 30px !important;
    width: 30px;
    text-align: center;
    border-radius: 9999px;
    transform: none;
    padding: 6px!important;
    background: #f7f7f7;
    color: #000;
    line-height: initial !important;
}
.selector-item_label:after,
.selector-item_label:before{
	content: none !important;
}

.selector-item_radio:checked + .selector-item_label{
    background-color:#4169e1;
    color:#fff;
    box-shadow:0 0 4px rgba(0,0,0,.5),0 2px 4px rgba(0,0,0,.5);
    transform:translateY(-2px);
}
.swal-footer{
	text-align: center;
}
@media (max-width:480px) {
	.selector{
		width: 90%;
	}
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
		<!-- Main content -->
		<section class="content">
			<div class="row">	
				<div class="col-xl-9 col-lg-8 col-12">
					<div class="box">
						<div class="box-body">
							<div id="calendar"></div>
						</div>
					</div> 
				</div>
				<!-- <div class="col-xl-3 col-lg-4 col-12"> 
					<div class="box no-border">	
						<div class="bg-primary-light-cust mb-5" style="min-height:225px; border-radius: 10px 0;">
							<div class="d-flex px-0">
								<div class="flex-grow-1 p-15 flex-grow-1 bg-img dask-bg bg-none-md">
									<div class="row">
										<div class="col-12 col-xl-12">
										<?php
					                      if($motivator)
					                      {
					                      ?>
					                      <div class="card-body text-center">
					                        <h4 class="card-title font-size-18 mt-3 text-dark-success">
					                        	<i class="fa fa-quote-left text-primary font-size-20 text-center mr-3"></i>
					                        	<?php echo $motivator->quote;?>
					                        </h4>
					                        <p class="card-text font-size-18 font-weight-600 text-dark-success">
					                        	<i class="fa fa-minus text-primary text-center mt-2 mr-1"></i>
					                        	<?php echo $motivator->writer;?>
					                        </p>
					                    	</div>
					                      <?php
					                      }
					                      ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="mb-5">
							<div class="px-1 pt-0">
								<div id="calendar1" class="dask evt-cal"></div>
							</div>
						</div>						
						<div class="event-fc-bt mx-15">
							<a href="#" data-toggle="modal" data-target="#add-new-events" class="btn btn-primary btn-block my-10">
								<i class="ti-plus"></i> Create New Event
							</a>
						</div>	  
						<div class="box-header with-border">
							<h5 class="box-title">Draggable Events</h5>
							<ul class="box-controls pull-right">
								<li><a class="box-btn-slide-1" href="#"></a></li>	
							</ul>
						</div>
						<div class="box-body p-0 box-body-1">
							
							<div id="external-events">
							<?php
							$ev_cnt=1;
							if($draggable_events){
								foreach ($draggable_events as $ev) {
									?>
									<div id="<?php echo $ev->id;?>" class="external-event drag-event<?php echo $ev->id;?> m-10 <?php echo $ev->event_color;?>" data-class="<?php echo $ev->event_color;?>">
									<i class="fa fa-hand-o-right"></i> 
									<?php 
									if(strlen($ev->event_name)>20)
									{
										print(substr($ev->event_name,0,16)."..");
									}
									else
									{
										print($ev->event_name);
									}
									?>
									<i onclick="return removeDragEvent(<?php echo $ev->id;?>);" style="cursor: pointer;" class="pull-right fa fa-times"></i>
									<i onclick="return editModalDragEvent(<?php echo $ev->id;?>);" style="cursor: pointer;" class="pull-right fa fa-pencil"></i>
									</div>
									<?php
									$ev_cnt++;
								}
							}
							?>
							</div>
						</div>
						<div class="event-fc-bt mx-15 my-20">
							<div class="checkbox">
								<input id="drop-remove" type="checkbox">
								<label for="drop-remove">
								Remove after drop
								</label>
							</div>
						</div>
						<div class="box-header with-border">
							<h5 class="box-title">Tasks</h5>
							<ul class="box-controls pull-right">
								<li><a class="box-btn-slide" href="#"></a></li>	
							</ul>
						</div>
						<div class="box-body p-0 box-body-2">
							<div class="event-fc-bt mx-15">
								<a href="<?php echo base_url('todo');?>" class="btn btn-success btn-block my-10">
									<i class="pull-left fa fa-hand-o-right"></i>  All Tasks
								</a>
								<a href="<?php echo base_url('todo/open-tasks');?>" class="btn btn-success btn-block my-10">
									<i class="pull-left fa fa-hand-o-right"></i>  Open Tasks
								</a>
								<a href="<?php echo base_url('todo/completed-tasks');?>" class="btn btn-success btn-block my-10">
									<i class="pull-left fa fa-hand-o-right"></i>  Completed Tasks
								</a>
								<a href="<?php echo base_url('todo/overdue-tasks');?>" class="btn btn-success btn-block my-10">
									<i class="pull-left fa fa-hand-o-right"></i>  Overdue Tasks
								</a>
								<a href="<?php echo base_url('todo/events');?>" class="btn btn-success btn-block my-10">
									<i class="pull-left fa fa-hand-o-right"></i>  Events
								</a>
							</div>
						</div>
					</div>
				</div>  -->
			</div>
		</section>
		<!-- /.content -->
	</div>	  
</div>
<!-- /.content-wrapper -->

    <!-- BEGIN MODAL -->
	<!-- Modal View Event -->
	<div class="modal fade none-border" data-backdrop="static" id="view-event">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button title="Edit event" type="button" class="waves-effect waves-circle btn btn-circle btn-light-blue btn-xs mb-5 edit-event"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;
					<button title="Delete event" type="button" class="waves-effect waves-circle btn btn-circle btn-light-blue btn-xs mb-5 delete-event"><i class="fa fa-trash"></i></button>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body"></div>
				<!-- <div style="padding: 0px 14px;"><button class="btn btn-light pull-right" type="button" data-toggle="modal" onclick="showPriority(1);" data-target="#add-task">Add task</button></div> -->
				<div class="modal-body1 p-10"></div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<!-- END MODAL -->
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 id="delete_type_edit" style="font-weight: 400;color:black">Delete event</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
			
			<div class="modal-body">
				<div id="delete_event_one">
					<input type="radio" id="delete_check_value1" name="delete_check_value" value="0" checked>
					<label for="delete_check_value1">Delete this event</label><br>
				</div>
				<div id="delete_event_two">
					<div id="delete_event_three">
						<input type="radio" id="delete_check_value2" name="delete_check_value" value="2">
						<label for="delete_check_value2">Delete this and following</label><br>
					</div>
					<input type="radio" id="delete_check_value3" name="delete_check_value" value="1">
					<label for="delete_check_value3">Delete all</label>
					<br>
				</div>
				<span id="event_delete_Err" class="text-danger" ></span>
				<div class="modal_button mt-4 float-right" >
					<button type="button" class="btn btn-default" data-dismiss="modal" style="border: none;background: none">Cancel</button>
					<button type="button" class="btn delete-next-event" style="border: none;background: none">Delete</button>
				</div>
			</div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>
  <!--Update Modal content-->
  <div class="modal fade" id="myModalUpdate" role="dialog">
    <div class="modal-dialog  modal-sm">
  	<div class="modal-content">
        <div class="modal-header">
			<h4 id="update_type_edit" style="font-weight: 400;color:black">Update event</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
			
			<div class="modal-body">
				<div id="update_event_one">
					<input type="radio" id="update_check_value1" name="update_check_value" value="0" checked>
					<label for="update_check_value1">Update this</label><br>
				</div>
				<div id="update_event_two">
					<div id="update_event_three">
						<input type="radio" id="update_check_value2" name="update_check_value" value="2">
						<label for="update_check_value2">Update this and following</label><br>
					</div>
					<input type="radio" id="update_check_value3" name="update_check_value" value="1">
					<label for="update_check_value3">Update all</label>
					<br>
				</div>
				<span id="event_delete_Err" class="text-danger" ></span>
				<div class="modal_button_up mt-4 float-right" >
					<button type="button" class="btn btn-default" data-dismiss="modal" style="border: none;background: none">Close</button>
					<button type="button" class="btn update-next-event" style="border: none;background: none">Update</button>
				</div>
				</div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>

  	<!-- BEGIN MODAL -->
  	<!-- Modal Create Event -->
<div class="modal fade none-border" data-backdrop="static" id="add-new-events">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><strong>Create</strong> New</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form class="create-category" method="post" autocomplete="off">
			<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
						<!-- <ul class="nav nav-pills ">
							<li class="nav-item">
								<a class="nav-link" href="#">Event</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" href="#">Task</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Reminder</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Meeting</a>
							</li>
							</ul>
							<hr> -->
<style>
	.wrapper_sp {
  display: inline-flex;
  /* background: #fff; */
  /* height: 100px;
  width: 250px; */
  align-items: center;
  justify-content: space-evenly;
  border-radius: 5px;
  /* padding: 20px 15px;
  box-shadow: 5px 5px 30px rgb(0 0 0 / 20%); */
}
.wrapper_sp .option {
	padding: 8px 16px !important;
    display: inline-block !important;
    height: auto !important;
	margin: 0;
    border-radius: 4px 4px 0 0;
    border: 1px solid #cdd9dd;
}
.wrapper_sp input[type="radio"] {
  display: none;
}
.wrapper_sp input#created_type_event:checked ~ .option-1,
.wrapper_sp input#created_type_task:checked ~ .option-2,
.wrapper_sp input#created_type_reminder:checked ~ .option-3,
.wrapper_sp input#four:checked ~ .option-4 {
  background: #0066ff;
  border-color: #0066ff;
  border: 1px solid #0066ff;
}
.wrapper_sp input#created_type_event:checked ~ .option-1 span,
.wrapper_sp input#created_type_task:checked ~ .option-2 span,
.wrapper_sp input#created_type_reminder:checked ~ .option-3 span,
.wrapper_sp input#four:checked ~ .option-4 span {
  color: #fff;
}
.wrapper_sp .option span {
  font-size: 17px;
}
.wrapper_sp label:after,
.wrapper_sp label:before{
	content: '';
	display: none;

}
</style>
							<div class="wrapper_sp mb-4">
								<input type="radio" value="event" name="created_type" id="created_type_event" checked>
								<input type="radio" value="task" name="created_type" id="created_type_task">
								<input type="radio" value="reminder" name="created_type" id="created_type_reminder">
								<input type="radio" value="event" name="created_type" id="four">
								<label for="created_type_event" class="option option-1" onclick="event_type_event()"><span>Event</span></label>
								<label for="created_type_task" class="option option-2" onclick="event_type_task()"><span>Task</span></label>
								<label for="created_type_reminder" class="option option-3" onclick="event_type_reminder()"><span>Reminder</span></label>
								<!-- <label for="four" class="option option-4" onclick="event_type()"><span>Meeting</span></label> -->
							</div>
						</div>
					</div>
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
						<div id="event-1" class="tab-pane active">
							<div class="row">
								<div class="col-md-12" id="add_note_div">
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
							<style>
								option:disabled{color: #ccc;}
							</style>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-group mb-3">
											<select id="event_repeat_option" name="event_repeat_option" class="form-control" onchange="showEndDate(this.value);">
											<option value="Does not repeat">Does not repeat</option>
											<option value="Daily">Daily</option>
											<option value="Every Weekday">Every Weekday (Monday to Friday)</option>
											<option value="Custom" id="custom_value">Custom</option>
											<option value="Weekly" id="weekday_value">Weekly</option>
											<option value="Monthly" id="monthly_value">Monthly</option>
											<option value="Yearly" id="yearly_value">Yearly</option>
											<!-- <option value="Weekly">Weekly</option>
											<option value="Annually">Annually</option> -->
										  	</select>
										  	<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-repeat"></i></span>
											</div>
										</div>
										  	<span id="event_repeat_optionErr" class="text-danger"></span>
									</div>
								</div>
								
							</div>
							<div class="row custom-class" style="display: none;"  id="cus_radioBTN">
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-group mb-3">
										<div class="cus_radioBTN">
											<div class="selector">
												<div class="selecotr-item" id="radioId1">
													<input type="checkbox" id="radio1" name="custom_check[]" class="selector-item_radio"  value="Sun">
													<label for="radio1" class="selector-item_label">S</label>
												</div>
												<div class="selecotr-item" id="radioId2">
													<input type="checkbox" id="radio2" name="custom_check[]" class="selector-item_radio" value="Mon">
													<label for="radio2" class="selector-item_label">M</label>
												</div>
												<div class="selecotr-item" id="radioId3">
													<input type="checkbox" id="radio3" name="custom_check[]" class="selector-item_radio" value="Tue">
													<label for="radio3" class="selector-item_label">T</label>
												</div>
												<div class="selecotr-item" id="radioId4">
													<input type="checkbox" id="radio4" name="custom_check[]" class="selector-item_radio" value="Wed">
													<label for="radio4" class="selector-item_label">W</label>
												</div>
												<div class="selecotr-item" id="radioId5">
													<input type="checkbox" id="radio5" name="custom_check[]" class="selector-item_radio" value="Thu">
													<label for="radio5" class="selector-item_label">T</label>
												</div>
												<div class="selecotr-item" id="radioId6">
													<input type="checkbox" id="radio6" name="custom_check[]" class="selector-item_radio" value="Fri">
													<label for="radio6" class="selector-item_label">F</label>
												</div>
												<div class="selecotr-item" id="radioId7">
													<input type="checkbox" id="radio7" name="custom_check[]" class="selector-item_radio" value="Sat">
													<label for="radio7" class="selector-item_label">S</label>
												</div>
											</div>
										</div>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="row"  id="event_start_end_date_select">
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-group">
										  <input type="text" name="event_start_end_date" class="form-control" id="reservation" value="" required="">	
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>	
										</div>
										<span id="event_start_end_dateErr" class="text-danger" ></span>
									 </div>
								</div>
							</div> -->
							<!--    New start end date field -->
							<div class="row"  id="event_start_end_date_select">
								<div class="col-md-6">
									<div class="form-group">
										<div class="input-group">
										  <input type="text" name="event_start_date_nn" class="form-control" id="event_start_date_nn" data-value="2018-10-27" value="" required="" onchange="customChange()">	
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>	
										</div>
										<span id="event_start_end_dateErr" class="text-danger" ></span>
									 </div>
								</div>
							
								<div class="col-md-6">
									<div class="form-group">
										<div class="input-group">
										  <input type="text" name="event_end_date_nn" class="form-control" id="event_end_date_nn" value="" required="" onchange="customChange()">	
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>	
										</div>
										<span id="event_start_end_dateErr" class="text-danger" ></span>
									 </div>
								</div>
							</div>
							<!--             end            --->	
							<div class="row" id="event_start_end_date_div">
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-group">
										  <input type="text" name="event_start_end_date_new" class="form-control" id="event_start_end_date_new" value="event_start_end_date_new">	
										  <div class="input-group-addon">
										  	<i class="fa fa-calendar"></i>
										  </div>	
										</div>
										<span id="event_start_end_date_new" class="text-danger" ></span>
									 </div>
								</div>
							</div>
							<div class="row" id="date-time-section">
								<div class="col-md-6">
									<div class="bootstrap-timepicker">
										<div class="form-group">
										<div class="input-group mb-3">
											<select id="event_start_time" name="event_start_time" class="form-control select2 create_event_start_time" style="width: 86%;">
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
										<div class="input-group mb-3">
											<select id="event_end_time" name="event_end_time" class="form-control select2" style="width: 86%;">
											<?php
												if($time_12hrs){
													foreach ($time_12hrs as $t12hrs) {
														?>
														<option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == '12:00 PM'){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
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
									<div class="form-group mt-2">
										<input type="checkbox" name="event_allDay" id="event_allDay" class="filled-in chk-col-success" onclick="check_reminder(this.value)">
										<label class="control-label" for="event_allDay">All Day</label>
										<span id="event_allDayErr" class="text-danger"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mt-2" id="draggable_field_create">
										<input type="checkbox" name="draggable_event" id="draggable_event" class="filled-in chk-col-success">
										<label class="control-label" for="draggable_event">Draggable Event</label>
										<span id="draggable_eventErr" class="text-danger"></span>
									</div>
								</div>
								<input type="hidden" name="checkbox_value_get" id="checkbox_value_get" value="true" >
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
								<div class="col-md-6" id="old_reminder">
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
								<div class="col-md-6" id="new_reminder">
									<div class="form-group">
										<div class="input-group mb-3">
											<select id="event_reminder" name="event_reminder_new" class="form-control">
											<option value="No reminder">No reminder</option>
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
										  	<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
											</div>
										</div>
										  	<span id="event_reminderErr" class="text-danger"></span>
									</div>
								</div>
								<div class="col-md-6" id="task_priority_div">
									<div class="form-group">
										<div class="input-group mb-3">
											<select id="task_priority" name="task_priority" class="form-control">
												<option value="No Priority">No Priority</option>
												<option value="High Priority">High Priority</option>
												<option value="Medium Priority">Medium Priority</option>
												<option value="Low Priority">Low Priority</option>
											</select>
										  	<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
											</div>
										</div>
										  	<span id="task_priorityErr" class="text-danger"></span>
									</div>
								</div>
								<!-- <div class="col-md-6">
									<div class="form-group">
										<input type="checkbox" name="draggable_event" id="draggable_event" class="filled-in chk-col-success">
										<label class="control-label" for="draggable_event">Draggable Event</label>
										<span id="draggable_eventErr" class="text-danger"></span>
									</div>
								</div> -->
							</div>	
						</div>
						<br>
						<div class="event-task-panel">
							<!-- <button class="btn btn-light event-add-task" onclick="showPriority(2);" type="button">Add task</button> -->
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
													<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker3">
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
					<input type="hidden" name="type" id="type" value="event">
				
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-default close-category" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary save-category">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>
	<!-- END MODAL -->

	<!-- BEGIN MODAL -->
	<!-- Modal Update Event -->
<div class="modal fade none-border" data-backdrop="static" id="update-event">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Update</strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="hideModal()">&times;</button>
				</div>
				<form class="update-category" method="post" autocomplete="off">
				<div class="modal-body">
				<div class="row">
						<div class="com-md-12">
						<style>
	.wrapper_sp {
  display: inline-flex;
  /* background: #fff; */
  /* height: 100px;
  width: 250px; */
  align-items: center;
  justify-content: space-evenly;
  border-radius: 5px;
  /* padding: 20px 15px;
  box-shadow: 5px 5px 30px rgb(0 0 0 / 20%); */
}
.wrapper_sp .option {
	padding: 8px 16px !important;
    display: inline-block !important;
    height: auto !important;
	margin: 0;
    border-radius: 4px 4px 0 0;
    border: 1px solid #cdd9dd;
}
.wrapper_sp input[type="radio"] {
  display: none;
}
.wrapper_sp input#created_type_event_update:checked ~ .option-1,
.wrapper_sp input#created_type_task_update:checked ~ .option-2,
.wrapper_sp input#created_type_reminder_update:checked ~ .option-3,
.wrapper_sp input#four:checked ~ .option-4 {
  background: #0066ff;
  border-color: #0066ff;
  border: 1px solid #0066ff;
}
.wrapper_sp input#created_type_event_update:checked ~ .option-1 span,
.wrapper_sp input#created_type_task_update:checked ~ .option-2 span,
.wrapper_sp input#created_type_reminder_update:checked ~ .option-3 span,
.wrapper_sp input#four:checked ~ .option-4 span {
  color: #fff;
}
.wrapper_sp .option span {
  font-size: 17px;
}
.wrapper_sp label:after,
.wrapper_sp label:before{
	content: '';
	display: none;

}
</style>
							<div class="wrapper_sp mb-4">
								<input type="radio" value="event" name="created_type" id="created_type_event_update" onclick="return false;">
								<input type="radio" value="task" name="created_type" id="created_type_task_update" onclick="return false;">
								<input type="radio" value="reminder" name="created_type" id="created_type_reminder_update" onclick="return false;">
								<input type="radio" value="event" name="created_type" id="four_update" onclick="return false;">
								<label for="created_type_event_update" class="option option-1"><span>Event</span></label>
								<label for="created_type_task_update" class="option option-2"><span>Task</span></label>
								<label for="created_type_reminder_update" class="option option-3"><span>Reminder</span></label>
								<!-- <label for="four" class="option option-4" onclick="event_type()"><span>Meeting</span></label> -->
							</div>
						</div>
					</div>
					
					
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
									<div class="col-md-12" id="add_note_div_update">
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
								<div id="event_field_hide">
									<style>
									option:disabled{color: #ccc;}
									</style>
								<div class="row">
									<div class="col-md-12">
											<div class="form-group">
												<div class="input-group mb-3">
													<select id="event_repeat_option" name="event_repeat_option" class="form-control event_repeat_optionn" onchange="showEndDateUpdate(this.value);">
													<!-- <option value="Does not repeat">Daily</option> -->
													<option value="Does not repeat">Does not repeat</option>
													<option value="Daily">Daily</option>
													<!-- <option value="Daily">Daily</option> -->
													<option value="Every Weekday">Every Weekday (Monday to Friday)</option>
													<option value="Custom" class="custom_value_update">Custom</option>
													<option value="Weekly" id="weekday_value" class="weekday_value_update">Weekly</option>
													<option value="Monthly" id="monthly_value" class="monthly_value_update">Monthly</option>
													<option value="Yearly" id="yearly_value" class="yearly_value_update">Annually</option>
													<!--<option value="Monthly">Monthly</option>
													<option value="Annually">Annually</option> -->
													</select>
													<div class="input-group-append">
														<span class="input-group-text"><i class="fa fa-repeat"></i></span>
													</div>
												</div>
													<span id="event_repeat_optionErr" class="text-danger"></span>
											</div>
									</div>
								</div>
								<div class="row custom-class-update" style="display: none;">
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group mb-3">
											<div class="cus_radioBTN">
												<div class="selector">
													<div class="selecotr-item" id="radioupdate1">
														<input type="checkbox" id="radioupdate_Sun" name="custom_check[]" class="selector-item_radio"  value="Sun">
														<label for="radioupdate_Sun" class="selector-item_label">S</label>
													</div>
													<div class="selecotr-item" id="radioupdate2">
														<input type="checkbox" id="radioupdate_Mon" name="custom_check[]" class="selector-item_radio" value="Mon">
														<label for="radioupdate_Mon" class="selector-item_label">M</label>
													</div>
													<div class="selecotr-item" id="radioupdate3">
														<input type="checkbox" id="radioupdate_Tue" name="custom_check[]" class="selector-item_radio" value="Tue">
														<label for="radioupdate_Tue" class="selector-item_label">T</label>
													</div>
													<div class="selecotr-item" id="radioupdate4">
														<input type="checkbox" id="radioupdate_Wed" name="custom_check[]" class="selector-item_radio" value="Wed">
														<label for="radioupdate_Wed" class="selector-item_label">W</label>
													</div>
													<div class="selecotr-item" id="radioupdate5">
														<input type="checkbox" id="radioupdate_Thu" name="custom_check[]" class="selector-item_radio" value="Thu">
														<label for="radioupdate_Thu" class="selector-item_label">T</label>
													</div>
													<div class="selecotr-item" id="radioupdate6">
														<input type="checkbox" id="radioupdate_Fri" name="custom_check[]" class="selector-item_radio" value="Fri">
														<label for="radioupdate_Fri" class="selector-item_label">F</label>
													</div>
													<div class="selecotr-item" id="radioupdate7">
														<input type="checkbox" id="radioupdate_Sat" name="custom_check[]" class="selector-item_radio" value="Sat">
														<label for="radioupdate_Sat" class="selector-item_label">S</label>
													</div>
												</div>
											</div>
											</div>
										</div>
									</div>
								</div>
								<!-- <div class="row" id="event_start_end_date_select_update">
									<div class="col-md-12">
										<div class="form-group">
											<div class="input-group">
											  <input type="text" name="event_start_end_date" class="form-control" id="reservation1" required="">	
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>	
											</div>
											<span id="event_start_end_dateErr" class="text-danger"></span>
										 </div>
									</div>
								</div> -->
								<div class="row" id="event_start_end_date_select_update">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
											  <input type="text" name="event_start_date_nn" class="form-control" id="event_start_date_nnn" required="" onchange="customChangeUpdate()">	
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>	
											</div>
											<span id="event_start_end_dateErr" class="text-danger"></span>
										 </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
											  <input type="text" name="event_end_date_nn" class="form-control" value="" id="event_end_date_nnn" required="" onchange="customChangeUpdate()">	
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>	
											</div>
											<span id="event_start_end_dateErr" class="text-danger"></span>
										 </div>
									</div>
								</div>
								<div class="row" id="event_start_end_date_div_update">
								    <div class="col-md-12">
									<div class="form-group">
										<div class="input-group">
										  <input type="text" name="event_start_end_date_new" class="form-control" id="event_start_end_date_neww" value="event_start_end_date_new">	
										  <div class="input-group-addon">
										  	<i class="fa fa-calendar"></i>
										  </div>	
										</div>
										<span id="event_start_end_date_new" class="text-danger" ></span>
									 </div>
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
										<div class="form-group mt-2">
											<input type="checkbox" name="event_allDay" id="event_allDay1" class="filled-in chk-col-success" onclick="check_reminder_update(this.value)">
											<label class="control-label" for="event_allDay1">All Day</label>
											<span id="event_allDayErr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-md-6" id="draggable_field">
										<div class="form-group mt-2">
											<input type="checkbox" name="draggable_event" id="draggable_event1" class="filled-in chk-col-success" checked="">
											<label class="control-label" for="draggable_event1">Draggable Event</label>
											<span id="draggable_eventErr" class="text-danger"></span>
										</div>
									</div>
									
								</div>		
								<!-- <div class="row custom-class-update" style="display: none;">
								<div class="col-md-12">
									<div class="form-group">
										<div class="input-group mb-3">
										<div class="cus_radioBTN">
											<div class="selector">
												<div class="selecotr-item">
													<input type="checkbox" id="radioupdate1" name="custom_check_update[]" class="selector-item_radio"  value="Sun">
													<label for="radioupdate1" class="selector-item_label">S</label>
												</div>
												<div class="selecotr-item">
													<input type="checkbox" id="radioupdate2" name="custom_check_update[]" class="selector-item_radio" value="Mon">
													<label for="radioupdate2" class="selector-item_label">M</label>
												</div>
												<div class="selecotr-item">
													<input type="checkbox" id="radioupdate3" name="custom_check_update[]" class="selector-item_radio" value="Tue">
													<label for="radioupdate3" class="selector-item_label">T</label>
												</div>
												<div class="selecotr-item">
													<input type="checkbox" id="radioupdate4" name="custom_check_update[]" class="selector-item_radio" value="Wed">
													<label for="radioupdate4" class="selector-item_label">W</label>
												</div>
												<div class="selecotr-item">
													<input type="checkbox" id="radioupdate5" name="custom_check_update[]" class="selector-item_radio" value="Thu">
													<label for="radioupdate5" class="selector-item_label">T</label>
												</div>
												<div class="selecotr-item">
													<input type="checkbox" id="radioupdate6" name="custom_check_update[]" class="selector-item_radio" value="Fri">
													<label for="radioupdate6" class="selector-item_label">F</label>
												</div>
												<div class="selecotr-item">
													<input type="checkbox" id="radioupdate7" name="custom_check_update[]" class="selector-item_radio" value="Sat">
													<label for="radioupdate7" class="selector-item_label">S</label>
												</div>
											</div>
										</div>
										</div>
									</div>
								</div>
							</div> -->
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
									<div class="col-md-6" id="old_reminder_update">
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
									
									<div class="col-md-6" id="new_reminder_update">
									<div class="form-group">
										<div class="input-group mb-3">
											<select id="event_reminder" name="event_reminder_new" class="form-control">
											<option value="No reminder">No reminder</option>
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
										  	<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
											</div>
										</div>
										  	<span id="event_reminderErr" class="text-danger"></span>
									</div>
									
								</div>
								<div class="col-md-6" id="task_priority_div_update">
									<div class="form-group">
										<div class="input-group mb-3">
											<select id="task_priority" name="task_priority" class="form-control">
												<option value="No Priority">No Priority</option>
												<option value="High Priority">High Priority</option>
												<option value="Medium Priority">Medium Priority</option>
												<option value="Low Priority">Low Priority</option>
											</select>
										  	<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-bell-o"></i></span>
											</div>
										</div>
										  	<span id="task_priorityErr" class="text-danger"></span>
									</div>
								</div>
									<!-- <div class="col-md-6">
										<div class="form-group">
											<input type="checkbox" name="draggable_event" id="draggable_event1" class="filled-in chk-col-success" checked="">
											<label class="control-label" for="draggable_event1">Draggable Event</label>
											<span id="draggable_eventErr" class="text-danger"></span>
										</div>
									</div> -->
								</div>	
							</div>
						</div>
						<input type="hidden" name="checkbox_value_get_update" id="checkbox_value_get_update" value="" >
						<input type="hidden" name="draggable_id" id="draggable_id">
						<input type="hidden" name="type" id="type" value="event">
						<input type="hidden" name="event_id" id="event_id">
						<div class="event-task-panel">
							<!-- <button class="btn btn-light event-add-task" onclick="showPriority(3);" type="button">Add task</button> -->
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
												<input type="text" class="form-control" id="selected-text3" name="priority" readonly="" placeholder="set priority">
												<div class="input-group-append">
													<div class="input-group-text" id="my-icon-select3"></div>
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
													<input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" name="task_start_date" id="datepicker4">
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
				</form>
			</div>
		</div>
	</div>
	<!-- END MODAL -->
  
  	<!-- BEGIN MODAL -->
	<!-- Modal Update Drag Event -->
<div class="modal fade none-border" data-backdrop="static" id="edit-drag-event">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Update</strong></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form class="edit-dragevent" method="post" autocomplete="off">
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
						<!-- <div class="theme-success">
							<ul class="nav nav-pills mb-20">
								<li class="nav-item"> <a href="#event-1" id="event" class="nav-link active" data-toggle="tab" aria-expanded="false">Event</a> </li>
							</ul>
						</div> -->
						<div class="tab-content">
							<div id="event-1" class="tab-pane active">
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
											  <input type="hidden" name="event_start_end_date" class="form-control" id="reservation3">	
											  <!-- <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div> -->	
											</div>
											<span id="event_start_end_dateErr" class="text-danger"></span>
											<!-- /.input group -->
										 </div>
									</div>
								</div>
								<div class="row" id="drag-date-time-section">
									<div class="col-md-6">
										<div class="bootstrap-timepicker">
											<div class="form-group">
											<div class="input-group mb-3">
												<select id="event_start_time" name="event_start_time" class="form-control drag_update_event_start_time select2" style="width: 86%;">
													<?php
													if($time_12hrs){
														foreach ($time_12hrs as $t12hrs) {
															?>
															<option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == '11:00'){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
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
											<div class="input-group mb-3">
												<select id="event_end_time" name="event_end_time" class="form-control select2" style="width: 86%;">
												<?php
													if($time_12hrs){
														foreach ($time_12hrs as $t12hrs) {
															?>
															<option value="<?php echo $t12hrs->time; ?>" <?php if($t12hrs->time == '12:00'){ echo "selected"; }?>><?php echo $t12hrs->time; ?></option>
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
												<option value="Annually">Annually</option> -->
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
											<input type="checkbox" name="event_allDay" id="drag_event_allDay" class="filled-in chk-col-success">
											<label class="control-label" for="drag_event_allDay">All Day</label>
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
								</div>	
							</div>
						</div>
						<input type="hidden" name="drag_id" id="drag_id">
					
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default close-dragevent" data-dismiss="modal">Cancel</button>				
					<button type="submit" class="btn btn-primary update-dragevent">Update</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END MODAL -->

		<!--Start Modal View Task Details-->
	<div id="view-task" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabelview-task" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title task-event" id="myModalLabelview-task"></h4>
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
									<span class="badge badge-pill task-priority"></span>
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
	<!-- End Modal View Task Details-->

	<!--Start Modal Edit Task-->
	<div id="edit-task" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabeledit-task" aria-hidden="true">
		<div class="modal-dialog">
			<form method="POST" name="edit-task-form" id="edit-task-form" class="edit-task-form" autocomplete="off">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabeledit-task">Edit Task</h4>
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
					<input type="hidden" name="hidden_event_id">				
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
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php
// include 'chatbox.php';
?>
<script src="<?php echo base_url('assets/js/vendors.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/select2/dist/js/select2.full.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/jquery-ui/jquery-ui.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/moment/min/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/fullcalendar/fullcalendar.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/fullcalendar/lib/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/fullcalendar/fullcalendar.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/sweetalert/sweetalert.min.js');?>"></script><script src="<?php echo base_url('assets/css_js/calendar/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/template.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/js/pages/custom-scroll.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/js/pages/advanced-form-element.js');?>"></script>
<script src="<?php echo base_url('assets/js/pages/calendar.js');?>"></script>
<script src="<?php echo base_url('assets/js/pages/calendar-1.js');?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/css_js/calendar/js/front.js');?>"></script>
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
$('#task_priority_div').hide();
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
}   
</script>
<!--ends custom js-->
<script type="text/javascript">
	$("#create_event").click(function () {
	    $('.create-category').find("#type").val('event');
	    $('.create-category').find("#reservation").prop('required',true);
	    $('.create-category').find("#datepicker").prop('required',false);
	  });

	  $("#create_task").click(function () {
	    $('.create-category').find("#type").val('task');
	    $('.create-category').find("#reservation").prop('required',false);
	    $('.create-category').find("#datepicker").prop('required',true);
	  });
</script>
<script type="text/javascript">
	$('#new_reminder').hide();
	// $('#event_start_end_date_select').hide();
	// $('#event_start_end_date_div').show();
	function showEndDate(value) 
	{
		if(value == "Daily" || value == "Does not repeat"){
			$('#draggable_field_create').show();
		}else{
			$('#draggable_field_create').hide();
		}
		if(value == 'Custom'){
			console.log("Fgf");
			var start_date_selected = $('#event_start_date_nn').val();
			var end_date_selected = $('#event_end_date_nn').val();
			var date1 = new Date(start_date_selected);
			var date2 = new Date(end_date_selected);
			var Difference_In_Time = date2.getTime() - date1.getTime();
			var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
			console.log("Difference_In_Time");
			console.log(Difference_In_Days);
			if(Difference_In_Days > 5){
				$('#event_start_end_date_select').show();
				$('#event_start_end_date_div').hide();  
				$('.custom-class').css('display','block');
			}else{
				for($i =1;$i<=7;$i++){
					$('#radioId'+$i).hide();
				}
				$('#event_start_end_date_select').show();
				$('#event_start_end_date_div').hide();
				$('.custom-class').css('display','block'); 
				var dateArray = new Array();
				var currentDate = date1;
				while (currentDate <= date2) {
					dateArray.push(new Date (currentDate));
					currentDate = currentDate.addDays(1);
				}
				var arrayLength = dateArray.length;
				for (var i = 0; i < arrayLength; i++) {
					let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
					$('#radioId'+day_new_value).show();
				}

			}
			
		}else if(value == 'Does not repeat'){
			$('#event_start_end_date_select').hide();
			$('#event_start_end_date_div').show();
			$('.custom-class').css('display','none');
		}else{
			$('#event_start_end_date_select').show();
			$('#event_start_end_date_div').hide();
			$('.custom-class').css('display','none');
		}
	}
	function showEndDateUpdate(value) 
	{
		if(value == "Daily" || value == "Does not repeat"){
			$('#draggable_field').show();
		}else{
			$('#draggable_field').hide();
		}
		if(value == 'Custom'){
			
			var start_date_selected = $('#event_start_date_nnn').val();
			var end_date_selected = $('#event_end_date_nnn').val();
			var date1 = new Date(start_date_selected);
			var date2 = new Date(end_date_selected);
			var Difference_In_Time = date2.getTime() - date1.getTime();
			var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
			console.log("Difference_In_Time");
			console.log(Difference_In_Days);
			if(Difference_In_Days > 5){
				$('#event_start_end_date_select_update').show();
				$('#event_start_end_date_div_update').hide();
				$('.custom-class-update').css('display','block');
			}else{
				for($i =1;$i<=7;$i++){
					$('#radioupdate'+$i).hide();
				}
				$('#event_start_end_date_select_update').show();
				$('#event_start_end_date_div_update').hide();
				$('.custom-class-update').css('display','block');
				var dateArray = new Array();
				var currentDate = date1;
				while (currentDate <= date2) {
					dateArray.push(new Date (currentDate));
					currentDate = currentDate.addDays(1);
				}
				var arrayLength = dateArray.length;
				for (var i = 0; i < arrayLength; i++) {
					let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
					$('#radioupdate'+day_new_value).show();
				}

			} 
		}else if(value == 'Does not repeat'){
			$('#event_start_end_date_select_update').hide();
			$('#event_start_end_date_div_update').show();
			$('.custom-class-update').css('display','none');
		}else{
			$('#event_start_end_date_select_update').show();
			$('#event_start_end_date_div_update').hide();
			$('.custom-class-update').css('display','none');
		}
	}
	function check_reminder(value){		
		var check_new_value = $('#checkbox_value_get').val();
		if(check_new_value == 'true'){
			$('#checkbox_value_get').val("false");
			$('#old_reminder').hide();
			$('#new_reminder').show();
		}else{
			$('#checkbox_value_get').val("true");
			$('#old_reminder').show();
			$('#new_reminder').hide();
		}

	}
	function check_reminder_update(value){		
		var check_new_value = $('#checkbox_value_get_update').val();
		if(check_new_value == 'true'){
			$('#checkbox_value_get_update').val("false");
			$('#old_reminder_update').hide();
			$('#new_reminder_update').show();
		}else{
			$('#checkbox_value_get_update').val("true");
			$('#old_reminder_update').show();
			$('#new_reminder_update').hide();
		}

	}
	function dateChange(value){
		alert(value);
	}
	
	function event_type_task(){
		$('#task_priority_div').show();
		$('#add_note_div').show();
	}
	function event_type_event(){
		$('#task_priority_div').hide();
		$('#add_note_div').show();
	}
	function event_type_reminder(){
		$('#add_note_div').hide();
		$('#task_priority_div').hide();
	}
	function customChange(){
		console.log("customChangeFunction");
		$('#custom_value').prop('disabled', false);
		var event_repeat_option = $('#event_repeat_option').val();
		console.log("Ddfd"+event_repeat_option);
		if(event_repeat_option == "Custom"){
			for($i =1;$i<=7;$i++){
					$('#radioId'+$i).hide();
				}
				$('#event_start_end_date_select').show();
				$('#event_start_end_date_div').hide();
				$('.custom-class').css('display','block'); 
				var start_date_selected = $('#event_start_date_nn').val();
				var end_date_selected = $('#event_end_date_nn').val();
				var date1 = new Date(start_date_selected);
				var date2 = new Date(end_date_selected);
				var dateArray = new Array();
				var currentDate = date1;
				while (currentDate <= date2) {
					dateArray.push(new Date (currentDate));
					currentDate = currentDate.addDays(1);
				}
				var arrayLength = dateArray.length;
				console.log("array_leng"+arrayLength);
				for (var i = 0; i < arrayLength; i++) {
					let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
					$('#radioId'+day_new_value).show();
				}
                
		}
		/////////   Event date time update
		var start_date_selected = $('#event_start_date_nn').val();
		var end_date_selected = $('#event_end_date_nn').val();
		var date1 = new Date(start_date_selected);
		var startd = start_date_selected;
		let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(startd).getDay()];
		let monthNames = ["January", "February", "March", "April", "May", "June",
		"July", "August", "September", "October", "November", "December"
		][new Date(startd).getMonth()];
		var start_day_value = new Date(startd).getDate();
		$("#weekday_value").html("Weekly on "+weekday);
		$("#monthly_value").html("Monthly on "+start_day_value);
		$("#yearly_value").html("Annually on "+start_day_value+" "+monthNames);

		var start_update = new Date(start_date_selected),
        end_update   = new Date(end_date_selected),
        diff_update  = new Date(end_update - start_update),
        days_diff  = diff_update/1000/60/60/24;
        console.log("days_diff");
        console.log(days_diff);
		if(days_diff < 2){
			$("#custom_value").html("Custom (For enable please select correct date range)");
            $('#custom_value').prop('disabled', true);
        }else{
			$("#custom_value").html("Custom");
			$('#custom_value').prop('disabled', false);
		}
        if(days_diff < 7){
			$("#weekday_value").html("Weekly on "+weekday+" (For enable please select correct date range)");
            $('#weekday_value').prop('disabled', true);
        }else{
			$('#weekday_value').prop('disabled', false);
		}
        if(days_diff < 31){
			$("#monthly_value").html("Monthly on "+start_day_value+" (For enable please select correct date range)");
            $('#monthly_value').prop('disabled', true);
        }else{
			$('#monthly_value').prop('disabled', false);
		}
        if(days_diff < 365){
			$("#yearly_value").html("Annually on "+start_day_value+" "+monthNames+" (For enable please select correct date range)");
            $('#yearly_value').prop('disabled', true);
        }else{
			$('#yearly_value').prop('disabled', false);
		}

	}
	function customChangeUpdate(){
		console.log("Dfdfd");
		$('.custom_value_update').prop('disabled', false);
		var event_repeat_option = $('.event_repeat_optionn').val();
		console.log("event_repeat_optionkkk");
		console.log(event_repeat_option);
		if(event_repeat_option == "Custom"){
			console.log("custommmmmm");
			var start_date_selected = $('#event_start_date_nnn').val();
			var end_date_selected = $('#event_end_date_nnn').val();
			var date1 = new Date(start_date_selected);
			var date2 = new Date(end_date_selected);
			var Difference_In_Time = date2.getTime() - date1.getTime();
			var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
			console.log("Difference_In_Time");
			console.log(Difference_In_Days);
			if(Difference_In_Days > 5){
				$('#event_start_end_date_select_update').show();
				$('#event_start_end_date_div_update').hide();
				$('.custom-class-update').css('display','block');
				for($i =1;$i<=7;$i++){
					$('#radioupdate'+$i).show();
				}
			}else{
				for($i =1;$i<=7;$i++){
					$('#radioupdate'+$i).hide();
				}
				$('#event_start_end_date_select_update').show();
				$('#event_start_end_date_div_update').hide();
				$('.custom-class-update').css('display','block');
				var dateArray = new Array();
				var currentDate = date1;
				while (currentDate <= date2) {
					dateArray.push(new Date (currentDate));
					currentDate = currentDate.addDays(1);
				}
				var arrayLength = dateArray.length;
				for (var i = 0; i < arrayLength; i++) {
					let day_new_value = ['1', '2', '3', '4', '5', '6', '7'][new Date(dateArray[i]).getDay()];
					$('#radioupdate'+day_new_value).show();
				}

			}
		}
		/////////   Event date time update
		console.log("rrrrrrrrrrr");
		var start_date_selected = $('#event_start_date_nnn').val();
		var end_date_selected = $('#event_end_date_nnn').val();
		var startd = start_date_selected;
		let weekday = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date(startd).getDay()];
		let monthNames = ["January", "February", "March", "April", "May", "June",
		"July", "August", "September", "October", "November", "December"
		][new Date(startd).getMonth()];
		var start_day_value = new Date(startd).getDate();
		$(".weekday_value_update").html("Weekly on "+weekday);
		$(".monthly_value_update").html("Monthly on "+start_day_value);
		$(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames);

		var start_update = new Date(start_date_selected),
        end_update   = new Date(end_date_selected),
        diff_update  = new Date(end_update - start_update),
        days_diff  = diff_update/1000/60/60/24;
        console.log("days_diff");
        console.log(days_diff);
		if(days_diff < 2){
			$(".custom_value_update").html("Custom (For enable please select correct date range)");
			$('.custom_value_update').prop('disabled', true);
		}else{
			$(".custom_value_update").html("Custom");
			$('.custom_value_update').prop('disabled', false);
		}
        if(days_diff < 7){
			$(".weekday_value_update").html("Weekly on "+weekday+" (For enable please select correct date range)");
            $('.weekday_value_update').prop('disabled', true);
        }else{
			$('.weekday_value_update').prop('disabled', false);
		}
        if(days_diff < 31){
			$(".monthly_value_update").html("Monthly on "+start_day_value+" (For enable please select correct date range)");
            $('.monthly_value_update').prop('disabled', true);
        }else{
			$('.monthly_value_update').prop('disabled', false);
		}
        if(days_diff < 365){
			$(".yearly_value_update").html("Annually on "+start_day_value+" "+monthNames+" (For enable please select correct date range)");
            $('.yearly_value_update').prop('disabled', true);
        }else{
			$('.yearly_value_update').prop('disabled', false);
		}
	}
	function hideModal(){
		console.log("FGfg");
		$('#update-event').modal('hide');
		$('#myModalUpdate').modal('hide');
		
	}
	$( function() {
    	$( "#event_start_date_nn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
		$( "#event_end_date_nn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
		$( "#event_start_end_date_new" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
		$( "#event_start_date_nnn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
		$( "#event_end_date_nnn" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
		$( "#event_start_end_date_neww" ).datepicker({format: 'yyyy-mm-dd',autoclose: true});
  	} );
	
</script>	
</body>
</html>
