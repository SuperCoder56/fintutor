<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" >
    <meta  name="viewport" content="width=device-width">
    <meta  name="description" content="">
    <meta  name="keywords" content="">
    <title>Tutor Search - FinTutor</title>
     <?php
         include 'cdns.php';
       ?>
    <script type="text/javascript">
        $(document).ready(function(){
             $('#show_info').hide();
             $('#show_info').click(function(){
                 $('#notification').slideToggle('fast');
                 $(this).hide();
            });
            fetchAllTutors();
            

            $('#online').click(function(){
                $('.location').hide();
            });
            $('#offline').click(function(){
                $('.location').show();
            });
            
            $('#subject').keyup(function(){
                var query=$(this).val();
                if (query!='') {
                    $.ajax({
                        url:"search.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data){
                            $('#subject_list').fadeIn();
                            $('#subject_list').html(data);
                        }
                    });
                }
            });
            $(document).on('click','.s_list li',function(){
                $('#subject').val($(this).text());
                $('#subject_list').fadeOut();
            });
            $('#location').keyup(function(){
                var query2=$(this).val();
                if (query2!='') {
                    $.ajax({
                        url:"search2.php",
                        method:"POST",
                        data:{query2:query2},
                        success:function(data){
                            $('#location_list').fadeIn();
                            $('#location_list').html(data);
                        }
                    });
                }
            });
            $(document).on('click','.l_list li',function(){
                $('#location').val($(this).text());
                $('#location_list').fadeOut('fast');
            });
            $('#price_min').change(function(){
                $('#price_min_div').html($(this).val());
            });
            $('#price_max').change(function(){
                $('#price_max_div').html($(this).val());
            });
            $('#tutor_search_form').submit(function(event){
                event.preventDefault();
                fetchSearchData();
            });

            function fetchSearchData(){
                var myCheckboxes = new Array();
                $(".s_days:checked").each(function() {
                    myCheckboxes.push($(this).val());
                });
                $.ajax({url:'scripts/tutor_search.php',
                    method:'POST',
                    data:{subject:$('#subject').val(),
                    location:$('#location').val(),
                    level:$('#level').val(),
                    lang:$('#lang').val(),
                    price_min:$('#price_min').val(),
                    price_max:$('#price_max').val(),
                    s_days:myCheckboxes,
                    platform:$('.platform:checked').val()
                },
                beforeSend:function(){
                    $('#teacher_list').html("<center><img src='images/loader.gif' class='text-center' height='40px' width='40px' style='margin-top:46px;'  /></center>");
                },
                success:function(data){
                    $('#teacher_list').html(data);
                }
            });
            }
            $('#advance_filters').hide();
            $('#Filters').click(function(){
                $('#advance_filters').slideToggle("slow");
            });
            $('#all').change(function(){
                $('#subject').val('');
                $('#location').val('');
                if ('#all:checked') {
                    fetchAllTutors();
                }
                $('.location').show();
            });

            $('#level, #lang, #price_min, #price_max, .platform, .s_days').change(function(){
               
                  fetchSearchData();
            });
             $('.platform').change(function(){
                   $('#subject').val('');
                $('#location').val('');
                  fetchSearchData();
            });
            function fetchAllTutors(){
                var myCheckboxes = new Array();
                $(".s_days:checked").each(function() {
                    myCheckboxes.push($(this).val());
                });
                $.ajax({url:'scripts/tutor_search.php',
                    method:'POST',
                    data:{all_tutors:"all tutors",
                    subject:$('#subject').val(),
                    location:$('#location').val(),
                    level:$('#level').val(),
                    lang:$('#lang').val(),
                    price_min:$('#price_min').val(),
                    price_max:$('#price_max').val(),
                    s_days:myCheckboxes,
                    platform:$('.platform:checked').val()
                },
                beforeSend:function(){
                    $('#teacher_list').html("<center><img src='images/loader.gif' class='text-center' height='40px' width='40px' style='margin-top:46px;' /></center>");
                },
                success:function(data){
                    $('#teacher_list').html(data);
                }
            });
            }
           
            $('#div_close_btn').click(function(){
                $('#notification').slideToggle('fast');
                $('#show_info').show();
            });
            // setTimeout(function(){
            //        $('#notification').slideToggle('fast');
            // },5000);
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
    <style type="text/css">
    #underInput{
        font-size: 30px;
        text-align: center;
    }
    h1{
        text-align: center;
        font-size: 46px;
        text-decoration: underline;
    }
    .btn{
        border-radius: 0px;
    }
    .teacher_list{
        background:white;
         box-shadow: 0 1px 1px rgba(0,0,0,0.3);
          padding: 4rem 4rem;
    }
    .teacher_list > .col-sm-3, .teacher_list > .col-sm-6{
        padding: 2rem 2rem;
    }
    body{
        background: #f0f0f0;
    }
    .pic{
        height: 200px;
        width: 200px;
    }
    input,table,tr,td{
        padding: 0px;
    }
    #search_box{
      width: 100%;
       background: white;
      padding: 2rem 3rem;
        box-shadow: 0 1px 1px 0 rgba(0,0,0,0.2);
    }
    .s_list, .l_list{
        background-color: #eee;
        cursor: pointer;
        z-index: 16px;
        position: absolute;
        width:220px;
        padding-left: 30px;
    }
    .s_list, .l_list li{
        padding: 12px;
    }
    #subject_list, #location_list, #subject, #location{
        text-transform: lowercase;
    }
    .alert{
        position: absolute;
        z-index: 4px;
        display: inline-block;
        top: 0px;
        left: 0px;
        text-align: center;
        width: 100%;
    }
    .t_btn{
        
       
        width:100%;
    }
    #notification{
        background: linear-gradient(to right, blue, forestgreen);
        color: white;
        padding: 0px;
    }
    #left_bar{
         padding: 2rem 2rem;
        font-size: 14px;
        margin-top: 114px;
        clear: both;
        margin-bottom: 30px;
        box-shadow: 0 1px 1px rgba(0,0,0,0.3);
        overflow: hidden;
        
    }
  
</style>
<?php

if (isset($_GET['search_query'])) {
  $subject=$_GET['sub'];
  $location=$_GET['loc'];
  

echo "<script>
     $(document).ready(function(){
    function fetchAllTutors2(){
        $('#subject').val('$subject');
        $('#location').val('$location');
       
        $.ajax({url:'scripts/tutor_search.php',
            method:'POST',
            data:{all_tutors:'all tutors',
            subject:'$subject',
            location:'$location',
        },
        beforeSend:function(){
            $('#teacher_list').html(\"<center><img src='images/loader.gif' class='text-center' height='40px' width='40px' style='margin-top:46px;' /></center>\");
        },
        success:function(data){
            $('#teacher_list').html(data);
        }
    });
    }
    fetchAllTutors2();
});

</script>";

  if (isset($_GET['tid'])) {
  }
  if (isset($_GET['sid'])) {
  }
}
?>
<div class="container" id="notification">
    <div class="row">
        <div class="col-sm-12 text-center align-items-center pt-1"><p style="font-size: 12px;color: white;"><mark><i class="fas fa-bell"></i> Discounts are available, feel free to contact tutors! </mark>&nbsp;&nbsp;&nbsp; <span id="div_close_btn" style="cursor: pointer;">&times;</span><br>
            <p style="font-size: 12px;color: white;" ><marquee scrollamount="4" >Important information: Please on sending enroll request, submit the subject details what you require from tutors in dialog box.</marquee></p>

        </p></div>
    </div>
</div>
<p class=" btn-link float-right" style="background: transparent;overflow: hidden;cursor: pointer;" id="show_info" ><i class="fas fa-hand-point-up"></i></p>




<div class="container" id="search_box">
    <div class="row mt-2">
        <div class="col-12 ">
            <div class="card ">
                <form id="tutor_search_form" >
                    <table class="table-sm table-striped  table-bordered " align="center" >
                        <tr>
                            <td><input type="radio" name="platform" class="platform"  id="all" checked="true" value="all_tutors">All</td>
                            <td><input type="radio" name="platform" class="platform" id="offline" value="offline" >Offline(in house)</td>
                            <td> <input type="radio" name="platform" class="platform" id="online" value="online" >Online</td>
                             
                             
                             
                        </tr>
                    </table>
                    <table  class="table-sm table-striped  table-bordered" align="center">
                        <tr>
                            <td><label>Subject: </label><input type="text" name="subject"  id="subject" required="true" />
                            </td>
                            <td class="location" ><label>Location: </label>
                                <input type="text" id="location" name="location"  /></td>
                                <td><input   class="btn btn-primary " type="submit" id="tutor_submit" name="submit"  value="Search" />&nbsp;&nbsp;<input   class="btn-sm btn-primary " type="button" id="Filters"   value="Filters" /></td>
                            </tr>
                            <tr>
                                <td><div id="subject_list" ></div></td>
                                <td><div id="location_list"  ></div></td>
                                <td></td>
                            </tr>
                        </table>
                        <table id="advance_filters" class="table-sm pl-5 mt-3" align="center">
                        </thead>
                        <tbody>
                            <tr>
                                <td> <label>Level</label></td>
                                <td>
                                    <select class="form-control-sm" id="level"  name="level">
                                        <option value="select">Choose level</option>
                                        <option value="Class 1-5">Class 1-5</option>
                                        <option value="Class 6-10">Class 6-10</option>
                                        <option value="Class 11-12">Class 11-12</option>
                                        <option value="Graduation">Graduation</option>
                                        <option value="Post graduation">Post Graduation</option>
                                        <option value="Casual">Causal</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td> <label>Language</label></td>
                                <td>
                                    <select class="form-control-sm" id="lang" name="lang" >
                                        <option value="select">Choose language</option>
                                        <option value="Assamese">Assamese</option>
                                        <option value="Bodo">Bodo </option>
                                        <option value="Dogri">Dogri</option>
                                        <option value="English">English</option>
                                        <option value="Gujrati">Gujrati</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Kannada">Kannada</option>
                                        <option value="Kashmiri">Kashmiri</option>
                                        <option value="Konkani">Konkani</option>
                                        <option value="Maithili">Maithili</option>
                                        <option value="Malayalam">Malayalam</option>
                                        <option value="Marathi">Marathi</option>
                                        <option value="Meitei">Meitei</option>
                                        <option value="Nepali">Nepali</option>
                                        <option value="Odia">Odia</option>
                                        <option value="Punjabi">Punjabi</option>
                                        <option value="Sanskrit">Sanskrit</option>
                                        <option value="Santali">Santali</option>
                                        <option value="Sindhi">Sindhi</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="Telugu">Telugu</option>
                                        <option value="Urdu">Urdu</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td><label >Days</label></td>
                                    <td>
                                        <input type="checkbox"  name="s_days[]" class='s_days'  value="monday">Monday &nbsp;
                                        <input type="checkbox" name="s_days[]" class='s_days' value="tuesday">Tuesday &nbsp;
                                        <input type="checkbox" name="s_days[]" class='s_days' value="wednesday">Wednesday &nbsp;
                                        <input type="checkbox" name="s_days[]" class='s_days' value="thursday">Thursday &nbsp;
                                        <input type="checkbox" name="s_days[]" class='s_days' value="friday">Friday &nbsp;
                                        <input type="checkbox" name="s_days[]" class='s_days' value="saturday">Saturday &nbsp;
                                        <input type="checkbox" name="s_days[]" class='s_days' value="sunday">Sunday &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td> <label>Price (per hour)</label></td>
                                    <td>
                                        Min(<div id="price_min_div" style="display: inline-block;">0</div>) <input type="range" id="price_min" name="price_min" min="0" max="100" value="0" >&nbsp;
                                        Max (<div id="price_max_div" style="display: inline-block;" >100</div>) <input type="range" id="price_max" name="price_max" min="0" max="100" value="100">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="reset" class="btn-link border-0 " name="rest" value="Reset filters"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
         <div class="col-sm-2 "   >
            <div class="card mr-1" id="left_bar">
           <?php
           include 'connect_database.php';
           echo "<h5>Search by Subjects Available</h5><br>";
           $sql=mysqli_query($con, "SELECT DISTINCT(subject_name) FROM TEACHER_SUBJECTS LIMIT 30") or die(mysqli_error($con));
           if ($sql) {
            while ($row=mysqli_fetch_array($sql)) {
               
                 $subject= $row['subject_name'];
                 echo "<button class='btn-link btn srch_sbjct' value='$subject'>$subject</button>";
                

            
         }
          echo "<script>

                       function fetchSearchData(){
                var myCheckboxes = new Array();
                $('.s_days:checked').each(function() {
                    myCheckboxes.push($(this).val());
                });
                $.ajax({url:'scripts/tutor_search.php',
                    method:'POST',
                    data:{subject:$('#subject').val(),
                    location:$('#location').val(),
                    level:$('#level').val(),
                    lang:$('#lang').val(),
                    price_min:$('#price_min').val(),
                    price_max:$('#price_max').val(),
                    s_days:myCheckboxes,
                    platform:$('.platform:checked').val()
                },
                beforeSend:function(){
                    $('#teacher_list').html(\"<center><img src='images/loader.gif' class='text-center' height='40px' width='40px' style='margin-top:46px;'  /></center>\");
                },
                success:function(data){
                    $('#teacher_list').html(data);
                }
            });
            }
                       $('.srch_sbjct').click(function(){
                         $('#location').val('');
                           $('#subject').val($(this).val());
                           fetchSearchData();
                           
                       });

                       $('.srch_location').click(function(){
                        
                        $('#subject').val('');
                           $('#location').val($(this).val());
                           fetchSearchData();
                           
                       });
                       </script>

                 ";
     }
     echo "<br><h5>Search by Cities Available</h5><br>";
     $sql=mysqli_query($con, "SELECT DISTINCT(teacher_address) FROM TEACHER_DETAILS LIMIT 30") or die(mysqli_error($con));
     if ($sql) {
        while ($row=mysqli_fetch_array($sql)) {
        $location= $row['teacher_address'];
        
         echo "<button class='btn-link btn srch_location' value='$location'>$location</button>";
         
     }
     echo "<script>
                   $(document).ready(function(){
                       function fetchSearchData(){
                var myCheckboxes = new Array();
                $('.s_days:checked').each(function() {
                    myCheckboxes.push($(this).val());
                });
                $.ajax({url:'scripts/tutor_search.php',
                    method:'POST',
                    data:{subject:$('#subject').val(),
                    location:$('#location').val(),
                    level:$('#level').val(),
                    lang:$('#lang').val(),
                    price_min:$('#price_min').val(),
                    price_max:$('#price_max').val(),
                    s_days:myCheckboxes,
                    platform:$('.platform:checked').val()
                },
                beforeSend:function(){
                    $('#teacher_list').html(\"<center><img src='images/loader.gif' class='text-center' height='40px' width='40px' style='margin-top:46px;'  /></center>\");
                },
                success:function(data){
                    $('#teacher_list').html(data);
                }
            });
            }
                       $('.srch_sbjct').click(function(){
                           $('#subject').val($(this).val());
                           fetchSearchData();
                           
                       });

                       $('.srch_location').click(function(){
                             $('#subject').val('');
                           $('#location').val($(this).val());
                           fetchSearchData();
                           
                       });
                   });
                       </script>

                 ";
 }
 ?>
</div> 
</div>
<div class="col-sm-10 pt-3" id="teacher_list" style="min-height:400px;" >
</div>
</div>
</div>
<?php
include('footer.php');
?>
</body>
</html>