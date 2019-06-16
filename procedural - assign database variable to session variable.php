<?php


//EXAMPLE 1
//=========
$res=mysqli_query($link,"select subscription_id from subscription order by subscription_id desc limit 1"); //select specific 1 data
while($row=mysqli_fetch_array($res))
{
	$_SESSION["paypal_subscription_id"]=$row["subscription_id"]; //transfer the database id of while to session
}


//EXAMPLE 2 (select what you have entered)
//========================================
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
?>

?>