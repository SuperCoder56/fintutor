
<nav class="navbar navbar-expand-md " style=" box-shadow: 0 4px 4px rgba(0,0,0,0.5);

	 z-index: 200px;
	 background:#206ED2;
	 margin-bottom: 4px;" >	
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon" style="color: white;"><i class="fas fa-bars"></i></span>

			</button>
			<a class="navbar-brand navbar-left" href="#" style="font-size: 26px;"><img src="images/logo.png" height="50px" height="50px" >&nbsp;<span style="font-weight: 600; font-family: cursive;font-size: 30px;color: white;">FinTutor</span></a>

			<div class="collapse navbar-collapse justify-content-end " id="navbarNavDropdown">
				<ul class=" nav navbar-nav  ">
					<li class="nav-item active">
						<a  href="index.php">Home <span class="sr-only">(current)</span></a>
						<div class="nav_underline"></div>
					</li>
					<li >
						<a  href="tutors.php">Tutors</a>
						<div class="nav_underline"></div>
						
					</li>
					<li >
						<a  href="courseSearch.php">Courses</a>
						<div class="nav_underline"></div>
						
					</li>
					<!-- <li >
						<a  href="studymaterial.php">Study Material</a>
						<div class="nav_underline"></div>
						
					</li> -->
					
					<li >
						<a  href="about.php">About</a>
						<div class="nav_underline"></div>
					</li>
					<li >
						<a  href="contact.php">Contact</a>
						<div class="nav_underline"></div>
					</li>
					<li>
						<?php 

						       $position=$_SESSION['user_position'];
						       $account_url="";
						if ($position=="Teacher"||$position=="teacher") {
		
	                     $account_url="teacherdashboard.php";
	                 }elseif($position=="Student"||$position=="student"){
		               $account_url="studentdashboard.php";
		
	                   }elseif($position=="Admin"||$position=="admin"){
		                 $account_url="admindashboard.php";
		
	                          }else{
	                          	 $account_url="index.php";
	                          }
                               
	                          
						?>
						<a   href="<?php echo $account_url; ?>"  >My Account</a>
						<div class="nav_underline"></div>
					</li>
					<li >
						<a  href="logout.php?logout=1" >Logout</a>
						<div class="nav_underline"></div>
                        
					</li>
					
					
				</ul>
			</div>
		</nav>