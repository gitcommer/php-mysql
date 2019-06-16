<?php

/********** NOTES ****************************************************
how session works: 	1. call the session function like session_start(); dili mogana ang session basta wla ang session_start();
					2. you can now declare the variable that can be access anywhere like $_SESSION["order_id"]=$row["id"];

	notes: 		- display session: 		echo $_SESSION['userid'];
				- session is pariha rana siya sa normal na variable, gani ma access lang na siya bisan asa na page
				- pwede ra nimo ma deritso of insert sa database
*/

$res=mysqli_query($link,"select * from product where admin_id='{$_SESSION['admin']}'"); 	//select session
$_SESSION['cart'] = [];  //clear session array, para inig redirect niya dili na niya i remember
$_SESSION["pay"]="";  //clear session array, para inig redirect niya dili na niya i remember
?>





<?php
/********** EXAMPLE 1 ****************************************************/
//checkout.php						
session_start();

if(isset($_POST["submit1"]))
{
	$link=mysqli_connect("localhost","root","");
	mysqli_select_db($link,"youtube_project");

	//note: meaning katong pinak latest na data nga na insert mao sd to iyang i select

	//first gi insert niya ang data
	mysqli_query($link,"insert into checkout_address values('','$_POST[firstname]','$_POST[lastname]','$_POST[email]','$_POST[resi]','$_POST[city]','$_POST[pincode]','$_POST[cno]')");

	//second get the data and transfer to session
	$res=mysqli_query($link,"select id from checkout_address order by id desc limit 1"); //i select and pinaka latest na data na nisulod
	while($row=mysqli_fetch_array($res))												 //desc from 1 to highest
	{
		$_SESSION["order_id"]=$row["id"]; //transfer to session para ma access bisan asa na page
	}
?>
<script type="text/javascript">
	alert("click ok to transferring to you in paypal");
	setTimeout(function(){
		window.location="paypal.php";
	},4000); //4 sec. before redirect

</script>
<?php
}
?>

<!--******************************-->

<?php
//paypal.php
session_start();

$order_id=$_SESSION["order_id"];  

echo $order_id;
?>





<?php
/********** EXAMPLE 2 ****************************************************/
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

//********************************************

//add_product.php
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