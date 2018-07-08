<?php
session_start();
if (!isset($_SESSION["user_email"])) {
  header("location:index.php");
  exit();
}

include('connect_database.php');
$student_id=$_SESSION["user_id"];
//Parse the form data and add course to the website
if (isset($_POST['submit2'])){
	if (!empty($_FILES["student_profile_pic"]["name"])) {
		$student_profile_pic="student_images/".mt_rand(100,100000).$_FILES["student_profile_pic"]["name"];

	}



	if(move_uploaded_file($_FILES['student_profile_pic']['tmp_name'], $student_profile_pic)) {
		echo "Image uploaded sucessfully<br>";
	}

	$sql=mysqli_query($con,"SELECT student_profile_pic FROM STUDENT_DETAILS where id=$student_id LIMIT 1")or die(mysqli_error($con));
	if($sql){
		while($row=mysqli_fetch_array($sql)){
			if(file_exists($row['student_profile_pic'])
		){
				unlink($row['student_profile_pic']);
			}
		}
		$sql=mysqli_query($con, "UPDATE STUDENT_DETAILS SET student_profile_pic='$student_profile_pic' where id=$student_id")or die(mysqli_error($con));
	echo "<a href='studentupdateprofile.php'><button class='btn-sm btn-primary' >Back to my profile</button></a>";
		
	}else{
		$sql=mysqli_query($con, "INSERT INTO STUDENT_DETAILS(student_profile_pic,id) VALUES('$student_profile_pic','$id'")or die(mysqli_error($con));
	echo "<a href='studentupdateprofile.php'><button class='btn-sm btn-primary' >Back to my profile</button></a>";

	}

	
	exit();

}
if (isset($_POST['submit'])) {

$student_dd=$_POST['student_dd'];
$student_mm=$_POST['student_mm'];
$student_yyyy=$_POST['student_yyyy'];

if(empty($student_dd)) {
	$student_dd="null";	
}
if(empty($student_mm)) {
	$student_mm="null";	
}
if(empty($student_yyyy)) {
	$student_yyyy="null";	
}


$student_gender=mysqli_real_escape_string($con,$_POST['student_gender']);
$student_about=mysqli_real_escape_string($con, $_POST['student_about']);

$student_name=mysqli_real_escape_string($con, $_POST['student_name']);
$student_email=mysqli_real_escape_string($con, $_POST['student_email']);

$student_class=mysqli_real_escape_string($con,$_POST['student_class']);
$student_board=mysqli_real_escape_string($con,$_POST['student_board']);
$student_board_from_passing_year=$_POST['student_board_from_passing_year'];
$student_board_to_passing_year=$_POST['student_board_to_passing_year'];

if(empty($student_board_from_passing_year)) {
	$student_board_from_passing_year="null";	
}
if(empty($student_board_to_passing_year)){
	$student_board_to_passing_year="null";	
}

$student_address=mysqli_real_escape_string($con,$_POST['student_address']);
$student_district=mysqli_real_escape_string($con,$_POST['student_district']);
$student_state=mysqli_real_escape_string($con,$_POST['student_state']);
$student_pin_code=$_POST['student_pin_code'];


if(empty($student_pin_code)){
	$student_pin_code="null";	
}




$sql=mysqli_query($con, "SELECT * FROM STUDENT_DETAILS where id=$student_id");
$row_count=mysqli_num_rows($sql);
if ($row_count==1) {
	
	$sql=mysqli_query($con, "UPDATE STUDENT_DETAILS SET student_name='$student_name',student_email='$student_email',student_dd='$student_dd',student_mm='$student_mm',student_yyyy='$student_yyyy', student_gender='$student_gender',student_about='$student_about',student_class='$student_class',student_board='$student_board',student_board_from_passing_year='$student_board_from_passing_year',student_board_to_passing_year='$student_board_to_passing_year',student_address='$student_address',student_district='$student_district',student_state='$student_state',student_pin_code='$student_pin_code' where id='$student_id' ")or die(mysqli_error($con));
	if ($sql) {
		echo "Your details sucessfully updated!<br>";
		echo "<a href='studentprofile.php'><button class='btn-sm btn-primary' >Back to my profile</button></a>";
	}
	
}else{


$sql=mysqli_query($con,"INSERT INTO `STUDENT_DETAILS` (`id`,`student_name`,`student_email`,`student_dd`, `student_mm`, `student_yyyy`, `student_gender`, `student_about`, `student_class`, `student_board`, `student_board_from_passing_year`, `student_board_to_passing_year`, `student_address`, `student_district`, `student_state`, `student_pin_code`) 

      VALUES ('$student_id','$student_name','$student_email', '$student_dd', '$student_mm', '$student_yyyy', '$student_gender', '$student_about', '$student_class', '$student_board', '$student_board_from_passing_year', '$student_board_to_passing_year', '$student_address', '$student_district', '$student_state','$student_pin_code')") or die(mysqli_error($con));
if ($sql) {
		echo "Your details saved sucessfully!<br>";
		echo "<a href='studentprofile.php'><button class='btn-sm btn-primary' >Back to my profile</button></a>";
	}
}
}
?>