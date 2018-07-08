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
$existCount=mysqli_num_rows($sql);
if($existCount==0){

exit();
}
else{
$result = mysqli_query($con,"SELECT * FROM STUDENT_DETAILS WHERE id='$user_id' LIMIT 1");
if (!$result) {
echo "Could not successfully run query " . mysql_error();
exit;
}
if (mysqli_num_rows($result) == 0) {

}
$maximumPoints = 100;
$point = 0;
while($row = mysqli_fetch_array($result)){
{
if($row['student_name'] != '')
$point+=7;
if($row['student_dd'] != ''&&$row['student_mm'] != ''&&$row['student_yyyy'] != '')
$point+=7;
if($row['student_gender'] != '')
$point+=7;
if($row['student_about'] != '')
$point+=11;
if($row['student_class'] != '')
$point+=12;
if($row['student_board'] != '')
$point+=7;
if($row['student_board_from_passing_year'] != ''&&$row['student_board_to_passing_year'] != '')
$point+=7;
if($row['student_address'] != '')
$point+=7;
if($row['student_email'] != '')
$point+=7;
if($row['student_district'] != '')
$point+=7;
if($row['student_state'] != '')
$point+=7;
if($row['student_pin_code'] != '')
$point+=7;
if($row['student_profile_pic'] != '')
$point+=7;
}
}
$percentage = ($point*$maximumPoints)/100;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <meta  name="viewport" content="width=device-width">
        <meta  name="description" content="">
        <meta  name="keywords" content="">
        
        <title>student</title>
         <?php
         include 'cdns.php';
       ?>
        <style type="text/css">
        
        hr{
        background:#66A2EE;
        height: 10px;
        }
        .user_info{
        padding: 2px 30px;
        font-size: 16px;
        line-height: 1.5em;
        background: white;
        margin: 5px 5px;
        box-shadow: 0 2px 2px rgba(0,0,0,0.5);
        
        }
        .user_info>h3{
        margin-top: 20px;
        }
        body{
            background: #f0f0f0;
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
            <div class="row">
                <div class="col-sm-3 div_style" >
                    <?php  include('student_left_navbar.php');  ?>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-9">
                            <?php
                            include('connect_database.php');
                            $sql=mysqli_query($con,"SELECT * FROM USERS where user_email='$user_email'");
                            $id="";
                            $user_count=mysqli_num_rows($sql);
                            if($user_count>0){
                            while($row=mysqli_fetch_array($sql)){
                            $id=$row['id'];
                            $join_date=$row['last_log_date'];
                            }
                            }
                            ?>
                            <h3>Name: <span class="display-4"><?php echo $_SESSION['user_name']?></span></h3><hr>
                            <p style="text-align: right;">Joined on: <?php echo $join_date; ?></p>
                            <div class="user_info">
                                <?php
                                $sql=mysqli_query($con,"SELECT * FROM STUDENT_DETAILS where id='$id'");
                                $user_count=mysqli_num_rows($sql);
                                if($user_count>0){
                                while($row=mysqli_fetch_array($sql)){
                                
                                echo "<h3 class='t_head' ><i class='fas fa-user'></i> Personal Details</h3>";
                                echo "<p>Name: ".$row['student_name']."</p>";
                                echo "<p>D.O.B.: ".$row['student_dd']."/".$row['student_mm']."/".$row['student_yyyy']."</p>";
                                echo "<p>Gender: ".$row['student_gender']."</p>";
                                echo "<p>About me: ".$row['student_about']."</p>";
                                
                                }
                                }
                                ?>
                           
                                <?php
                                $sql=mysqli_query($con,"SELECT * FROM STUDENT_DETAILS where id='$id'");
                                $user_count=mysqli_num_rows($sql);
                                $student_profile_pic="";
                                if($user_count>0){
                                while($row=mysqli_fetch_array($sql)){
                                $about=$row['student_about'];
                                $gender=$row['student_gender'];
                                $student_profile_pic=$row['student_profile_pic'];
                                echo "<h3 class='t_head' ><i class='fas fa-graduation-cap'></i> Education Details</h3>";
                                echo "<p>Class: ".$row['student_class']."</p>";
                                echo "<p>Board: ".$row['student_board']."</p>";
                                
                                echo "<p>Year: ".$row['student_board_from_passing_year']."-".$row['student_board_to_passing_year']."</p>";
                                
                                    
                                    echo "<h3 class='t_head' ><i class='fas fa-address-card'></i> Address</h3>";
                                    echo "<table>"; echo "<tr>";
                                        echo "<td>Email: </td><td>".$row['student_email']."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>City: </td><td>".$row['student_address']."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>City: </td><td>".$row['student_address']."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>District: </td><td>".$row['student_district']."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>State: </td><td>".$row['student_state']."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>Pin code: </td><td>".$row['student_pin_code']."</td>";
                                    echo "</tr>";
                                echo "</table>";
                                
                                }
                                }
                                ?>
                            </div>
                            <a href="studentupdateprofile.php"><button class="btn btn-primary mt-2 mb-2"><i class="fas fa-edit"></i> Update porfile details</button></a>
                        </div>
                        <div class="col-sm-3">
                            <img src="<?php echo $student_profile_pic;  ?>" height="200px" width="200px" />
                            <p>student Reg. No.: <?php echo $user_id;  ?></p>
                            <p>Profile complete: <?php  echo $percentage."%";
                            ?></p>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
        include('footer.php');
        ?>
    </body>
    </html>