<?php

/*how this works: - after login, get the data of the username and transfer to sessions
                  - select the session and  display to header.logout.php*/

//admin.login.php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"sinugba");

if(isset($_POST["submit"])) //name="submit1"
  {
    $res=mysqli_query($link,"select * from admin where username='$_POST[username]' && password='$_POST[pwd]'"); //name="username" and name="pwd"
    if($res->num_rows)
    {
      while ($row=mysqli_fetch_array($res)) 
      {
          $_SESSION["admin"]=$row["username"]; //si username ra iyang gi check (get the data and trandsfer to session)
      ?>
      <script type="text/javascript">
        window.location="dashboard.php";
        //window.location="dashboard.php?id=<?php //echo $row['id'] ?>";
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

<!--*************************************************************************-->

<?php
// header.logout.php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"sinugba");
//$id=$_GET["id"];

$res=mysqli_query($link,"select * from admin where username='$_SESSION[admin]'"); 
while($row=mysqli_fetch_array($res))  
{
?>
<li><a href=""><i class="fa fa-user"></i><?php echo $row['username']; ?></a></li>
<?php 
}
?>