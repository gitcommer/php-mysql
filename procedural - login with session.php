<?php

//HOW THIS WORKS: login on forms then check the data id exists in the database


// 1. LOGIN FORMS
//===============
//admin_login.php
session_start();

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"youtube_project");

if(isset($_POST["submit1"]))
	{
		$res=mysqli_query($link,"select * from admin_login where username='$_POST[username]' && password='$_POST[pwd]'"); //compare the database data and the forms data
		while($row=mysqli_fetch_array($res))
		{
		$_SESSION["admin"]=$row["username"]; //get the database data of username and assign to new session variable
		?>
		<script type="text/javascript">
			window.location="add_product.php";
		</script>
		<?php	
		}
	}


// 2. CHECK IF USER EXIST
//=======================
//add_product.php
session_start();

if($_SESSION["admin"]=="") 	//admin_login.php
{
	?>
	<script type="text/javascript">
		window.location="admin_login.php";	//redirect
	</script>
	<?php
}
?>