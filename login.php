<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" >
	<meta  name="viewport" content="width=device-width">
	<meta  name="description" content="">
	<meta  name="keywords" content="">
	<title>Login - FinTutor</title>
	<?php
    include 'cdns.php';
	?>
	

	<script type="text/javascript">
		$(document).ready(function(){



			$('#form2').submit(function(event){
				event.preventDefault();
				
				if($('#user_password').val()!=$('#user_password_again').val())
				{
					alert('Password and conform password not matching!');
					return;
				}else{
					var position=$('#position').val();
					var user_name=$('#user_name').val();
					var user_email=$('#user_email').val();
					var user_password=$('#user_password').val();
					var ok="Your account is sucessfully created, Please login to get services!";
					$.ajax({url:"register_new_user.php",
						type:"POST",
						data:{user_name:user_name,user_email:user_email,user_password:user_password,position:position},
						success:function(data){
							alert(data);
							if (data==ok) {
								$('#user_name').val("");
								$('#user_email').val("");
								$('#user_password').val("");
								$('#user_password_again').val("");
							}
						}
					});
				}            
			});

			$('#form1').submit(function(event){
				event.preventDefault();
				
				

				var user_email=$('#user_email1').val();
				var user_password=$('#user_password1').val();

				$.ajax({url:"scripts/ulogin.php",
					type:"POST",
					data:{user_email:user_email,user_password:user_password},
					success:function(data){

						switch (data) { 
							case 'Teacher': 
							
							window.location.href = "teacherdashboard.php";
							break;
							case 'Student': 
							window.location.href = "studentdashboard.php";
							break;
							case 'Admin': 
							window.location.href = "admindashboard.php";
							break;		
							
							default:
							alert(data);
						}

					}
				});

			});	       

		});
	</script>
	<style type="text/css">
	body{
		line-height: 1.8em;
	}
	.contact_form{
		background:white;
		width: 45%;
		margin:0 auto;
		padding: 2rem 2rem;
		letter-spacing:2px;
		line-height: 1.8em;
		content: "\0020";
		min-height: 600px;
		box-shadow: 0 2px 2px rgba(0,0,0,0.5);
	}
	
	td{
		padding: 3px;
	}
	.btn{
		border-radius:0px;
	}
	.head{
		background-color: #4389E4;
		color:white;
		padding: 10px 5px;
		border-radius: 0;
	}
	label{
		font-size: 14px;
		line-height: 1.5em;
		font-weight:430;
	}
</style>
</head>
<body style="background-color: #FF9B60;">
	<?php
	if (!isset($_SESSION["user_email"])) {
		include('header.php');
	}else{
		include('header_account.php');
	}
	?>
	<div class="container" >
		<div class="row mt-5 mb-5">
			<div class="col-sm-12 ">
				<div class="contact_form">
					<h1 class="text-center head">Login</h1>
					<br>

					<form name="form1" method="post" id="form1" >
						<div class="form-group" >
							<label>EMAIL ADDRESS</label><br>
							<input class="form-control-sm"  type="text" name="user_email"  placeholder="Enter email address" required="true" id="user_email1"><br>
							<label>PASSWORD</label><br>
							<input class="form-control-sm" type="password" name="user_password" placeholder="Enter password" required="true" id="user_password1" ><br>
							<a href="usermanagement.php?frgt_passwd">Forget your password?</a><br>
							<button  type="submit" name="submit" class="btn-sm btn-primary text-center "  >LOG IN</button>
						</div>
					</form>

				</div>
			</div>
			
		</div>
	</div>
	<?php
	include('footer.php');
	?>
</body>
</html>