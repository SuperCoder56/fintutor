<?php
include('connect_database.php');

if (isset($_POST['query'])) {
	$query='';
	$query="SELECT DISTINCT(subject_name) from TEACHER_SUBJECTS WHERE subject_name LIKE '%".$_POST['query']."%'";
	$result=mysqli_query($con,$query);
	$output ="<ul class='list-unstyled s_list' >";
	if (mysqli_num_rows($result)>0) {
		
		while($row=mysqli_fetch_array($result)){
			$output.="<li>".$row['subject_name']."</li>";
		}
	}else{
		$output.="<li>Subject not found</li>";
	}

	$output.="</ul>";
	echo $output;
}

?>