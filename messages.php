<?php
session_start();
if (!isset($_SESSION["user_email"])) {
    header("location:index.php");
    exit();
}
$user_id=$_SESSION["user_id"];
$user_email=$_SESSION["user_email"];
$user_name=$_SESSION["user_name"];
$position=$_SESSION["user_position"];
include("connect_database.php");
$sql=mysqli_query($con,"SELECT * FROM USERS WHERE id='$user_id'  LIMIT 1");
$existCount=mysqli_num_rows($sql);
if($existCount==0){
    exit();
}
else{
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" >
    <meta  name="viewport" content="width=device-width">
    <meta  name="description" content="">
    <meta  name="keywords" content="">

    <title>Messages - FinTutor</title>
 <?php
         include 'cdns.php';
       ?>
    <style type="text/css">
    .name{
        font-size: 18px;
        color: blue;
    }
    body{
            background: #f0f0f0;
        }
    #msgDiv{
        width: 100%;
        height: 300px;
        overflow: scroll;
        overflow-x: hidden;
    }
    .s_call{
        color: red;
    }
    .s_call:hover{
        text-decoration:underline;
        cursor: pointer;
    }
</style>
<script >
    $(document).ready(function(){


        function fetchMsgs(){
            var user_email="<?php echo $user_email; ?>";
            $.post('getMsgs.php',
                {query:user_email},
                function(data){
                    $('#msgDiv').html(data);

                });

        }
        fetchMsgs();
        setInterval(fetchMsgs,100000);
        
        $('.s_email').click(function(){

      var query=$(this).text();
      
       $("#chat_content").load("msgchat.php?user_email2="+query);
      jQuery(".chat_modal").modal('toggle');      
      // window.open("msgchat.php?user_email2="+query, "Chat room", "width=600,height=700");
     
      
    });
       
        
    });
</script>

</head>
<body >
    <?php

    if (!isset($_SESSION["user_email"])) {
        include('header.php');
    }else{
        include('header_account.php');
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 " >
                <?php
                if ($position=='teacher' or $position=='Teacher' ) {
                    include('teacher_left_navbar.php');
                }else{
                    include('student_left_navbar.php');
                }
                ?>

            </div>
            <div class="col-sm-9 p-4" style="min-height: 540px;">
                <h3><span class='t_head'><i class="far fa-envelope"></i> My Messages</span></h3>
                <div id="msgDiv">


                </div>
                <p>Message inbox updated after every 10 seconds</p>

            </div>
        </div>
    </div>
    <?php
    include('footer.php');
    ?>

</body>
</html>