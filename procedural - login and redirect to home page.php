<?php

//admin.login.php
session_start();
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"youtube_project");

if(isset($_POST["submit1"])) //name="submit1"
	{
		$res=mysqli_query($link,"select * from admin_login where username='$_POST[username]' && password='$_POST[pwd]'"); //name="username" and name="pwd"
		while($row=mysqli_fetch_array($res))
		{
		$_SESSION["admin"]=$row["username"]; //si username ra iyang gi check (get the data and trandsfer to session)
		?>
		<script type="text/javascript">
			window.location="add_product.php";
		</script>
		<?php	
		}
	}
?>