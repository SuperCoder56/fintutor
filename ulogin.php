<?php
session_start();
if(isset($_POST["user_email"]))
{
	$user_email=$_POST["user_email"];
	$user_password=$_POST["user_password"];

	
	include("../connect_database.php");
    $sql=mysqli_query($con,"SELECT * FROM USERS WHERE user_email='$user_email' AND password='$user_password' LIMIT 1") or die(mysqli_error($con));
    if ($sql!=FALSE) {
        $existCount=mysqli_num_rows($sql);
    if($existCount==1){
	
	while ($row=mysqli_fetch_array($sql)) {
				$_SESSION["user_id"]=$row["id"];
				$_SESSION["user_position"]=$row["position"];
				$position=$row["position"];
				$_SESSION["user_name"]=$row["user_name"];
	            $_SESSION["user_email"]=$row["user_email"];
	             $_SESSION["user_password"]=$row["password"];
	
	}
	
	
	if ($position=="Teacher"||$position=="teacher") {
		
	
		echo "Teacher";
	}elseif($position=="Student"||$position=="student"){
		
		echo "Student";
	}elseif($position=="Admin"||$position=="admin"){
		
		echo "Admin";
		
	}
exit();
}else{
	echo "Incorrect email or password ";
	exit();
}
    }
   
}
?>