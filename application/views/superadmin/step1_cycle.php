<!DOCTYPE html>
<html lang="en">
<?php
$title_name = 'Step 1 Cycle';  
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title_name; ?> | Super Admin | Project91</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/bootstrap/dist/css/bootstrap.css');?>">  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/perfect-scrollbar/css/perfect-scrollbar.css');?>">  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/sweetalert/sweetalert.css');?>">  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css');?>">  
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor_components/datatable/datatables.min.css');?>"> 
    <!-- Style-->  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/css/checkbox_style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/css/skin_color.css');?>">
    <!--custom css-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/css/lib/control/iconselect.css');?>">
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
    <section class="content">
      <div class="row">
        <div class="col-xl-12 col-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Step 1 Cycle</h3>
              <button data-toggle="modal" data-target="#add-step1_cycle" class="float-right waves-effect waves-light btn btn-rounded btn-primary">Add Subject</button>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table id="example" class="table table-bordered table-hover display margin-top-10 w-p100">
                  <thead class="bg-success">
                    <tr>
                      <th>Sr. No</th>
                      <th>Day</th>
                      <th>Course Code</th>
                      <th>Subject</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Hours</th>
                      <th>ALC</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($step1_cycle){
                      $cnt=1;
                      foreach ($step1_cycle as $mo) {
                        // $date = date('dS M Y g:i A',strtotime($mo->date));
                        $start_time = date('g:i A',strtotime($mo->start_time));
                        $end_time = date('g:i A',strtotime($mo->end_time));
                        ?>
                        <tr class="show-step1_cycle<?php echo $mo->id; ?>">
                          <td><?php echo $cnt; ?></td>
                          <td><?php echo $mo->day; ?></td>
                          <td><?php echo $mo->course_code; ?></td>
                          <td><?php echo $mo->subject; ?></td>
                          <td><?php echo $start_time; ?></td>
                          <td><?php echo $end_time; ?></td>
                          <td><?php echo $mo->hours; ?></td>
                          <td><?php echo $mo->alc; ?></td>
                          <td class="text-left">
                            <a onclick="editStep1Cycle(<?php echo $mo->id; ?>);" href="javascript:void(0);" title="Edit"><i class="fa fa-edit text-primary font-size-20 mr-5"></i></a>
                            <a onclick="deleteStep1Cycle(<?php echo $mo->id; ?>);" href="javascript:void(0);" title="Delete"><i class="fa fa-trash text-danger font-size-20"></i></a>
                          </td>
                        </tr>
                        <?php
                        $cnt++;
                      }
                    }
                    ?>
                  </tbody>
                  <tfoot class="bg-success">
                    <tr>
                      <th>Sr. No</th>
                      <th>Day</th>
                      <th>Course Code</th>
                      <th>Subject</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Hours</th>
                      <th>ALC</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>                       
        </div>        
      </div>
    </section>
  </div>
</div>
<!-- /.content-wrapper -->
<!--Start Modal Add Step 1 Cycle-->
<div id="add-step1_cycle" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Add Subject</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <form method="POST" name="add_step1_cycle_form" id="add_step1_cycle_form" class="add_step1_cycle_form" autocomplete="off" enctype="multipart/form-data">        
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Day <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="number" name="day" id="day" class="form-control" placeholder="Day" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-braille"></i></span>
                      </div>
                    </div>
                    <span id="dayErr" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Course Code <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="number" name="course_code" id="course_code" class="form-control" placeholder="Course Code" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                      </div>
                    </div>
                    <span id="course_codeErr" class="text-danger"></span>
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Subject <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-book"></i></span>
                      </div>
                    </div>
                    <span id="subjectErr" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Start Time <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="time" name="start_time" id="start_time" class="form-control" placeholder="Start Time" required="">
                    </div>
                    <span id="start_timeErr" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>End Time <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="time" name="end_time" id="end_time" class="form-control" placeholder="End Time" required="">
                    </div>
                    <span id="end_timeErr" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Hours <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="text" name="hours" id="hours" class="form-control" placeholder="Hours" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                      </div>
                    </div>
                    <span id="hoursErr" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ALC</label>
                    <div class="input-group mb-3">
                      <input type="text" name="alc" id="alc" class="form-control" placeholder="ALC">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-dot-circle-o"></i></span>
                      </div>
                    </div>
                    <span id="alcErr" class="text-danger"></span>
                  </div>
                </div>
              </div>     
            </div>
            <div class="box-footer text-center">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" id="add_step1_cycle_submit" class="btn btn-primary">Save</button>
              <img id="add_step1_cycle_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
            </div>  
          </form>              
      </div>
  </div>
</div>
<!-- End Modal Add Step 1 Cycle-->
<!--Start Modal Edit Step 1 Cycle-->
<div id="edit-step1_cycle" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel2">Edit Subject</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <form method="POST" name="edit_step1_cycle_form" id="edit_step1_cycle_form" class="edit_step1_cycle_form" autocomplete="off" enctype="multipart/form-data">        
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Day <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="number" name="day" id="day" class="form-control" placeholder="Day" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-braille"></i></span>
                      </div>
                    </div>
                    <span id="dayErr" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Course Code <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="number" name="course_code" id="course_code" class="form-control" placeholder="Course Code" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                      </div>
                    </div>
                    <span id="course_codeErr" class="text-danger"></span>
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Subject <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-book"></i></span>
                      </div>
                    </div>
                    <span id="subjectErr" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Start Time <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="time" name="start_time" id="start_time" class="form-control" placeholder="Start Time" required="">
                    </div>
                    <span id="start_timeErr" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>End Time <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="time" name="end_time" id="end_time" class="form-control" placeholder="End Time" required="">
                    </div>
                    <span id="end_timeErr" class="text-danger"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Hours <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="text" name="hours" id="hours" class="form-control" placeholder="Hours" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                      </div>
                    </div>
                    <span id="hoursErr" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>ALC</label>
                    <div class="input-group mb-3">
                      <input type="text" name="alc" id="alc" class="form-control" placeholder="ALC">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-dot-circle-o"></i></span>
                      </div>
                    </div>
                    <span id="alcErr" class="text-danger"></span>
                  </div>
                </div>
              </div>     
            </div>
            <div class="box-footer text-center">
              <input type="hidden" name="scid" id="scid">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" id="edit_step1_cycle_submit" class="btn btn-primary">Update</button>
              <img id="edit_step1_cycle_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
            </div>  
          </form>              
      </div>
  </div>
</div>
<!-- End Modal Edit Step 1 Cycle-->
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
<script src="<?php echo base_url('assets/vendor_components/datatable/datatables.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/select2/dist/js/select2.full.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/jquery-ui/jquery-ui.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/moment/min/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/sweetalert/sweetalert.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js');?>"></script>
<script src="<?php echo base_url('assets/js/template.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/js/pages/custom-scroll.js');?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/superadmin.js');?>"></script>
<?php
if(($this->session->flashdata('message')) && ($this->session->flashdata('message') != ""))
{
?>
<script type="text/javascript">
    $.toast({
            heading: 'Project91',
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
