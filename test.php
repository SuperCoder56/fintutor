 <?php
            
            include('connect_database.php');
            
            if(isset($_POST['submit'])){
            if($_POST['platform']=='online'){
            $subject=$_POST['subject'];
            $price_min=$_POST['price_min'];
            $price_max=$_POST['price_max'];
             $days=implode(' ', $_POST['days']);
            
              $level=$_POST['level'];
               $lang=$_POST['lang'];

               echo "$price_min , $price_max,$lang,$days";
            $query="SELECT * FROM teacher_subjects, teacher_details where teacher_subjects.teacher_id=teacher_details.id AND teacher_subjects.subject_platform LIKE '%online%' AND teacher_subjects.subject_name LIKE '%$subject%' ";
            
            if ($lang!="select") {
              $query.=" AND teacher_subjects.subject_language LIKE '%$lang%'";           
            }
             if ($level!="select") {
              $query.=" AND teacher_subjects.subject_level LIKE '%$level%'";           
            }
             if ($price_max!="0"&&$price_min!="0") {
              $query.=" AND teacher_subjects.subject_price_hour BETWEEN '%$price_min%' AND  '%$price_max%'";           
            }

            $sql=mysqli_query($con, $query);
            echo "$query";


            $row_count=mysqli_num_rows($sql);
            if ($row_count>0) {
            echo "<h2>Showing <u>Online</u> teachers for '$subject'</h2>";
            while($row=mysqli_fetch_array($sql)){
            $subject_id=$row['subject_id'];
            $teacher_id=$row['teacher_id'];
            echo "<div class='row mt-5 mb-5 p-3 teacher_list'>";
                echo "<div class='col-sm-3'>";
                    echo "<img class='pic' src='".$row['teacher_profile_pic']."' />";
                    
                echo "</div>";
                echo "<div class='col-sm-6'>";
                    echo "<p class='text-left'><span class='p_clr'>Name: </span>".$row['teacher_name']."<br><span class='p_clr'>City: </span>".$row['teacher_address'].
                        "<br><span class='p_clr'>Email: </span>".$row['teacher_email']."
                        <br><span class='p_clr'>Language: </span>".$row['subject_language']."
                        <br><span class='p_clr'>Platform: </span>".$row['subject_platform']."
                        <br><span class='p_clr'>Subject: </span>".$row['subject_name']."
                        <br><span class='p_clr'>Level: </span>".$row['subject_level']."
                        <br><span class='p_clr'>Board: </span>".$row['subject_board']."
                        <br><span class='p_clr'>Days: </span>".$row['subject_days']."
                        <br><span class='p_clr'>Price(per hour): </span>&#x20b9;".$row['subject_price_hour']."
                        <br><span class='p_clr'>Price(per month): </span>&#x20b9;".$row['subject_price_month']."
                    </p><br/>";
                echo "</div>";
                echo "<div class='col-sm-3 align-self-center'>";
                 echo "<a href='tutorprofile.php?tid=$teacher_id#contact'><button class='btn btn-primary' >Contact Tutor</button></a><br><br>";
                    echo "<a href='ajax.php?sid=$subject_id&tid=$teacher_id'><button class='btn btn-primary' >Enroll Request</button></a><br><br>";
                    echo "<a href='tutorprofile.php?tid=$teacher_id'><button class='btn btn-primary' >View Profile</button></a>";
                echo "</div>";
            echo "</div>";
            
            }
            }else{
            echo "<p class='text-center'>Sorry, currently no teacher is available for $subject subject!</p>";
            }
            }