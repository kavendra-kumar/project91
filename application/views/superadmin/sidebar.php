  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">
			    <li style="background-color: #568e8a;" class="profile-div">
			   	  <a href="<?php echo base_url('super-admin');?>">					
					<span class="profile-span">Super Admin</span>
				  </a>
			    </li>	
					<li <?php if($title_name == 'Dashboard'){ echo 'class="active"'; } ?> >
					  <a href="<?php echo base_url('super-admin/dashboard');?>">
						<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
						<span>Dashboard</span>					
					  </a>
					</li>
					<li <?php if($title_name == 'Registered Users'){ echo 'class="active"'; } ?> >
					  <a href="<?php echo base_url('super-admin/registered-users');?>">
						<i class="icon-Group"><span class="path1"></span><span class="path2"></span></i>
						<span>Registered Users</span>					
					  </a>
					</li>
					<li <?php if($title_name == 'Programs'){ echo 'class="active"'; } ?> >
					  <a href="<?php echo base_url('super-admin/programs');?>">
						<i class="icon-Book-open"><span class="path1"></span><span class="path2"></span></i>
						<span>Programs</span>					
					  </a>
					</li>
					<li <?php if($title_name == 'Calendar'){ echo 'class="active"'; } ?> >
					  <a href="<?php echo base_url('super-admin/calendar');?>">
						<i class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
						<span>Calendar</span>					
					  </a>
					</li>
					
			  </ul>
		  </div>
		</div>
    </section>
	<div class="sidebar-footer">
		<a href="javascript:void(0)" onclick="logout();" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><span class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
	</div>
  </aside>