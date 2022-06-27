  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">	
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">			    
				<li class="treeview" >
				  <a href="#">
					<i class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
					<span onclick="window.location.href='<?php echo base_url('calendar');?>'">Calendar</span>		
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>			
				  </a>
				  <ul class="treeview-menu">
				  	<li <?php if($this->uri->segment(2) == 'events'){ echo 'class="active"'; } ?> >
							<a href="<?php echo base_url();?>todo/events">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
								<span>Events</span>
							</a>
						</li>
				  
				  </ul>
				</li>
				<?php
							if($stud_del->course_visit == 0){
								?>
							<li <?php if($title_name == 'Study Allocator'){ echo 'class="active"'; } ?> >
							  <a href="#" data-toggle="modal" data-target="#subscribe-module">
									<i class="icon-Clipboard-list"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></i>
									<span>Study Allocator</span>
							  </a>	
							</li>
								<?php
							}else{
								?>
								<li <?php if($title_name == 'Study Allocator'){ echo 'class="active"'; } ?> >
								  <a href="<?php echo base_url('planner');?>">
									  <i class="icon-Clipboard-list"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></i>
									  <span>Study Allocator</span>
									</a>	
								</li>
								<?php
							}
							?>
				
			  </ul>
		  </div>
		</div>
    </section>
  </aside>