<?php
session_start();
if (!isset($_SESSION["user_email"])) {
}else{
$user_id=$_SESSION["user_id"];
$user_email=$_SESSION["user_email"];
$password=$_SESSION["user_password"];
include("connect_database.php");
$sql=mysqli_query($con,"SELECT * FROM USERS WHERE id='$user_id'  LIMIT 1");
$existCount=mysqli_num_rows($sql);
if($existCount==0){
exit();
}
else{
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <meta  name="viewport" content="width=device-width">
        <meta  name="description" content="">
        <meta  name="keywords" content="">
        
        <title>Teacher</title>
        <?php 
        include 'cdns.php';
        ?>
        <style type="text/css">
        body,.container-fluid{
        background: #f0f0f0;
        }
        .left_section{
        background:white;
        margin:5px 5px;
        padding: 40px 6px;
        text-align: left;
        box-shadow: 0 2px 2px rgba(0,0,0,0.5);
        }
        .section{
        background: white;
        padding: 4rem 4rem;
       
        text-align: left;
        font-family: sans-serif;
        font-size: 16px;
        margin:5px 5px;
        box-shadow: 0 2px 2px rgba(0,0,0,0.5);
        }
        .section h1{
            color: white;
            padding: auto;
           

        }

        .btn{
        border-radius: 0px;
        }
        .t_head{
            width: 30%;
        }
        .teacher{
        border-radius: 50%;
        }
        .alert{
        top: 0px;
        left: 0px;
        text-align: center;
        position: absolute;
        z-index: 4px;
        }
        hr{
            width: 26%;
            text-align: left;
            margin:0;
        }
        </style>
    </head>
    <body>
        <?php
        
        if (!isset($_SESSION["user_email"])) {
        include('header.php');
        }else{
        include('header_account.php');
        }
        ?>
        <div class="container">
            <div class="row" >
                
                <div class="col-sm-12">
                  
                        <?php
                        include('connect_database.php');
                        $course_id=$_GET['cid'];
                        
                        $query="SELECT * FROM COURSES where course_id='".$course_id."'";
                        $sql=mysqli_query($con,$query);
                        $row_count=mysqli_num_rows($sql);
                        $course_name=" ";
                        $course_instructor=" ";
                        $course_price=" ";
                        $course_category=" ";
                        $course_level=" ";
                        $course_language=" ";
                        $course_subject=" ";
                        $course_audience=" ";
                        $course_details=" ";
                        $course_image=" ";
                        $course_price=" ";
                        $teacher_id=" ";
                        
                        if($row_count==1){
                        while($row=mysqli_fetch_array($sql)){
                        
                        $course_name=$row['course_name'];
                        $course_instructor=$row['course_instructor'];
                        $course_price=$row['course_price'];
                        $course_category=$row['course_category'];
                        $course_level=$row['course_level'];
                        $course_language=$row['course_language'];
                        $course_subject=$row['course_subject'];
                        $course_audience=$row['course_audience'];
                        $course_details=$row['course_details'];
                        $course_image=$row['course_image'];
                        $course_price=$row['course_price'];
                        $teacher_id=$row['teacher_id'];
                        }
                        }
                        
                        ?>
                        
                       
                        
                    
                    <div class="section" style="background-image:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.5)) , url('<?php echo $course_image; ?>');background-size:cover;height: 68vh;background-repeat: no-repeat; ">
                        <h1 class="display-4 text-center" style="margin-top: 30vh;"><?php echo $course_name; ?></h1>
                        <?php
                        include('connect_database.php');
                        $course_id=$_GET['cid'];
                        if (isset($_SESSION['user_email'])) {
                        $sql=mysqli_query($con,"SELECT * FROM STUDENT_COURSES WHERE course_id='$course_id' AND student_id='$user_id'") or die(mysqli_error($con)) ;
                        $row_count=mysqli_num_rows($sql);
                        if ($row_count==1 or $teacher_id==$user_id) {
                           
                        echo "<center><a href='course.php?cid=$course_id' >
                        <button class='btn btn-primary'>Go to class</button>
                        </a></center>;";
                        }else{
                        
                        if($course_price==0){
                        
                        echo "<p align='center' class='course_price'>FREE Course</br>";
                            echo "<center><a href='courseFirst.php?cid=$course_id&enroll=$course_id'><button class='btn btn-primary' >Enroll now </button></a><center>";
                            }else{
                            echo "<p align='center' class='course_price'> Price: &#8377;".$course_price."/-</br>";
                                echo "<center><button class='btn btn-primary'>Buy now</button></center>;";
                                }
                                }
                                }else{
                                if($course_price==0){
                                
                                echo "<p align='center' class='course_price'>FREE Course</br>";
                                    echo "<center><a href='courseFirst.php?cid=$course_id&enroll=$course_id'><button class='btn btn-primary' >Enroll now </button></a><center>";
                                    }else{
                                    echo "<p align='center' class='course_price'> Price: &#8377;".$course_price."/-</br>";
                                        echo "<center><button class='btn btn-primary'>Buy now</button></center>;";
                                        }
                                        
                                        }
                                        
                                        ?>
                                        
                                    </div>
                                    <div class="section">
                                        <h3 class="t_head">Course Introduction</h3>
                                          <hr class="my-1">
                                        <p><span class="p_clr">Category: </span><?php echo $course_category; ?></p>
                                        <p><span class="p_clr">Level: </span><?php echo $course_level; ?></p>
                                        <p><span class="p_clr">Language: </span><?php echo $course_language; ?></p>
                                       
                                        
                                    
                                        
                                        <p><span class="p_clr">Details: </span><?php echo $course_details; ?></p>
                                        
                                    </div>
                                    
                                    <div class="section">
                                        
                                        <h3 class="t_head">Course curriculum</h3>
                                          <hr class="my-1">
                                        <?php
                                        
                                        $sql=mysqli_query($con,"SELECT DISTINCT unit_no, unit_title FROM COURSE_UNIT where course_id='$course_id' ORDER BY unit_no");
                                        if ($sql!=FALSE) {
                                            $row_count=mysqli_num_rows($sql);
                                        $arr_no="";
                                        $arr_title="";
                                        
                                        if($row_count>0){
                                        while($row=mysqli_fetch_array($sql)){
                                        $arr_no.=$row['unit_no']."-";
                                        $arr_title.=$row['unit_title']."-";
                                        
                                        }
                                        }
                                        $unitT=explode("-", $arr_title);
                                        $unitN=explode("-", $arr_no);
                                        
                                        for ($i=0; $i < sizeof($unitN)-1; $i++) {
                                        
                                        echo "<h3>Unit No. ".$unitN[$i]." ".$unitT[$i]."</h3>";
                                        
                                        $query="SELECT * FROM COURSE_VIDEO where course_id='".$course_id."' AND unit_no='".$unitN[$i]."'";
                                        $sql=mysqli_query($con,$query);

                                        if ($sql!=FALSE){
                                             $row_count=mysqli_num_rows($sql);
                                        
                                        if($row_count>0){
                                        while($row=mysqli_fetch_array($sql)){
                                        $video_no=$row["video_no"];
                                        
                                        echo "<p>".$row["video_no"]." ".$row["video_title"]."</p>";
                                        
                                        }
                                        }
                                        }

                                        }
                                       
                                          
                                        }
                                        
                                        ?>
                                        
                                    </div>
                                    <div class="section">
                                        <?php
                                        $teacher_name="";
                                        $teacher_about="";
                                        $teacher_graduation="";
                                        $teacher_email="";
                                        $teacher_image="";
                                        $sql=mysqli_query($con,"SELECT * FROM TEACHER_DETAILS WHERE id='$teacher_id' ");
                                        while ($row=mysqli_fetch_array($sql)) {
                                        $teacher_name= $row['teacher_name'];
                                        $teacher_about= $row['teacher_about'];
                                        $teacher_graduation= $row['teacher_graduation'];
                                        $teacher_email= $row['teacher_email'];
                                        $teacher_image= $row['teacher_profile_pic'];
                                        }
                                        ?>
                                        <h3 class="t_head">Course Instructor</h3>
                                          <hr class="my-1">
                                        <img src="<?php echo $teacher_image; ?>" height="200px" width="200px" style="border-radius:50%;">
                                        <p><span class="p_clr">Instructor: </span><?php echo $teacher_name; ?></p>
                                        <p><span class="p_clr">Education: </span><?php echo $teacher_graduation; ?></p>
                                        <p><span class="p_clr">Email: </span><?php echo $teacher_email; ?></p>
                                        <p><span class="p_clr">About: </span><?php echo $teacher_about; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <?php
                        if (isset($_GET['enroll'])) {
                        $course_id=$_GET['enroll'];
                        if (isset($_SESSION['user_email'])) {
                        include('connect_database.php');
                        $student_id=$_SESSION['user_id'];
                        $student_email=$_SESSION['user_email'];
                        $purchase_date=date('d/m/y');
                        $sql=mysqli_query($con, "SELECT * FROM STUDENT_COURSES where course_id='$course_id' AND student_id='$student_id'");
                        $row_count=mysqli_num_rows($sql);
                        if ($row_count>0) {
                        
                        echo "<div class='alert alert-success alert-dismissible '>";
                            echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                            echo "<strong>Information!</strong> You already enrolled in this course!";
                        echo "</div>";
                        }else{
                        
                        $sql=mysqli_query($con, "INSERT into STUDENT_COURSES(course_id, student_id, student_email,purchase_date) VALUES('$course_id','$student_id','$student_email','$purchase_date')");
                        if ($sql) {
                        
                        echo "<div class='alert alert-success alert-dismissible '>";
                            echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                            echo "<strong>Success!</strong> You sucessfully enrolled in the course!";
                        echo "</div>";
                        }
                        
                        }
                        }
                        else{
                             echo "<div class='alert alert-info alert-dismissible '>";
                            echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                            echo "<strong>Please login to enroll in this course!";
                        echo "</div>";
                       
                        
                        }
                        }
                        ?>
                        <!--  -->
                        <?php
                        include('footer.php');
                        ?>
                        
                    </body>
                </html>