<?php
//admin.login.php
session_start();
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"youtube_project");

if(isset($_POST["submit1"])) //name="submit1"
	{
		$res=mysqli_query($link,"select * from admin_login where username='$_POST[username]' && password='$_POST[pwd]'");
		while($row=mysqli_fetch_array($res))
		{
		$_SESSION["admin"]=$row["username"];
		?>
		<script type="text/javascript">
			window.location="add.product.php";
		</script>
		<?php	
		}
	}
?>

<?php /*****************************************/ ?>

<?php
//check if user login, if not redirect to login page
//dashboard.com
session_start();
if($_SESSION["admin"]=="")
{
	?>
	<script type="text/javascript">
		window.location="admin_login.php";
	</script>
	<?php
}
?>