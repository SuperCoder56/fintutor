<?php
if (isset($_GET['course_id'])) {
	$course_id=$_GET['course_id'];
	$unit_no=$_GET['unit_no'];
	$video_no=$_GET['video_no'];
   include 'connect_database.php';
   $query="SELECT * FROM COURSE_VIDEO where course_id=$course_id AND unit_no=$unit_no AND video_no=$video_no LIMIT 1";
   $sql=mysqli_query($con,$query);
   if ($sql) {
   while ($row=mysqli_fetch_array($sql)) {
   	 $video_title=$row["video_title"];
                        $video_url=$row["video_file"];
                        $video_text=$row["video_text"];
                        $video_r_file=$row["video_r_file"];
   }
   }
echo "
<h3>$unit_no. $video_no $video_title
</h3>";

}
?>

<form action="coursevdupld.php" method="post" enctype="multipart/form-data"  >
						<table>
							<tr style="display: none;">
								<td >
									<label>Select Unit No</label>
								</td>
								<td>
									<input class="form-control" name="video_update_submit" required="true"  value="<?php echo $unit_no; ?>" />
										
									</select>
								</td>
							</tr>
							<tr style="display: none;">
								<td>
									<label>Select Unit No</label>
								</td>
								<td>
									<input class="form-control di" name="unit_no2" required="true"  value="<?php echo $unit_no; ?>"  />
										
									</select>
								</td>
							</tr>
							<tr style="display: none;" >
								<td>
									<label>Enter Video No</label>
								</td>
								<td>
									<input class="form-control" type="number" name="video_no" size="10" required="true" value="<?php echo $video_no; ?>" min="1">
								</td>
							</tr>
							<tr>
								<td>
									<label>Update Video Title</label>
								</td>
								<td>
									<input class="form-control"  type="text" name="video_title" size="30" value="<?php echo $video_title; ?>" required="true" >
								</td>
							</tr>
							<tr>
								<td>
									<label>Upload video file(.mp4,.mkv)</label>
								</td>
								<td>
									<input  type="file" name="video_file" id="video_file"  />
									<a href="<?php echo $video_url; ?>">Download</a>
									 
								</td>
							</tr>
							<tr>
								<td>
									<label>Upload Reading material file(.doc,.pdf)</label>
								</td>
								<td>
									<input type="file" name="video_r_file" id="video_r_file" placeholder="optional" />
									<?php
									if ($video_r_file!="") {
										echo "<a href='$video_r_file'>Download</a>";
									}
									?>
								</td>
							</tr>
							<tr>
								<td>
									<label>Video description</label>
								</td>
								<td>
									<textarea class="form-control" name="video_text" rows="6" cols="16" placeholder="optional" >
									  <?php echo $video_text; ?>
									</textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input class="btn btn-primary" type="submit" name="submit2" value="Submit">&nbsp;&nbsp;
								
									<input class="btn btn-primary" type="reset" name="reset"  value="Reset"/>
								</td>

							</tr>
						</table>
						
					</form>