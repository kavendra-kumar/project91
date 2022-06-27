<!DOCTYPE html>
<html lang="en">
<?php
$title_name = 'Programs';  
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
              <h3 class="box-title">Programs</h3>
              <button data-toggle="modal" data-target="#add-program" class="float-right waves-effect waves-light btn btn-rounded btn-primary">Add Program</button>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table id="example" class="table table-bordered table-hover display margin-top-10 w-p100">
                  <thead class="bg-success">
                    <tr>
                      <th>Sr. No</th>
                      <th>Name</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($program){
                      $cnt=1;
                      foreach ($program as $pro) {
                        $date = date('dS M Y g:i A',strtotime($pro->date));
                        ?>
                        <tr class="show-program<?php echo $pro->id; ?>">
                          <td><?php echo $cnt; ?></td>
                          <td><?php echo $pro->name; ?></td>
                          <td><?php echo $date; ?></td>                          
                          <td class="text-center">
                            <a href="<?php echo base_url('super-admin/view-program/'.$pro->id); ?>" href="javascript:void(0);" title="View"><i class="fa fa-external-link text-success font-size-20 mr-5"></i></a>
                            <a onclick="editProgram(<?php echo $pro->id; ?>);" href="javascript:void(0);" title="Edit"><i class="fa fa-edit text-primary font-size-20 mr-5"></i></a>
                            <a onclick="deleteProgram(<?php echo $pro->id; ?>);" href="javascript:void(0);" title="Delete"><i class="fa fa-trash text-danger font-size-20"></i></a>
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
                      <th>Name</th>
                      <th>Created Date</th>
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
<!--Start Modal Add Program-->
<div id="add-program" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Add Program</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <form method="POST" name="add_program_form" id="add_program_form" class="add_program_form" autocomplete="off" enctype="multipart/form-data">        
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Name <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-book"></i></span>
                      </div>
                    </div>
                    <span id="nameErr" class="text-danger"></span>
                  </div>
                </div>
              </div>       
            </div>
            <div class="box-footer text-center">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" id="add_program_submit" class="btn btn-primary">Save</button>
              <img id="add_program_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
            </div>  
          </form>              
      </div>
  </div>
</div>
<!-- End Modal Add Program-->
<!--Start Modal Edit Program-->
<div id="edit-program" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel2">Edit Program</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <form method="POST" name="edit_program_form" id="edit_program_form" class="edit_program_form" autocomplete="off" enctype="multipart/form-data">        
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Name <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-book"></i></span>
                      </div>
                    </div>
                    <span id="nameErr" class="text-danger"></span>
                  </div>
                </div>
              </div>       
            </div>
            <div class="box-footer text-center">
              <input type="hidden" name="pid" id="pid">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" id="edit_program_submit" class="btn btn-primary">Update</button>
              <img id="edit_program_loader" style="visibility: hidden;" src="<?php echo base_url('assets/images/loading.gif'); ?>">
            </div>  
          </form>              
      </div>
  </div>
</div>
<!-- End Modal Edit Program-->
  
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
