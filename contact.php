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
		
		<title>Contact - FinTutor</title>
		<?php 

		include 'cdns.php';

		?>
		<script type="text/javascript">
			function validate()
		{
		var error="";
		
		var email = document.getElementById( "email_of_user" );
		if( email.value == "" || email.value.indexOf( "@" ) == -1 )
		{
		error = " Please enter correct email address. ";
		alert(error);
		return false;
		}
		else
		{
		return true;
		}
		}
		</script>
		
		<style type="text/css">

			.address{
				background:white;
			   box-shadow: 0 2px 2px rgba(0,0,0,0.5);
				height: 80vh;
				letter-spacing:2px;
				margin:5px 5px;
				line-height: 1.8em;
				content: "\0020";
				
				padding: 4rem;
				text-align: center;
			}
			.contact_form{
				background:white;
				 box-shadow: 0 2px 2px rgba(0,0,0,0.5);
				height: 80vh;
				letter-spacing:2px;
				margin:5px 5px;
				line-height: 1.8em;
				content: "\0020";
				
				
				padding:4rem;
				text-align: center;

			}
			td{
				padding: 3px;
			}
			body{
				background:#ff9b60;
			}
			.social2{
				box-shadow: 0 2px 2px rgba(0,0,0,0.5);
				background: white;
				clear: both;
				height:200px;

			}
			.btn{
				border-radius:0px;
				
			}
			.myBtn{
				padding: 40px 60px;
				background:lightblue;
				border-radius: 30px; 
				color: white;
			}
			.t_head{
				font-size: 28px;
				font-weight:600;
				line-height: 1.8em;
                 font-family: serif;
				padding: 5px 5px;
			}
			.social{
				font-size: 48px;
				color:red;
				cursor: pointer;
			}
			.social>.fab{
				color: pink;
			}
		</style>
		
	</head>
	<body bgcolor="#FF9B60">
		
		<?php
		
		if (!isset($_SESSION["user_email"])) {
		include('header.php');
		}else{
		include('header_account.php');
		}
		?>
		<div class="container" >
			<div class="row mt-3 mb-3">
			<div class="col-sm-4  ">
				<diV class="address" >
				<p ><span class="t_head"><u>One stop help </u></span><br><br>
                  Use this contact form to:
				</p>
				<ul class="text-left" >
					<li style="list-style: lower-roman;">Send tutor requirement</li>
					<li style="list-style: lower-roman;" >Verification problems</li>
					<li style="list-style: lower-roman;" >Report tutors problems</li>
					<li style="list-style: lower-roman;" >Feedback and suggestions</li>
				</ul>
				
				
			</diV>
			</div>
			<div class="col-sm-8 ">
				<div class="contact_form">
					<p style="font-size: 18px;font-weight:600;"><span class="t_head"><u>Contact Form</u></span></p></p><br>
				<form action="contact.php" method="post" onsubmit="return validate();">
				<table class="align-content-center" >
					<tr>
						<td>Name</td>
						<td><input class="form-control" type="text" name="name" required="true" size="70"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input class="form-control" type="text" id="email_of_user" name="mail" required="true"></td>
					</tr>
					<tr>
						<td>Subject</td>
						<td><input class="form-control" type="text" name="subject" required="true"></td>
					</tr>
					<tr>
						<td>Message</td>
						<td><textarea  class="form-control" rows="3" cols="12" name="message" required="true" ></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td class="text-left"><button name="submit" type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
						<button name="reset" type="reset" class="btn btn-primary">Reset</button></td>
					</tr>
				</table>
			</form>

			<?php
				/* Functions we used */
				function check_input($data, $problem='')
				{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				if ($problem && strlen($data) == 0)
				{
				show_error($problem);
				}
				return $data;
				}
				function show_error($myError)
				{
				?>
				<html>
					<body>
						<b>Please correct the following error:</b><br />
						<?php echo $myError; ?>
					</body>
				</html>
				<?php
				exit();
				}
										
				$willSend=1;
										$successMessage ="";
										$errorMessage ="";
										
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: jaswinder9905@gmail.com';
										if(isset($_POST["submit"]))
										{
										if(!$_POST["name"])
										{
										$errorMessage = $errorMessage."Full Name is required.<br>";
										}
										
										if(!$_POST["mail"])
										{
										$errorMessage .= "Email Address is required.<br>";
										}
										
										if(!$_POST["message"])
										{
										$errorMessage .= "Message is required.<br>";
										}
										if($errorMessage!="")
										{
										$errorMessage='<Strong>There were error(s) in the form</strong>';
									
				echo "<script type='text/javascript'>alert('$errorMessage');</script>";
				$willSend=0;
				}
				else{
				$willSend=1;
				}
				if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['mail']))
				{
				
				echo "<script type='text/javascript'>alert('E-mail address not valid');</script>";
				$willSend=0;
				}
				else{
				$willSend=1;
				}
				
				if($willSend==1)
				{
				$emailTo="jaswinder9905@gmail.com";
				$email= check_input($_POST['mail'], 'Please enter correct email.');
				
				$fullName= check_input($_POST['name'],'Please enter correct name.');
				$subject=check_input($_POST['subject'],'Please correct your subject.');
				$message_query=check_input($_POST['message'],'Please correct your message.');
				
				$body='A new email has been received from fintutor.com.<br/>Details of sender and message are given below<br/><br/>Name: '.$fullName.'<br/>Subject:'.$subject.'<br/>Message: '.$message_query.'<br/>E-mail: '.$email.'<br/><br/>Please respond to this sender by email.<br/><br/>Regards<br/>webmater<br/>fintutor.com';
				if(mail($emailTo,$subject ,$body,$headers))
				{
				
				$successMessage="Your message has been send sucessfully. We will contact you soon!";
				echo "<script type='text/javascript'>alert('$successMessage');</script>";
				}
				else
				{
				$errorMessage="Your message has not been send.
				Refresh and Try again";
				echo "<script type='text/javascript'>alert('$errorMessage');</script>";
				}
				}
				}
				?>
				
		</div>
				
			</div>
		</div>
		<div class="container social2">
			<div class="row">
				<div class="col-12 text-center mb-5 " style="padding: 2.5rem;">
					<p  ><span class="t_head" ><u>Follow us on</u></span><br><br>
					<a href-"#" class="social" title="Facebook"><i class="fab fa-facebook-square" style="color: blue;"></i></a>&nbsp;
					<a href-"#" class="social" title="Twitter"><i class="fab fa-twitter-square" style="color:skyblue;"></i></a>&nbsp;
					<a href-"#" class="social" title="Youtube" ><i class="fab fa-youtube-square" style="color:red;"></i></a>&nbsp;
					<a href-"#" class="social" title="Google+" ><i class="fab fa-google-plus-square" style="color:brown;"></i></a>&nbsp;
                 
				</p>
				</div>
			</div>
		</div>


      <br>
      <br>
	
	</div>

	<div style="width: 10%;left: 50%;color:#666666;float: right;font-size: 14px ">
						<marquee><a class="bottom_link" href="contact.php">Contact for advertisement </a></marquee>
					</div>
	<?php
include('footer.php');
?>
		
</body>
</html>