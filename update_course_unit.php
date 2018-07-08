<?php
if (isset($_GET['course_id'])) {
	$course_id=$_GET['course_id'];
	$unit_no=$_GET['unit_no'];
	$unit_title="";
	
   include 'connect_database.php';
   $query="SELECT * FROM COURSE_UNIT where course_id=$course_id AND unit_no=$unit_no LIMIT 1";
   $sql=mysqli_query($con,$query);
   if ($sql) {
   while ($row=mysqli_fetch_array($sql)) {
   	 $unit_title=$row["unit_title"];
                        
   }
   }
if (isset($_GET['delete_unit'])) {

	$sql=mysqli_query($con,"SELECT * FROM COURSE_VIDEO WHERE course_id=$course_id and unit_no=$unit_no")or die(mysqli_error($con));

	if ($sql and mysqli_num_rows($sql)>0) {
		echo "Please delete all videos of this unit and then try to delete this unit!";
		exit();
	}else{

		$sql2=mysqli_query($con,"DELETE FROM COURSE_UNIT where course_id=$course_id and unit_no=$unit_no")or die(mysqli_error($con));
		if ($sql2) {
			echo "Sucessfully deleted $unit_no unit!";
			echo "<script>location.href='coursevdupld.php';</script>";
		}
	}
	exit();
}

echo "<h3>Unit no :$unit_no Title: $unit_title</h3>";

}
?>

<form action="coursevdupld.php" method="post" enctype="multipart/form-data"  >
						<table>
							
							<tr style="display: none;">
								<td>
									<label>Select Unit No</label>
								</td>
								<td>
									<input type="number" class="form-control di" name="unit_no" required="true"  value="<?php echo $unit_no; ?>"  />
										
									</select>
								</td>
							</tr>
							
							<tr>
								<td>
									<label>Update Unit Title</label>
								</td>
								<td>
									<input class="form-control"  type="text" name="unit_title" size="30" value="<?php echo $unit_title; ?>" required="true" >
								</td>
							</tr>
							
							<tr>
								<td></td>
								<td>
									<input class="btn btn-primary" type="submit" name="update_unit_submit" value="Submit">&nbsp;&nbsp;
								
									<input class="btn btn-primary" type="reset" name="reset"  value="Reset"/>
								</td>

							</tr>
						</table>
						
					</form>