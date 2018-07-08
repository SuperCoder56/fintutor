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
		
		<title>Change Password - FinTutor</title>
		 <?php
         include 'cdns.php';
       ?>
		
		<style type="text/css">
		body{
			background: #f0f0f0;
		}
			h3,p{
				text-align: center;
			}
			.password_cahnge_box{
				height: 50vh;
				 padding: 3rem 3rem;
				
			}
			.top_nav_links{
				text-align: left;
				padding: 10px;
				margin: 20px 40px;
			}
			.section{
				margin-top: 4px;
				background: white;
				 padding: 3rem 3rem;
				font-family: sans-serif;
				font-size: 14px;
				box-shadow: 0 2px 2px rgba(0,0,0,0.5);
			}
		
		</style>
		<script type="text/javascript">
			$(document).ready(function(){

                 $('#form1').submit(function(event){
				       event.preventDefault();
				        
                var old_password=$('#old_password').val();
                var new_password=$('#new_password').val();
                var repeat_new_password=$('#repeat_new_password').val();
                if (new_password!=repeat_new_password) {
                	alert('New password and Repeat new password not matching!');
                }else{
                	var ok="Password changed sucessfully!";
                	$.post(
                        "scripts/changepasswordchk.php",
                      {old_password:old_password,new_password:new_password,repeat_new_password:repeat_new_password},
                        function(data){
                            alert(data);
                            if (data==ok) {
                           	    $('#old_password').val("");
                           	    $('#new_password').val("");
                           	    $('#repeat_new_password').val("");
                                
                                 
                            }
                        }
                    );
                }
                
             });

                 
			});
		</script>
		
	</head>
	<body>
		<?php
				
				if (!isset($_SESSION["user_email"])) {
				include('index.php');
				}else{
				include('header_account.php');
				}
		?>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<?php
					if ($_SESSION['user_position']=='teacher' or $_SESSION['user_position']=='Teacher' ) {
					include('teacher_left_navbar.php');
					}else{
					include('student_left_navbar.php');
					}
					?>
				</div>
				<div class="col-sm-9 pt-3" style="min-height: 540px; padding: 3rem 3rem;" >
					
					<div class="password_cahnge_box section pt-3 pb-2" >
						<h3 class="t_head"><i class="fas fa-lock"></i> Password Change Section</h3>

						<h3>User name: <?php echo $_SESSION['user_name']; ?></h3>
						<p>Email: <?php echo $_SESSION['user_email']; ?></p>
						<form id="form1" >
							<table class="text-center" align="center">
								<tr>
									<td>Old password:</td><td> <input class="form-control" id="old_password" type="password" name="old_password" required="true"></td>
								</tr>
								<tr>
									<td>New password:</td><td> <input class="form-control" id="new_password" type="password" name="new_password" required="true"></td>
								</tr>
								<tr>
									<td>Repeat new password: </td><td><input  class="form-control" id="repeat_new_password" type="password" name="repeat_new_password" required="true" ></td>
								</tr>
								<tr>
									<td><input type="submit" id="submit" name="submit" value="Change password" class="btn-sm btn-primary"></td>
									<td><input type="reset" name="reset" value="Reset" class="btn-sm btn-primary" ></td>
								</tr>
							</table>
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