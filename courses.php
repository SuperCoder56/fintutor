<?php
session_start();
if (!isset($_SESSION["user_email"])) {
  header("location:index.php");
  exit();
}

$user_id=$_SESSION["user_id"];
$user_email=$_SESSION["user_email"];
$password=$_SESSION["user_password"];

include("connect_database.php");

$sql=mysqli_query($con,"SELECT * FROM USERS WHERE id='$user_id'  LIMIT 1");
if($sql!=FALSE){
    $existCount=mysqli_num_rows($sql);
if($existCount==0){
    
    exit();
}


}


?>
<?php

//DElete the course if author wants
if(isset($_GET['deleteid'])){
echo 'Do you really want to delete course with ID of'
.$_GET['deleteid']. '?<a href="courses.php?yesdelete='.$_GET['deleteid'].'">Yes</a>| <a href="courses.php">NO</a>';
exit();
}
if(isset($_GET['yesdelete'])){
$id_to_delete=$_GET['yesdelete'];
$sql=mysqli_query($con, "SELECT course_image FROM COURSES WHERE course_id='$id_to_delete' LIMIT 1")or die(mysqli_error($con));
$pictodelete="";
if($sql){
	while ($row=mysqli_fetch_array($sql)){
		$pictodelete=$row['course_image'];
	}
}
$sql=mysqli_query($con,"DELETE FROM COURSES WHERE course_id='$id_to_delete' LIMIT 1") or die(mysqli_error($con));

if (file_exists($pictodelete)) {
unlink($pictodelete);
}
header('location:courses.php');
exit();
}
?>
<?php
//Parse the form data and add course to the website
$uploadOk=0;
if (isset($_POST['course_name'])) {

$teacher_id=$_SESSION['user_id'];
$course_name=mysqli_real_escape_string($con, $_POST['course_name']);
$course_instructor=mysqli_real_escape_string($con,$_POST['course_instructor']);
$course_price=mysqli_real_escape_string($con, $_POST['course_price']);
$course_category=mysqli_real_escape_string($con, $_POST['course_category']);
$course_level=mysqli_real_escape_string($con, $_POST['course_level']);
$course_language=mysqli_real_escape_string($con, $_POST['course_language']);
$course_subject=mysqli_real_escape_string($con, $_POST['course_subject']);
$course_audience=mysqli_real_escape_string($con, $_POST['course_audience']);
$course_details=mysqli_real_escape_string($con, $_POST['course_details']);
$course_image="course_images/".mt_rand(100,100000).$_FILES["fileField"]["name"];

$target_file=basename($_FILES["fileField"]["name"]);

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "<script>alert('Sorry, only JPG, JPEG and PNG files are allowed.');</script>";
    $uploadOk = 0;
}else{
    $uploadOk=1;
}
if ($uploadOk!=0) {
    $sql=mysqli_query($con, "SELECT course_id FROM COURSES WHERE course_name='$course_name' LIMIT 1");
$courseMatch=mysqli_num_rows($sql);//Count the output numbers
if ($courseMatch>0) {
echo "Sorry you tried to place a duplicate 'Course Name' into the system";
exit();
}
//Add this course into the database
$sql=mysqli_query($con,"INSERT INTO COURSES (teacher_id,course_name,course_instructor,course_price,course_category,course_level,course_language,course_subject,course_audience,course_details,course_image,course_date_added) VALUES('$teacher_id','$course_name','$course_instructor','$course_price','$course_category','$course_level','$course_language','$course_subject','$course_audience','$course_details','$course_image',now())") or die(mysqli_error($con));
move_uploaded_file($_FILES["fileField"]["tmp_name"],$course_image);
header("location:courses.php");
exit();
}
   
}

?>
<?php
include("connect_database.php");
$course_list="";
$sql=mysqli_query($con,"SELECT * FROM COURSES WHERE teacher_id='$user_id'");
$course_count=mysqli_num_rows($sql);
if($course_count>0){
while($row=mysqli_fetch_array($sql)){
$id=$row["course_id"];
$course_name=$row["course_name"];
$course_list .="$id - $course_name&nbsp;&nbsp;&nbsp;&nbsp;<a href='coursevdupld.php?cid=$id&cnme=$course_name'><i class='fas fa-upload'></i> Upload videos</a>

&nbsp;&nbsp;<a href='courses.php?deleteid=$id'><i class='fas fa-trash-alt'></i> Delete</a>
<br><br>
";
}
}else{
$course_list="Currently no courses published by you!";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <meta  name="viewport" content="width=device-width">
        <meta  name="description" content="">
        <meta  name="keywords" content="">
        
        <title>Courses</title>
        <?php
         include 'cdns.php';
       ?>
        <style type="text/css">
        .courses_list{
        background:white;
        width: 100%;
         padding: 3rem 3rem;
        font-family: sans-serif;
        font-size: 14px;
        display: inline-block;
        margin:5px 5px;
        box-shadow: 0 2px 2px rgba(0,0,0,0.5);
        }
        .course_fill_form{
        background: white;
         padding: 3rem 3rem;
        font-family: sans-serif;
        font-size: 14px;
        margin:5px 5px;
        display: block;
        box-shadow: 0 2px 2px rgba(0,0,0,0.5);
        }
        body,.container-fluid{
        background: #f0f0f0;
        }
        .btn{
        border-radius: 0px;
        padding: 10px 20px;
        margin-top: 20px;
        }
        tr{
        margin:2px 2px;
        }
        .social{
        position: fixed;
        top: 18%;
        left:0;
        background: red;
        width: 40px;
        height: 100px;
        color: white;
        text-decoration:none;
        display: none;
        }
        .social  ul>li>a:hover{
        color: blue;
        }
        .social  ul>li{
        padding:5px 5px;
        background: pink;
        
        transition: all 0.2s;
        }
        .social ul>li:hover{
        background: white;
        cursor: pointer;
        }
        </style>
    </head>
    <body>
        <div class="social">
            <ul>
                <li><a href="">F</a></li>
                <li><a href="">T</a></li>
                <li><a href="">G</a></li>
                <li><a href="">I</a></li>
                <li><a href="">L</a></li>
            </ul>
            
        </div>
        <?php
       
        if (!isset($_SESSION["user_email"])) {
        include('header.php');
        }else{
        include('header_account.php');
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <?php include("teacher_left_navbar.php"); ?>
                </div>
                <div class="col-sm-9">
                    <div class="courses_list">
                        <h3><span class='t_head'><i class="fas fa-trophy"></i> My Published courses</span></h3>
                        <?php
                        echo $course_list;
                        ?>
                    </div>
                    <div class="course_fill_form">
                        <h3><span class='t_head'><i class="fas fa-plus-circle"></i> Fill New Course Details</span></h3>
                        <form action="courses.php" enctype="multipart/form-data" name="myForm" method="post">
                            <div class="form-group">
                                <table>
                                    <tr>
                                        <td>Course Title</td>
                                        <td><input type="text" class="form-control"  name="course_name"/ required="true"></td>
                                    </tr>
                                    <td>Instructor Name</td>
                                    <td><input type="text" class="form-control" name="course_instructor" value="<?php echo $_SESSION['user_name']; ?>" required="true"/></td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>
                                        <select class="form-control" name="course_category" >
                                            <option value="Academic">Academic</option>
                                            <option value="Management">Management</option>
                                            <option value="Technical">Technical</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Level</td>
                                    <td>
                                        <select class="form-control" name="course_level" >
                                            <option value="beginner">Beginner</option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="advance">Advance</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Language</td>
                                    <td>
                                        <select class="form-control" name="course_language" >
                                            <option value="english">English</option>
                                            <option value="hindi">Hindi</option>
                                            
                                        </select>
                                    </td>
                                </tr>
                                <td>Subject</td>
                                <td><input  class="form-control" type="text" name="course_subject" required="true" /></td>
                            </tr>
                            <tr>
                                <td>Course Audience</td>
                                <td><input  class="form-control" type="text" name="course_audience" required="true" /></td>
                            </tr>
                            <tr>
                                <td>Details</td>
                                <td><textarea class="form-control" name="course_details" rows="6" cols="12" placeholder="Add course description"></textarea></td>
                            </tr>
                            <tr>
                                <td>Price<br/>
                                *For free course, fill price 0 Rupees</td>
                                <td><input  class="form-control" type="number" name="course_price" required="true" min="0" /></td>
                            </tr>
                            <tr>
                                <td>Course Image</td>
                                <td><input class="form-control"  type="file" name="fileField" id="fileField" required="true" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary"  type="submit" name="submit">Publish this course</button>&nbsp;&nbsp;
                                    <input class="btn btn-primary" type="reset" name="reset" value="Reset"></td></tr>
                                </table>
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