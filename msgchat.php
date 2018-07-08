<?php
session_start();
if (!isset($_SESSION["user_email"])) {
  header("location:index.php");
  exit();
}
$user_id=$_SESSION["user_id"];
$user_name=$_SESSION["user_name"];
$user_email=$_SESSION["user_email"];

?>
<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style type="text/css">
.name{
  font-size: 18px;
  color: blue;
}
#Div2{
  height: 300px;
  overflow: scroll;
  padding: 10px 20px;
  overflow-x:hidden;
  width: 100%;
  display: block;
}
</style>
<script type="text/javascript">
  $(document).ready(function(){
      
      $('#chat_form').submit(function(event){
    event.preventDefault();
    var s_name=$('#s_name').val();
    var s_email=$('#s_email').val();
    var r_email=$('#r_email').val();
    var msg=$('#msg').val();
    

    $.post('scripts/send_msg.php',
      {s_name:s_name,
        r_email:r_email,
        s_email:s_email,
        msg:msg
      },
      function(data){
       
        $('#msg').val("");
      });
  });

  });
</script>
<?php
if (isset($_GET['user_email2'])) {
 $user_email2=$_GET['user_email2'];
}
?>
<script type="text/javascript">

  function getChat(){
    var user_email2="<?php echo $_GET['user_email2']; ?>";
    $.get('scripts/get_chat.php',{user_email2:user_email2},function(data){
      $('#Div2').html(data);
    });
  }

getChat();
  setInterval(getChat,1000);


</script>
<div class="container">
  <div class="row">
   
    <div class="col-sm-12">
    </div>
      <div id="Div2" >
      </div>

      <div style="display: block;width: 100%;"> 
      <?php
      include('connect_database.php');
           $sql=mysqli_query($con, "SELECT * from USERS where user_email='$user_email2' LIMIT 1");
    if ($sql && mysqli_num_rows($sql)>0) {
      echo "<form id='chat_form' >";
         echo "<input type='text' name='s_name' id='s_name' value='$user_name' style='display: none;' /><br>";
         echo "<input type='text' name='s_email' id='s_email' value='$user_email' style='display: none;' /><br>";
         echo "<input type='text' name='r_email' id='r_email' value='$user_email2' style='display: none;'  /><br>";

        echo "<textarea style='width: 100%' rows='2' cols='12' name='msg' id='msg' placeholder='Write your message' required='true'></textarea ><br>";

         echo "<input  class='btn btn-primary float-right' type='submit' name='submit' value='Send' >";
       echo "</form>";
     
    }else{
      
      exit();
    }


      ?>

        
     </div>
   </div>

</div>
</div>
</body>
</html>