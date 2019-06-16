<?php
/*NOTE*/
if(mysqli_num_rows($result) > 0)






/******************************************/
//EXAMPLE 1
session_start();

//admin.login.php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"sinugba");

if(isset($_POST["submit"])) //name="submit1"
  {
    $res=mysqli_query($link,"select * from admin where username='$_POST[username]' && password='$_POST[pwd]'"); //name="username" and name="pwd"
    if($res->num_rows)   OR   if(mysqli_num_rows($result) > 0)
    {
      while ($row=mysqli_fetch_array($res)) 
      {
          $_SESSION["admin"]=$row["username"]; //si username ra iyang gi check (get the data and trandsfer to session)
      ?>
      <script type="text/javascript">
        window.location="dashboard.php?id=<?php echo $row['id'] ?>";
      </script>
      <?php
      }
    }else{
      echo '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Oops!</strong> Your username or password is not recognized. Please try again.
            </div>';
    }
  }
?>
