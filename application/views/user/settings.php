<!DOCTYPE html>
<html lang="en">
<?php 
$title_name = 'Settings'; 
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
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/bootstrap/dist/css/bootstrap.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/perfect-scrollbar/css/perfect-scrollbar.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/sweetalert/sweetalert.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/select2/dist/css/select2.min.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css');?>">  
		<link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/vendor_components/fullcalendar/fullcalendar.min.css');?>"> 
    <!-- Style-->  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/planner/css/style.css');?>">
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
				 	<span class="pull-left mt-10">
					 	<span class="font-weight-bold">
					 		<h4 class="box-title">Settings</h4>
					 	</span>
					</span>
					</div>					
				<div class="box-body p-10">
				  <ul class="todo-list" id="slimtest5">				  
					<?php
					if($allocator_mod > 0){
						//if taken allocator module start
					?>
					<li class="p-0 mb-10">
					  <div class="box p-15 mb-0 d-block bb-2 border-lightgray">
						  <i class="mdi mdi-table-edit mb-0 mr-5 ml-15 font-size-18"></i>
						  <span title="Edit Exam, Exam Date and Confidence Level" class="text-line text-success font-size-16 font-weight-500"> <a href="#" data-toggle="modal" data-target="#modal-course">
						  Edit Exam, Exam Date and Confidence Level
							</a></span>	
						</div>
					</li>
					<?php
					}
					?>					
				  </ul>
				</div>
			  </div>
			</div>
			
		  </div>	
	</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
<?php
// include 'footer_bar.php';
?>

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

<?php
if($allocator_mod > 0){
	//if taken allocator module start
?>
  <!-- Select Course Modal start -->
  <div class="modal center-modal fade" data-backdrop="static" data-keyboard="false" data-backdrop="static" id="modal-course" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Edit Exam, Exam Date and Confidence Level</h5>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  </div>
		  <form method="POST" name="update_course_form" id="update_course_form" class="update_course_form" autocomplete="off">
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
									?><option value="<?php echo $ac->id;?>" <?php if($sc->course_id == $ac->id){ echo 'selected'; } ?>><?php echo $ac->name;?></option><?php
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
				<!-- /.box-body -->
				<div class="box-footer text-center">
					<input type="hidden" name="page" value="settings">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
		  	</div>	
		  </form>
		</div>
	  </div>
	</div>
  <!-- /.Select Course modal end-->
<?php
}
?>

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
<script src="<?php echo base_url('assets/js/front.js');?>"></script>
<script type="text/javascript">
$(function(){
  function rescaleCaptcha(){
    var width = $('.g-recaptcha').parent().width();
    var scale;
    if (width < 302) {
      scale = width / 302;
    } else{
      scale = 1.0; 
    }

    $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('transform-origin', '0 0');
    $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
  }

  rescaleCaptcha();
  $( window ).resize(function() { rescaleCaptcha(); });
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
</script>

</body>
</html>
