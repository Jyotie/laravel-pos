		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><span>হাজী পাইপস পয়েন্ট অব সেলস</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
				  <ul class="nav pull-right">
<!-- start: User Dropdown -->
					  <li class="dropdown">
						  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							  <i class="halflings-icon white user"></i> <?php  
							  $user=$_SESSION['MM_Username'];
							  $nameQuery= mysqli_query($conn,"select uid,name from user where email='$user'") or die(mysqli_error($conn));
							  $results=mysqli_fetch_array($nameQuery);
							  $username=$results['name'];
							  $uid=$results['uid'];
							  echo $username;?>
							  <span class="caret"></span>
						  </a>
						  <ul class="dropdown-menu">
							  <li class="dropdown-menu-title">
								  <span>Account Settings</span>
							  </li>
                              <li><a href="manage_user.php?uid=<?php echo $uid; ?>"><i class="halflings-icon user"></i> Profile</a></li>
							  <li><a href="logout.php"><i class="halflings-icon off"></i> Logout</a></li>
						  </ul>
					  </li>
					  <!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->