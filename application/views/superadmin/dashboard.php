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
    <title><?php echo $title_name; ?> | Super Admin | Project91</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/bootstrap/dist/css/bootstrap.css');?>">  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/perfect-scrollbar/css/perfect-scrollbar.css');?>">  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/sweetalert/sweetalert.css');?>">  
    <link rel="stylesheet" href="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css');?>">  
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
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-12 col-12">
          <div class="box bg-primary-light-cust">
            <div class="box-body d-flex px-0">
              <div class="flex-grow-1 p-30 flex-grow-1 dask-bg bg-none-md">
                <div class="row">
                  <div class="col-12 col-xl-12">
                    <div class="col-lg-3 col-12">
              <a href="<?php echo base_url('super-admin/registered-users');?>" class="box pull-up">
                <div class="box-body">
                  <div class="d-flex align-items-center">
                    <div class="icon bg-primary-light rounded-circle w-60 h-60 text-center l-h-80">
                      <span class="font-size-30 icon-Group"><span class="path1"></span><span class="path2"></span></span>
                    </div>
                  </div>
                  <div class="mt-20">
                      <center><h2><?php echo registeredUsers(); ?></h2>              
                      <h4 class="mb-0">Registered Users</h4></center>
                  </div>
                </div>
              </a>
            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>                          
        </div>
        
      </div>
    </section>
    <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->

<?php
// include 'chatbox.php';
?>  
<script src="<?php echo base_url('assets/js/vendors.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/select2/dist/js/select2.full.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/jquery-ui/jquery-ui.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/moment/min/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/fullcalendar/fullcalendar.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/fullcalendar/lib/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/fullcalendar/fullcalendar.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/sweetalert/sweetalert.min.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/template.js');?>"></script>
<script src="<?php echo base_url('assets/css_js/superadmin_pages/js/pages/custom-scroll.js');?>"></script>
<script src="<?php echo base_url('assets/js/pages/calendar-1.js');?>"></script>
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
