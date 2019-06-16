<?php
/*NOTE*/
 if($_POST["view"] != '') //is not empty, meaning naa siyay sulod





//INSERT FORMS DIRECTLY TO DATABASE
//=================================

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"youtube_project");

if(isset($_POST["submit1"]))
	{
	$lname=$row["lastname"];
	mysqli_query($link,"insert into checkout_address values('','$_POST[firstname]','$lname','{$_SESSION['admin']}')");
	?>
	<script type="text/javascript">
		alert("click ok to transferring to you in paypal");
		setTimeout(function(){window.location="paypal.php";},4000); //4 sec. before redirect
	</script>
	<?php
	}
?>

<!--**********************************************************-->

<form name="form1" action="" method="post" >
	<input type="text" placeholder="First Name" name="firstname">
	<input type="submit" name="submit1" value="save">
</form>