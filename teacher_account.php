<?php
include 'connect_database.php';
if (isset($_POST['delete_s_request'])) {
	$s_id=$_POST['delete_s_request'];
	
	
   $sql=mysqli_query($con, "DELETE FROM STUDENT_SUBJECTS WHERE student_email='$s_id'");
   if ($sql) {
	echo "All subject deletd";
}
}

if (isset($_POST['delete_s_request_1'])) {
	$s_id=$_POST['delete_s_request_1'];
	
	
   $sql=mysqli_query($con, "DELETE FROM STUDENT_SUBJECTS WHERE id='$s_id'");
   if ($sql) {
	echo "Subject deletd";


}
}
?>