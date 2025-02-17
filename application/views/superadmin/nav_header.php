<header class="main-header">
	<div class="d-flex align-items-center logo-box justify-content-start">
		
		<!-- Logo -->
		
		<a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn" data-toggle="push-menu" role="button" onclick="myFunction()">
				<i class="fa fa-fw fa-angle-double-left" id="left_arrow"></i>
				<i class="fa fa-fw fa-angle-double-right" style="display: none" id="right_arrow"></i>
		</a>	
	</div>  
<script>
function myFunction() {
  var img = document.getElementById("myImg");
  var right = document.getElementById("right_arrow");
  var left = document.getElementById("left_arrow");
  if (img.style.display === "none") 
  {
    img.style.display = "block";
    right.style.display = "block";
    left.style.display = "none";
  } 
  else 
  {
    img.style.display = "none";
    right.style.display = "none";
    left.style.display = "block";
  }
}

function myFunction2() {
  var right1 = document.getElementById("right_arrow1");
  var left1 = document.getElementById("left_arrow1");
  if (right1.style.display === "none") 
  {
    right1.style.display = "block";
    left1.style.display = "none";
  } 
  else 
  {
    right1.style.display = "none";
    left1.style.display = "block";
  }
}
</script>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
	  <div class="app-menu">
		<!-- <ul class="header-megamenu nav">
			
			<li class="btn-group nav-item d-md-none">
				<a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button" onclick="myFunction2()">
					<i class="fa fa-fw fa-angle-double-left" id="left_arrow1"></i>
					<i class="fa fa-fw fa-angle-double-right" style="display: none" id="right_arrow1"></i>
			    </a>
			</li>
			<li class="btn-group nav-item d-none d-xl-inline-block">
				<a href="#" class="waves-effect waves-light nav-link svg-bt-icon" title="Chat">
					<i class="icon-Chat"><span class="path1"></span><span class="path2"></span></i>
			    </a>
			</li>
			<li class="btn-group nav-item d-none d-xl-inline-block">
				<a href="<?php echo base_url();?>todo" class="waves-effect waves-light nav-link svg-bt-icon" title="Todo">
					<i class="icon-Clipboard-check"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
			    </a>
			</li>
		</ul>  -->
	  </div>
		
      <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">	
			<li class="btn-group nav-item d-lg-inline-flex d-none">
				<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen" title="Full Screen">
					<i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
			    </a>
			</li>	  
			<li class="btn-group d-lg-inline-flex d-none">
				<div class="app-menu">
					<div class="search-bx mx-5">
						<form>
							<div class="input-group">
							  <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
							  <div class="input-group-append">
								<button class="btn" type="button" id="button-addon3"><i class="ti-search"></i></button>
							  </div>
							</div>
						</form>
					</div>
				</div>
			</li>
		  <!-- Notifications -->
		 <!--  <li class="dropdown notifications-menu">
			<a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="Notifications">
			  <i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
			</a>
			<ul class="dropdown-menu animated bounceIn">

			  <li class="header">
				<div class="p-20">
					<div class="flexbox">
						<div>
							<h4 class="mb-0 mt-0">Notifications</h4>
						</div>
						<div>
							<a href="#" class="text-danger">Clear All</a>
						</div>
					</div>
				</div>
			  </li>

			  <li>
				<ul class="menu sm-scrol">
				  <li>
					<a href="#">
					  <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit blandit.
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien elementum, in semper diam posuere.
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo porttitor pretium a erat.
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum fermentum.
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-user text-primary"></i> Nunc fringilla lorem 
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum, at scelerisque ipsum imperdiet.
					</a>
				  </li>
				</ul>
			  </li>
			  <li class="footer">
				  <a href="#">View all</a>
			  </li>
			</ul>
		  </li>	 -->
		  
	      <!-- User Account-->
          <li class="dropdown user user-menu">
            <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="User">
				<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
            </a>
            <ul class="dropdown-menu animated flipInX">
              <li class="user-body">
				 <a class="dropdown-item" href="javascript:void(0);" onclick="logout();"><i class="fa fa-sign-out text-muted mr-2"></i> Logout</a>
              </li>
            </ul>
          </li>	
		  
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
              <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
			  	<i class="icon-Settings"><span class="path1"></span><span class="path2"></span></i>
			  </a>
          </li> -->
			
        </ul>
      </div>
    </nav>
  </header>