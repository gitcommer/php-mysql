<?php
//login.php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"sinugba");

if(isset($_POST["submit"])) //name="submit1"
  {
    $res=mysqli_query($link,"select * from admin where username='$_POST[username]' && password='$_POST[pwd]'"); //name="username" and name="pwd"
    while($row=mysqli_fetch_array($res))
    {
    $_SESSION["admin"]=$row["username"]; //si username ra iyang gi check (get the data and trandsfer to session)
    ?>
    <script type="text/javascript">
      window.location="dashboard.php?id=<?php echo $row['id'] ?>";
    </script>
    <?php 
    }
  }
?>

<!--**********************************************************-->

<?php
/*header.logout.php
  question:        - when login, display the data of the user to navbar
  how this work:   - when login display the ID to url, GET the data and display
                    -  you compare the ID number NOT the username */

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"sinugba");
$id=$_GET["id"];

$res=mysqli_query($link,"select * from admin where id=$id"); 
while($row=mysqli_fetch_array($res))  
{
?>
<li><a href=""><i class="fa fa-user"></i><?php echo $row['username']; ?></a></li>
<?php 
}
?>