 <script >
    $(document).ready(function(){
 $('.s_email').click(function(){

      var query=$(this).text();
      
      //  $("#chat_content").load("msgchat.php?user_email2="+query);
      // $("#chat_modal").modal('toggle');      
      window.open("msgchat.php?user_email2="+query, "Chat room", "width=600,height=700");
     
      
    });
       
        
    });
</script>
<style type="text/css">
  .s_email{
    color:#3857FC;
  }
  .s_email:hover{
text-decoration: underline;
  }
  .chat_room{
    position: absolute;top:0%;left:38%;z-index: 4px;width:340px;background-color: grey;font-size: 11px;
  }
</style>

 <?php
 include('connect_database.php');

 if (isset($_POST['query'])) {
  $user_email=$_POST['query'];
  $sql=mysqli_query($con,"SELECT  DISTINCT * FROM MESSAGES WHERE r_email='$user_email' order by msg_id desc");
  if (mysqli_num_rows($sql)>0) {

    while ($row=mysqli_fetch_array($sql)) {
      $s_email=$row['s_email'];
      echo "<p><span class='s_email' >$s_email</span><br>";
      echo $row['msg']."<br/>";
      date_default_timezone_set('Asia/Kolkata');
      echo date('g:i a, d/m/Y',strtotime($row['m_time']))."</p>";
    }
  }else{
    echo "No messages available!";
  }
}
?>

<div class="modal fade chat_modal">
    <div class="modal-dialog  model-fade">
      <div class="modal-content">
        
        <div class="modal-header">
          
          <button type="button" class="close2 close" data-dismiss="modal">&times;</button>
          
        </div>
        
        <div class="modal-body">
         <div id="chat_content"></div>
          
        </div>
      </div>
    </div>
    
  </div>