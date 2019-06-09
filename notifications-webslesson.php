<!--
tutorial: https://www.youtube.com/watch?v=IvagmRhTG4w
-->



<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Facebook Style Header Notification using PHP Ajax Bootstrap</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br /><br />
  <div class="container">
   <nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <div class="navbar-header">
      <a class="navbar-brand" href="#">Webslesson Tutorial</a>
     </div>
     <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
       <ul class="dropdown-menu"></ul>
      </li>
     </ul>
    </div>
   </nav>
   <br />
   <h2 align="center">Facebook Style Header Notification using PHP Ajax Bootstrap</h2>
   <br />
   <form method="post" id="comment_form">
    <div class="form-group">
     <label>Enter Subject</label>
     <input type="text" name="subject" id="subject" class="form-control">
    </div>
    <div class="form-group">
     <label>Enter Comment</label>
     <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
    </div>
   </form>
   
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 //display notification from database
 function load_unseen_notification(view = '') { /*function naay variable view = empty*/
  $.ajax({            /*send data through ajax*/
   url:"fetch.php",
   method:"POST",
   data:{view:view},  //view is the variable view=''
   dataType:"json",   //send data as json code format
                      //this will recieve the data from echo json_encode($data);

   //data is the variable of function(data)
   success : function(data) {
    $('.dropdown-menu').html(data.notification); //disolay data.noti is dropdown-menu html
                                                 //data.notification is array data from fetch.php
    if(data.unseen_notification > 0) {
      $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 load_unseen_notification(); //run the function load_unseen_notification(view = '')
 


 //insert data to database
 $('#comment_form').on('submit', function(event) { //event meaning run this code when button is click
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '') { //if forms is not empty
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,

    success:function(data) {
     $('#comment_form')[0].reset(); //empty the forms after sending
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 


 //update when noti is click
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html(''); //when noti is click empty the html noti
    load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>

---------------------------------------------------------------

<?php
//insert.php
if(isset($_POST["subject"])) //mo receive ni siya bisan naay #subject basta naay subject
{
 include("connect.php");
 $subject = mysqli_real_escape_string($connect, $_POST["subject"]); //check and get the data of the forms
 $comment = mysqli_real_escape_string($connect, $_POST["comment"]);
 $query = " INSERT INTO comments(comment_subject, comment_text) VALUES ('$subject', '$comment') ";
 mysqli_query($connect, $query);
}
?>

---------------------------------------------------------------

<?php
//fetch.php;
if(isset($_POST["view"])) { /*isset will check if naay gi send na view si method:"POST"*/

  include("connect.php");

  //update data when notification is click
  if($_POST["view"] != '') {
    $update_query = "UPDATE comments SET comment_status=1 WHERE comment_status=0";
    mysqli_query($connect, $update_query);
  }



  //display only 5 data in dropdown
  $query = "SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5";
  $result = mysqli_query($connect, $query);
  $output = '';
 
  //if naay data sa database display this
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
     $output .= '
                 <li>
                  <a href="#">
                   <strong>'.$row["comment_subject"].'</strong><br />
                   <small><em>'.$row["comment_text"].'</em></small>
                  </a>
                 </li>
                 <li class="divider"></li>
                ';
    }
  }
  else {
    //if walay data sa database display this
    $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
  }
 


  $query_1 = "SELECT * FROM comments WHERE comment_status=0"; //0 meaning wla pa gi click ang noti
  $result_1 = mysqli_query($connect, $query_1);
  $count = mysqli_num_rows($result_1);

  $data = array('notification' => $output, //return this if wlay sulod ang database
                'unseen_notification' => $count //return this data if wla pa gi click ang noti
  );
  echo json_encode($data); //retrun data in json format
}
?>

---------------------------------------------------------------

<?php 
//connect.php;
$connect = mysqli_connect("localhost", "root", "", "testing");
?>

---------------------------------------------------------------

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_subject` varchar(250) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;