<?php
//note: 	- don't forget the <form name="form1" action="" method="post" enctype="multipart/form-data">

if(isset($_POST["submit1"]))
{
	$v1=rand(1111,9999); // 1. create to ramdon number
	$v2=rand(1111,9999);

	$v3=$v1.$v2; // 2. i combine ang doha ka ramdom numbers

	$v3=md5($v3); // 3. i convert napud ang random number to md5

	$fnm=$_FILES["simage"]["name"]; //simage is the name="simage" in forms
	$dst="./product_image/".$v3.$fnm; //this is the folder of the image
	$dst1="product_image/".$v3.$fnm;
	move_uploaded_file($_FILES["simage"]["tmp_name"],$dst); //move the image to the folder

	//first insert the data
	mysqli_query($link,"insert into subscription values('','$dst1','$_POST[speriod]')");

	//second get the data and transfer to session
	$res=mysqli_query($link,"select subscription_id from subscription order by subscription_id desc limit 1"); //select specific 1 data
	while($row=mysqli_fetch_array($res))
	{
		$_SESSION["paypal_subscription_id"]=$row["subscription_id"]; //transfer the database id of while to session
	}

	?>
	<script type="text/javascript">
		alert("click ok to transferring to you in paypal");
		setTimeout(function(){
			window.location="subscription_paypal.php";
		},4000); //4 sec. before redirect

	</script>
	<?php
}
?>

<!--***************************************************-->

<?php
//NAME IS NOT ENCRYPTED - you can use this to check if image exists

$fnm=$_FILES["simage"]["name"]; //simage is the name="simage" in forms
$dst="./product_image/".$fnm; //this is the folder of the image
move_uploaded_file($_FILES["simage"]["tmp_name"],$dst); //move the image to the folder
?>